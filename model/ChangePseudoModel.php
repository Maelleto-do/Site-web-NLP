<?php
include("DBConnection.php");


class ChangePseudoModel
{

    public function changePseudo($post){

        //On récupère le pseudo tapé par l'utilisateur dans le formulaire
        $NEWPSEUDO = $post['NEW_PSEUDO'];
        //Id de l'utilisateur en cours
        $USERID = $_SESSION['USERID'];

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        //Vérification si l'USERNAME n'est pas déjà dans la BDD :
        /*
        $req = $bdd->prepare("SELECT USERNAME FROM users WHERE USERNAME = ?");
        $req->execute(array($USERNAME));
        $res = $req->fetch();
        if($res['USERNAME']){
            return 2;
        }*/

        //Modification de la BD
        $req = $db >prepare("UPDATE users SET USERNAME = ? WHERE ID = ?");
        if($req){
            $req->execute(array('USERNAME' => $NEWPSEUDO, 'ID' => $USERID));
            echo "super"; exit();
            return 0;
        }else{
            $req->errorInfo();
            return 5;
        }
    }
}