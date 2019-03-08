<?php

include("DBConnection.php");

class SendMessageModel{
    public function sendMessage($post){

        //Connection to pdo
        $DBConnection = new DBConnection();
        $bdd = $DBConnection->getDB();

        //$IDSUBJECT = $post['IDSUBJECT'];
        $message= $post['MESSAGE'];
        $username = $_SESSION['USERNAME'];


        //Recherche des infos du sujet selectionné (actuellement le sujet avec subjectID=1)
        $req = $bdd->prepare("INSERT INTO Message (messageID, subjectID, messageContent, author, isEdited, `dateTime`) VALUES (NULL, :IDSUBJECT, :MESSAGE, :AUTHOR, :ISEDITED, :TIMEDATE); ");


        /*$req = $bdd->prepare('INSERT INTO  `tdesbarat001`.`Message` (
                                `messageID` ,
                                `subjectID` ,
                                `messageContent` ,
                                `author` ,
                                `isEdited` ,
                                `dateTime`)
                              VALUES (
                                NULL ,
                                :IDSUBJECT,
                                :MESSAGE,
                                :AUTHOR,
                                `0`,
                                date(Y-m-d H:i:s); ');*/
        //$req->execute($IDSUBJECT);
        if($req){
            $req->execute(array('IDSUBJECT' => /*$IDSUBJECT*/1, 'MESSAGE' => $message, 'AUTHOR' => $username, 'ISEDITED' => 0, 'TIMEDATE' => date("Y-m-d H:i:s")));
        }
        $checkMessageSent = 0;

        return $checkMessageSent;
    }
}
