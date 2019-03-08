<?php

include_once 'DBConnection.php';

class MessageModel{
    public function getMessages($post){

        //Connection to PDO
        $DBConnection = new DBConnection();
        $bdd = $DBConnection->getDB();

        //$IDSUBJECT = $post['IDSUBJECT'];
        $message_list_string = "";

        //Recherche des infos du sujet selectionné (actuellement le sujet avec subjectID=1)
        $req = $bdd->prepare('SELECT * FROM Message WHERE subjectID = ?');
        //$req->execute($IDSUBJECT);
        $req->execute(array(1));
        $message_list = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($message_list as $row => $link) {
            $message_list_string .= '<div class="panel-body">
                <div class="row">
                    <div class="col-6">
                        <div class="well">
                            <p>' . $link['messageContent'] . '</p>
                        </div>
                    </div>
                </div>
            </div>';
        }

        $_SESSION['MESSAGE_LIST'] = $message_list_string;
        $checkMessages = 0;

        return $checkMessages;
    }
}