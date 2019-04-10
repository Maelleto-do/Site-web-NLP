<?php

include_once 'DBConnection.php';

/**
 * Suppression d'un message de la base de données
 */
class DeleteMessageModel{
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
