<?php

include("bdd_connection.php");


class SubjectModel{
    public function checkSubject($post){

        //Connection to PDO
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->getMessage();
            exit();
        }

        //Recherche des infos du sujet selectionné (actuellement le sujet avec subjectID=1)
        $req = $bdd->prepare('SELECT * FROM Sujet WHERE subjectID = ?');
        $req->execute(array(1));
        $res = $req->fetch();

        //On test si le subjectID de la BDD est là
        if($res['subjectID']){
            $checkSubject = 0;
            $_SESSION['IDSUBJECT'] = $res['subjectID'];
            $_SESSION['NAMESUBJECT'] = $res['nameSubject'];
            $_SESSION['SUBJECTMESSAGE'] = $res['subjectMessage'];
            $_SESSION['NBMESSAGES'] = $res['nbMessages'];
            $_SESSION['ISRESOLVED'] = $res['isResolved'];
            $_SESSION['CREATIONDATE'] = $res['creationDate'];
            $_SESSION['last_action'] = time();

        }else{
            //The subject does not exist
            $checkSubject = 3;
        }


        return $checkSubject;
    }
}
?>
