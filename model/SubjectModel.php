<?php
include_once 'DBConnection.php';

class SubjectModel{

    public function checkSubject($post){

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        $subjectID = $post['IDSUBJECT'];

        //Recherche des infos du sujet selectionné (actuellement le sujet avec subjectID=1)
        $req = $db->prepare('SELECT Sujet.*, USERNAME FROM Sujet JOIN users ON Sujet.authorId = users.ID WHERE subjectID = ?');
        $req->execute(array($subjectID));
        $res = $req->fetch();

        //On test si le subjectID de la db est là
        if($res['subjectID']){


            $temp_subject_info = array(
              'IDSUBJECT' => $res['subjectID'],
              'NAMESUBJECT' => $res['nameSubject'],
              'SUBJECTMESSAGE' => $res['subjectMessage'],
              'NBMESSAGES' => $res['nbMessages'],
              'ISRESOLVED' => $res['isResolved'],
              'AUTHORUSERNAME'  => $res['USERNAME'],
              'CREATIONDATE' => $res['creationDate'],
              'checkSubject' => 0,
            );
/*
                    $checkSubject = 0;
            $_SESSION['TEMP_SUBJECT_INFO']['IDSUBJECT'] = $res['subjectID'];
            $_SESSION['TEMP_SUBJECT_INFO']['NAMESUBJECT'] = $res['nameSubject'];
            $_SESSION['TEMP_SUBJECT_INFO']['SUBJECTMESSAGE'] = $res['subjectMessage'];
            $_SESSION['TEMP_SUBJECT_INFO']['NBMESSAGES'] = $res['nbMessages'];
            $_SESSION['TEMP_SUBJECT_INFO']['ISRESOLVED'] = $res['isResolved'];
            $_SESSION['TEMP_SUBJECT_INFO']['AUTHORUSERNAME'] = $res['USERNAME'];
            $_SESSION['TEMP_SUBJECT_INFO']['CREATIONDATE'] = $res['creationDate'];
*/
        }else{
            //The subject does not exist
            $temp_subject_info['checkSubject'] = 3;
            //$checkSubject = 3;
        }

        return $temp_subject_info;
    }
}
