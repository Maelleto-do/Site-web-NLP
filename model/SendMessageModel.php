<?php

define("HOST", "dbserver"); // The host to connect to
define("USER", "tdesbarat001"); // The database username
define("PASSWORD", "Tristan29!"); // The database password
define("DATABASE", "tdesbarat001"); // The database name

class SendMessageModel{
    public function sendMessage($post){

        //Connection to PDO
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->sendMessage();
            exit();
        }

        //$IDSUBJECT = $post['IDSUBJECT'];
        $message= $post['MESSAGE'];
        $monfichier = fopen('texte_test.txt', 'r+');
        file_put_contents('texte_test.txt', '');
        fputs($monfichier, $message);

        fclose($monfichier);


        $output = shell_exec('python model/python/test.py');


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
        if($req && $output == NULL){
            $req->execute(array('IDSUBJECT' => /*$IDSUBJECT*/1, 'MESSAGE' => $message, 'AUTHOR' => $username, 'ISEDITED' => 0, 'TIMEDATE' => date("Y-m-d H:i:s")));
        }
        $checkMessageSent = 0;

        return $checkMessageSent;
    }
}
?>
