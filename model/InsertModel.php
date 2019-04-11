<?php

include("DBConnection.php");

class InsertModel{

    private $PW_HASH;
    private $EMAIL_HASH;

    public function SignUpUser($post){
        //On récupère l'USERNAME, l'E-Mail et le PW que l'utilisateur a tapé dans le formulaire
        $USERNAME = $post['USERNAME_USER'];
        $MAIL = $post['MAIL_USER'];
        $PW = $post['PW_USER'];
        $PW_REPEAT = $post['PW_USER_REPEAT'];
        //Connexion raté car USERNAME ou PW ou MAIL est vide :
        if (empty($USERNAME) || empty($PW) || empty($MAIL) ){
            return 1;
        }
        if ($PW != $PW_REPEAT){
            return 3;
        }
        //Connection to PDO
        $DBConnection = new DBConnection();
        $bdd = $DBConnection->getDB();
        //Hash
        $options = [
          'cost' => 12,
        ];
        $this->PW_HASH = password_hash($PW, PASSWORD_BCRYPT, $options);
        $this->EMAIL_HASH = password_hash($MAIL, PASSWORD_BCRYPT, $options);
        //Vérification si l'USERNAME n'est pas déjà dans la BDD :
        $req = $bdd->prepare("SELECT USERNAME FROM users WHERE USERNAME = ?");
        $req->execute(array($USERNAME));
        $res = $req->fetch();
        if($res['USERNAME']){
            return 1;
        }
        //Vérification si l'EMAIL n'est pas déjà dans la BDD :
        $req = $bdd->prepare("SELECT EMAIL FROM users");
        $req->execute();
        while ($res = $req->fetch()){
            if(password_verify($MAIL,$res['EMAIL'])){
                return 2; //EMAIL DEJA DANS LA BDD
            }
        }
        //Insertion dans la BD
        $req = $bdd->prepare("INSERT INTO users(USERNAME, EMAIL, PWD)VALUES(:USERNAME, :EMAIL, :PWD)");
        if($req){
            $req->execute(array('USERNAME' => $USERNAME, 'EMAIL' => $this->EMAIL_HASH, 'PWD' => $this->PW_HASH));
            return 0;
        }else{
            $req->errorInfo();
            return 4;
        }
    }
}
