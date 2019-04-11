<?php
include("DBConnection.php");


class ChangePseudoModel
{


  private $userId;

  public function getUserId($userId){
    $this->userId = $userId;
  }

    public function changePseudo($post){

        $NEWPSEUDO = $post['NEW_PSEUDO'];
        $USERNAME = $post['USERNAME'];

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        //Vérification si l'USERNAME n'est pas déjà dans la BDD
        $req = $db->prepare("SELECT USERNAME, ID FROM users");
        $req->execute(array($USERNAME));
        while ($res = $req->fetch()) {
            if ($res['USERNAME'] == $NEWPSEUDO && $res['ID'] != $this->userId) {
                return 1;
            }
        }

        //On remet le nom de l'utilisateur à jour
        $_SESSION['USERNAME'] = $NEWPSEUDO;

        //Modification de la BD
        $req = $db->prepare("UPDATE users SET USERNAME=? WHERE ID=?");
        if($req){
            $req->execute([$NEWPSEUDO, $this->userId]);
            return 0;
        }else{
            $req->errorInfo();
            return 2;
        }
    }
}
