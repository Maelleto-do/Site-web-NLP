<?php

class MessageModel{
    public function getMessages($post){

        //Connection to PDO
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->getMessage();
            exit();
        }

        //$IDSUBJECT = $post['IDSUBJECT'];
        $message_list_string = "";

        //Recherche des infos du sujet selectionné (actuellement le sujet avec subjectID=1)
        $req = $bdd->prepare('SELECT * FROM Message WHERE subjectID = ?');
        //$req->execute($IDSUBJECT);
        $req->execute(array(1));
        $message_list = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($message_list as $row => $link) {
            $message_list_string = '<p>'.  $link['messageContent'].'</p>';
        }

        $_SESSION['MESSAGE_LIST'] = $message_list_string;
        $checkMessages = 0;

        return $checkMessages;
    }
}
?>
