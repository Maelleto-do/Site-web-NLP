<?php

require_once("DBConnection.php");

class DeleteModel{

    public function deleteMessage($post){
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();
        //ID du message à supprimer
        $messageID = $post['MESSAGEID'];
        //Suppression du message de la base
        $req = $db->prepare('DELETE FROM Message WHERE messageID = ?');
        $req->execute(array($messageID));
        $checkMessageDelete = 0;

        return $checkMessageDelete;

    }

}

?>
