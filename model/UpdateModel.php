<?php

require_once("DBConnection.php");

class UpdateModel{

    private $userId;
    private $PW_HASH;

    public function getUserId($userId){
      $this->userId = $userId;
    }

    public function getUserId($userId){
        $this->userId = $userId;
    }

    public function changePseudo($post){
        $NEWPSEUDO = $post['NEW_PSEUDO'];
        $USERNAME = $post['USERNAME'];
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();
        //Vérification si l'USERNAME n'est pas déjà dans la BDD
        $req = $db->prepare("SELECT USERNAME, ID FROM users");
        $req->execute(array($USERNAME));
        while ($res = $req->fetch()) {
            if (($res['USERNAME'] === $NEWPSEUDO) || ($res['ID'] != $this->userId) || (mb_strtolower($NEWPSEUDO) === 'admin') ) {
                return 1;
                exit();
            }
        }
        //Vérification si le pseudo est bien entre 3 et 20 caractères et avec des caractères autorisés
        if (empty($NEWPSEUDO)){
            return 2;
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $NEWPSEUDO)){
            return 3;
        }
        if  (strlen($NEWPSEUDO) > 20){
            return 4;
        }
        if (strlen($NEWPSEUDO) < 3){
            return 5;
        }
        //On remet le nom de l'utilisateur à jour
        $_SESSION['USERNAME'] = $NEWPSEUDO;
        //Modification du pseudo dans la BD (0 si réussie, 6 si échouée)
        $req = $db->prepare("UPDATE users SET USERNAME=? WHERE ID=?");
        if($req){
            $req->execute([$NEWPSEUDO, $this->userId]);
            $this->ret = 0;
        }else{
            $req->errorInfo();
            $this->ret = 6;
        }
    }

    public function changePwd($post){
        //On récupère le pseudo tapé par l'utilisateur dans le formulaire
        $NEWPWD = $post['NEW_PWD'];
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();
		//Vérification si le mot de passe est bien entre 3 et 20 caractères et avec des caractères autorisés
        if (empty($NEWPWD)){
            return 7;
        }
        if  (strlen($NEWPWD) > 20){
            return 8;
        }
        if  (strlen($NEWPWD) < 3){
            return 9;
        }else if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $NEWPWD)){
            return 10;
        }
        //Hash
        $options = [
            'cost' => 12,
        ];
        $this->PW_HASH = password_hash($NEWPWD, PASSWORD_BCRYPT, $options);
        //Modification du mot de passe dans la BD (0 si réussie, 6 si échouée)
        $req = $db->prepare("UPDATE users SET PWD=? WHERE ID=?");
        if($req){
            //$req->execute(array('USERNAME' => $PW_HASH, 'ID' => $USERID));
            $req->execute([$this->PW_HASH, $this->userId]);
            return 0;
        }else {
            $req->errorInfo();
            return 6;
        }
    }
}

?>
