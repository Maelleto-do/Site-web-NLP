<?php

define("HOST", "dbserver"); // The host to connect to
define("USER", "tdesbarat001"); // The database username
define("PASSWORD", "Tristan29!"); // The database password
define("DATABASE", "tdesbarat001"); // The database name

class MultipleSubjectsModel{
    public function checkSubjects($post){

        //Connection to PDO
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->getMessage();
            exit();
        }

        $subject_list_string = "";

        //Recherche des infos de tous les sujets
        $req = $bdd->prepare('SELECT * FROM Sujet ORDER BY creationDate DESC');
        $req->execute();
        $subject_list = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($subject_list as $row => $link) {
            $subject_list_string .=
            '<div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="well">
                                <a href="#" onclick="$(\'#Main_Form_IDSUBJECT\').val(\'' . $link['subjectID'] . '\'); $(\'#Main_Form_TASK\').val(\'MessageSujet\'); $(\'#Main_Form\').submit();">' . $link['nameSubject'] . '</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        $_SESSION['SUBJECT_LIST'] = $subject_list_string;
        $checkSubjects=0;

        return $checkSubjects;
    }
}
?>
