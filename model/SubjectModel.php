<?php
include_once 'DBConnection.php';

class SubjectModel{
    public function checkSubject($post){

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        $subjectID = $post['IDSUBJECT'];

        //Recherche des infos du sujet selectionné (actuellement le sujet avec subjectID=1)
        $req = $db->prepare('SELECT * FROM Sujet WHERE subjectID = ?');
        $req->execute(array($subjectID));
        $res = $req->fetch();

        //On test si le subjectID de la db est là
        if($res['subjectID']){
            $checkSubject = 0;
            $_SESSION['TEMP_SUBJECT_INFO']['IDSUBJECT'] = $res['subjectID'];
            $_SESSION['TEMP_SUBJECT_INFO']['NAMESUBJECT'] = $res['nameSubject'];
            $_SESSION['TEMP_SUBJECT_INFO']['SUBJECTMESSAGE'] = $res['subjectMessage'];
            $_SESSION['TEMP_SUBJECT_INFO']['NBMESSAGES'] = $res['nbMessages'];
            $_SESSION['TEMP_SUBJECT_INFO']['ISRESOLVED'] = $res['isResolved'];
            $_SESSION['TEMP_SUBJECT_INFO']['CREATIONDATE'] = $res['creationDate'];
        }else{
            //The subject does not exist
            $checkSubject = 3;
        }


        return $checkSubject;
    }
}
