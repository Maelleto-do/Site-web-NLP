<?php

include_once 'DBConnection.php';

class MessageModel{
    public function getMessages($post){

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        $subjectID = $post['IDSUBJECT'];
        $message_list_string = "";

        //Recherche des infos du sujet selectionné (actuellement le sujet avec subjectID=1)
        $req = $db->prepare('SELECT * FROM Message WHERE subjectID = ?  ORDER BY dateTime ASC');
        $req->execute(array($subjectID));
        $message_list = $req->fetchAll(PDO::FETCH_ASSOC);


        $_SESSION['MESSAGE_LIST'] = $message_list;
        $checkMessages = 0;

        return $checkMessages;
    }
}