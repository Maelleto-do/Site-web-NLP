<?php

include("DBConnection.php");

class CheckLoginModel{

    public function checkLogin($post){

        //Connexion à la db
        $DBConnection = new DBConnection();
        $db = $DBConnection->getDB();

        //On récupère l'USERNAME et le PW que l'utilisateur a tapé dans le formulaire
        $USERNAME = $post['USERNAME'];
        $PW = $post['PW'];


        if (empty($USERNAME) || empty($PW)){
            $checkLogin = 1;
            return $checkLogin;
        }

        //Hash
        $options = [
            'cost' => 12,
        ];

        //Recherche du mot de passe dans la db SI la connexion a marché en PDO
        $req = $db->prepare('SELECT PWD FROM users WHERE USERNAME = ?');
        $req->execute(array($USERNAME));
        $res = $req->fetch();



        //On test si le PW de la db correspond au PW de l'utilisateur
        if($res['PWD']){
            if(password_verify($PW,$res['PWD'])){
                $_SESSION['logged'] = 1;
                $_SESSION['USERNAME'] = $USERNAME;
                $_SESSION['last_action'] = time();
                return 0;
            }else{
                //Incorrect password
                $checkLogin = 2;
            }
        }else{
            //The username does not exist
            $checkLogin = 3;
        }


        return $checkLogin;
    }

}
