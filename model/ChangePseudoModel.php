<?php
include("DBConnection.php");


class ChangePseudoModel
{

    public function changePseudo($post){

        //On récupère le pseudo tapé par l'utilisateur dans le formulaire
        $NEWPSEUDO = $post['NEW_PSEUDO'];
        //Id de l'utilisateur en cours
        $USERID = $_SESSION['USERID'];
        $USERNAME = $_SESSION['USERNAME'];

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        //Vérification si l'USERNAME n'est pas déjà dans la BDD
        $req = $db->prepare("SELECT USERNAME FROM users");
        $req->execute(array($USERNAME));
        while ($res = $req->fetch()) {
            if ($res['USERNAME'] === $NEWPSEUDO && $res['ID'] != $USERID) {
                return 1;
            }
        }

        //On remet le nom de l'utilisateur à jour
        $_SESSION['TEMP_SUBJECT_INFO']['USERNAME'] = $NEWPSEUDO;
        $_SESSION['USERNAME'] = $NEWPSEUDO;

        //Modification de la BD
        $req = $db->prepare("UPDATE users SET USERNAME=? WHERE ID=?");
        if($req){
            //$req->execute(array('USERNAME' => $NEWPSEUDO, 'ID' => $USERID));
            $req->execute([$NEWPSEUDO, $USERID]);
            return 0;
        }else{
            $req->errorInfo();
            return 2;
        }
    }
}