<?php
include("DBConnection.php");


class ChangePwdModel
{

    private $PW_HASH;


    public function changePwd($post){

        //On récupère le pseudo tapé par l'utilisateur dans le formulaire
        $NEWPWD = $post['NEW_PWD'];
        //Id de l'utilisateur en cours
        $USERID = $_SESSION['USERID'];

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();


        //Hash
        $options = [
            'cost' => 12,
        ];
        $this->PW_HASH = password_hash($NEWPWD, PASSWORD_BCRYPT, $options);

        //Modification de la BD
        $req = $db->prepare("UPDATE users SET PWD=? WHERE ID=?");
        if($req){
            //$req->execute(array('USERNAME' => $PW_HASH, 'ID' => $USERID));
            $req->execute([$this->PW_HASH, $USERID]);
            return 0;
        }else {
            $req->errorInfo();
            return 2;
        }
    }
}