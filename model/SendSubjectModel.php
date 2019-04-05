<?php

include_once 'DBConnection.php';

class SendSubjectModel{
    public function sendSubject($post){

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        $subjectname = $post['subjectname'];
        $message = $post['MESSAGE'];
        $username = $post['USERNAME'];

        $req = $db->prepare('SELECT ID FROM users WHERE USERNAME = ?');
        if($req){
            $req->execute(array($username));
            $res = $req->fetch();
            $id = $res['ID'];
        }

        //Recherche des infos du sujet selectionné
        $req = $db->prepare("INSERT INTO Sujet (subjectID, nameSubject, subjectMessage, nbMessages, isResolved, `creationDate`, authorId) VALUES (NULL, :NAME, :MESSAGE, :NBMESSAGES, :ISRESOLVED, :CREATIONDATE, :AUTHORID); ");

        if($req){
            $req->execute(array('NAME' => $subjectname, 'MESSAGE' => $message, 'NBMESSAGES' => 1, 'ISRESOLVED' => 0, 'CREATIONDATE' => date("Y-m-d H:i:s"), 'AUTHORID' => $id));
        }

        $checkMessageSent = 0;

        return $checkMessageSent;
    }
}
