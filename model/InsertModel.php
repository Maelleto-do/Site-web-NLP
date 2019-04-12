<?php

require_once("DBConnection.php");

class InsertModel{

    private $PW_HASH;
    private $EMAIL_HASH;
    private $userId;
    private $subjectID;

    public function getUserId($userId){
        $this->userId = $userId;
    }

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

    public function SignUpUser($post){
        //On récupère l'USERNAME, l'E-Mail et le PW que l'utilisateur a tapé dans le formulaire
        $USERNAME = $post['USERNAME_USER'];
        $MAIL = $post['MAIL_USER'];
        $PW = $post['PW_USER'];
        $PW_REPEAT = $post['PW_USER_REPEAT'];
        //Connexion raté car USERNAME ou PW ou MAIL est vide :
        if (empty($USERNAME) || empty($PW) || empty($MAIL) ){
            return 1;
        }
        if ($PW != $PW_REPEAT){
            return 3;
        }
        //Connection to PDO
        $DBConnection = new DBConnection();
        $bdd = $DBConnection->getDB();
        //Hash
        $options = [
            'cost' => 12,
        ];
        $this->PW_HASH = password_hash($PW, PASSWORD_BCRYPT, $options);
        $this->EMAIL_HASH = password_hash($MAIL, PASSWORD_BCRYPT, $options);
        //Vérification si l'USERNAME n'est pas déjà dans la BDD :
        $req = $bdd->prepare("SELECT USERNAME FROM users WHERE USERNAME = ?");
        $req->execute(array($USERNAME));
        $res = $req->fetch();
        if($res['USERNAME']){
            return 1;
        }
        //Vérification si l'EMAIL n'est pas déjà dans la BDD :
        $req = $bdd->prepare("SELECT EMAIL FROM users");
        $req->execute();
        while ($res = $req->fetch()){
            if(password_verify($MAIL,$res['EMAIL'])){
                return 2; //EMAIL DEJA DANS LA BDD
            }
        }
        //Insertion dans la BD
        $req = $bdd->prepare("INSERT INTO users(USERNAME, EMAIL, PWD)VALUES(:USERNAME, :EMAIL, :PWD)");
        if($req){
            $req->execute(array('USERNAME' => $USERNAME, 'EMAIL' => $this->EMAIL_HASH, 'PWD' => $this->PW_HASH));
            return 0;
        }else{
            $req->errorInfo();
            return 4;
        }
    }

    public function sendSubject($post){
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();
        $subjectname = $post['subjectname'];
        $message = $post['MESSAGE'];
        $username = $post['USERNAME'];
        $req = $db->prepare('SELECT ID FROM users WHERE USERNAME = ?');
        if($req){
            $req->execute(array($username));
            $res = $req->fetch();
            $id = $res['ID'];
        }
        //Recherche des infos du sujet selectionné
        $req = $db->prepare("INSERT INTO Sujet (subjectID, nameSubject, subjectMessage, nbMessages, isResolved, `creationDate`, authorId) VALUES (NULL, :NAME, :MESSAGE, :NBMESSAGES, :ISRESOLVED, :CREATIONDATE, :AUTHORID); ");
        if($req){
            $req->execute(array('NAME' => $subjectname, 'MESSAGE' => $message, 'NBMESSAGES' => 1, 'ISRESOLVED' => 0, 'CREATIONDATE' => date("Y-m-d H:i:s"), 'AUTHORID' => $id));
        }
        $checkMessageSent = 0;
        return $checkMessageSent;
    }
}

?>
