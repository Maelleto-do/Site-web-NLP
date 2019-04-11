<?php

include_once 'DBConnection.php';

class MultipleSubjectsModel{
    public function checkSubjects($post){

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        $subject_list_string = "";

        //Recherche des infos de tous les sujets
        $req = $db->prepare('SELECT * FROM Sujet ORDER BY creationDate DESC');
        $req->execute();
        $subject_list = $req->fetchAll(PDO::FETCH_ASSOC);



        return $subject_list;
    }
}
?>
