<?php
include("DBConnection.php");


class ChangePwdModel
{

    private $PW_HASH;
    private $userId;

    public function getUserId($userId){
      $this->userId = $userId;
    }

    public function changePwd($post){

        //On récupère le pseudo tapé par l'utilisateur dans le formulaire
        $NEWPWD = $post['NEW_PWD'];
        //Id de l'utilisateur en cours
      
        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

		//Vérification si le mot de passe est bien entre 3 et 20 caractères et avec des caractères autorisés

        if (empty($NEWPWD)){
            return 7; 
        }

        if  (strlen($NEWPWD) > 20){
            return 8; 
        }
        if  (strlen($NEWPWD) < 3){
            return 9; 
        }else if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $NEWPWD)){ 
            return 10; 
        }

        //Hash
        $options = [
            'cost' => 12,
        ];
        $this->PW_HASH = password_hash($NEWPWD, PASSWORD_BCRYPT, $options);

        //Modification du mot de passe dans la BD (0 si réussie, 6 si échouée)
        $req = $db->prepare("UPDATE users SET PWD=? WHERE ID=?");
        if($req){
            //$req->execute(array('USERNAME' => $PW_HASH, 'ID' => $USERID));
            $req->execute([$this->PW_HASH, $this->userId]);
            return 0;
        }else {
            $req->errorInfo();
            return 6;
        }
    }
}
