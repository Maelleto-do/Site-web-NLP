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
            if (($res['USERNAME'] === $NEWPSEUDO) || ($res['ID'] != $this->userId) || (mb_strtolower($NEWPSEUDO) === 'admin') ) {
                return 1; 
                exit(); 
            }
        }

        if (empty($NEWPSEUDO)){
            return 2; 
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $NEWPSEUDO)){ 
            return 3; 
        }
        if  (strlen($NEWPSEUDO) > 20){
            return 4; 
        }
        if (strlen($NEWPSEUDO) < 3){
            return 5; 
        }

        //On remet le nom de l'utilisateur à jour
        $_SESSION['USERNAME'] = $NEWPSEUDO;

        //Modification de la BD
        $req = $db->prepare("UPDATE users SET USERNAME=? WHERE ID=?");
        if($req){
            $req->execute([$NEWPSEUDO, $this->userId]);
            $this->ret = 0; 
        }else{
            $req->errorInfo();
            $this->ret = 6; 
        }
    }
}
