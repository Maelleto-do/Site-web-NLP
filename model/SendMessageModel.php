<?php

include_once 'DBConnection.php';

class SendMessageModel{

  private $userId;

  public function getUserId($userId){
    $this->userId = $userId;
  }

  private $subjectID;

    public function setIdSubject($subjectID){

      $this->subjectID = $subjectID;

    }


    public function sendMessage($post){

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        $message= $post['MESSAGE'];

        $username = $post['USERNAME'];

        //Recherche des infos du sujet selectionné (actuellement le sujet avec subjectID=1)
        $req = $db->prepare("INSERT INTO Message (messageID, subjectID, messageContent, author, isEdited, `dateTime`, authorID) VALUES (NULL, :IDSUBJECT, :MESSAGE, :AUTHOR, :ISEDITED, :TIMEDATE, :AUTHORID); ");

        if($req){

          $req->execute(array('IDSUBJECT' => $this->subjectID, 'MESSAGE' => $message, 'AUTHOR' => $username, 'ISEDITED' => 0, 'TIMEDATE' => date("Y-m-d H:i:s"), 'AUTHORID' => $this->userId));

            $req = $db->prepare("UPDATE Sujet SET nbMessages = nbMessages + 1 WHERE subjectID = :IDSUBJECT");

            if($req){
              $req->execute(array('IDSUBJECT' => $this->subjectID));
            }

        }
        $checkMessageSent = 0;

        return $checkMessageSent;
    }
}
