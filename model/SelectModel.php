<?php

require_once("DBConnection.php");

class SelectModel{

    private $subjectID;
    private $USERNAME;

    public function setIdSubject($subjectID){
        $this->subjectID = $subjectID;
    }

    public function getMessages($post){
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        //Recherche des infos du sujet selectionné
        $req = $db->prepare('SELECT * FROM Message WHERE subjectID = ?  ORDER BY dateTime ASC');
        $req->execute(array($this->subjectID));
        $message_list = $req->fetchAll(PDO::FETCH_ASSOC);
        $tabGetMessages = array (
            'MESSAGE_LIST' => $message_list,
            'checkMessages' => 0,
        );
        return $tabGetMessages;
    }

    public function checkSubjects($post){
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();
        //Recherche des infos de tous les sujets
        $req = $db->prepare('SELECT * FROM Sujet ORDER BY creationDate DESC');
        $req->execute();
        $subject_list = $req->fetchAll(PDO::FETCH_ASSOC);
        return $subject_list;
    }

    public function GetUSERID($post){
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();
        $this->USERNAME = $_SESSION['USERNAME'];
        //Récupération de l'id de l'utilisateur
        $req = $db->prepare('SELECT ID FROM users WHERE USERNAME = ?');
        $req->execute(array($this->USERNAME));
        $USERID = $req->fetch()[0];
        return $USERID;
    }

    public function GetADMINID($post){
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();
        //Récupération de l'id de l'utilisateur
        $req = $db->prepare('SELECT ID FROM users WHERE USERNAME = ?');
        $req->execute(array('Admin'));
        $ADMINID = $req->fetch()[0];
        return $ADMINID;
    }

    public function checkSubject($post){
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();
        $subjectID = $post['IDSUBJECT'];
        //Recherche des infos du sujet selectionné
        $req = $db->prepare('SELECT Sujet.*, USERNAME FROM Sujet JOIN users ON Sujet.authorId = users.ID WHERE subjectID = ?');
        $req->execute(array($subjectID));
        $res = $req->fetch();
        //On test si le subjectID de la BD est là
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
        }else{
            //The subject does not exist
            $temp_subject_info['checkSubject'] = 3;
        }
        return $temp_subject_info;
    }

}

?>
