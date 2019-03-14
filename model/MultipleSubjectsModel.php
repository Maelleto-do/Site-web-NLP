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
