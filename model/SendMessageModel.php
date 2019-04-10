<?php

include_once 'DBConnection.php';

class SendMessageModel{
    public function sendMessage($post){

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        $subjectID = $post['IDSUBJECT'];
        $message= $post['MESSAGE'];
        $username = $_SESSION['USERNAME'];
        $userID = $_SESSION['USERID'];



        $monfichier = fopen('texte_test.txt', 'r+');
        file_put_contents('texte_test.txt', '');
        fputs($monfichier, $message);

        fclose($monfichier);

        // $output = shell_exec('python model/python/nltk.py');
        //exec('python3 model/python/doudou.py', $output, $return_val );
        passthru('python3.6 model/python/doudou.py 2> doudou.log', $return_val );
        //echo $return_val;
        //echo shell_exec('python3 model/python/doudou.py 2> doudou.log');



        //Recherche des infos du sujet selectionné (actuellement le sujet avec subjectID=1)
        $req = $db->prepare("INSERT INTO Message (messageID, subjectID, messageContent, author, isEdited, `dateTime`, authorID) VALUES (NULL, :IDSUBJECT, :MESSAGE, :AUTHOR, :ISEDITED, :TIMEDATE, :AUTHORID); ");

        if($req){

          $req->execute(array('IDSUBJECT' => $subjectID, 'MESSAGE' => $message, 'AUTHOR' => $username, 'ISEDITED' => 0, 'TIMEDATE' => date("Y-m-d H:i:s"), 'AUTHORID' => $userID));

            $req = $db->prepare("UPDATE Sujet SET nbMessages = nbMessages + 1 WHERE subjectID = :IDSUBJECT");

            if($req){
              $req->execute(array('IDSUBJECT' => $subjectID));
            }

        }
        $checkMessageSent = 0;

        return $checkMessageSent;
    }
}
