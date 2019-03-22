<?php

include_once 'DBConnection.php';

class SendSubjectModel{
    public function sendSubject($post){

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        $subjectname = $post['subjectname'];
        $message= $post['MESSAGE'];


        //Recherche des infos du sujet selectionné
        $req = $db->prepare("INSERT INTO Sujet (subjectID, nameSubject, subjectMessage, nbMessages, isResolved, `creationDate`) VALUES (NULL, :NAME, :MESSAGE, :NBMESSAGES, :ISRESOLVED, :CREATIONDATE); ");

        if($req){
            $req->execute(array('NAME' => $subjectname, 'MESSAGE' => $message, 'NBMESSAGES' => 1, 'ISRESOLVED' => 0, 'CREATIONDATE' => date("Y-m-d H:i:s")));
        }

        $checkMessageSent = 0;

        return $checkMessageSent;
    }
}
