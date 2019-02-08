<?php

define("HOST", "dbserver"); // The host to connect to
define("USER", "tdesbarat001"); // The database username
define("PASSWORD", "Tristan29!"); // The database password
define("DATABASE", "tdesbarat001"); // The database name


class CheckLoginModel{

    public function checkLogin($post){

        // Establishement of connexion to the database
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->getMessage();
            exit();
        }


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

        //Recherche du mot de passe dans la BDD SI la connexion a marché en PDO
        $req = $bdd->prepare('SELECT PWD FROM users WHERE USERNAME = ?');
        $req->execute(array($USERNAME));
        $res = $req->fetch();



        //On test si le PW de la BDD correspond au PW de l'utilisateur
        if($res['PWD']){
            if(password_verify($PW,$res['PWD'])){
                $checkLogin = 0;
                $_SESSION['logged'] = 1;
                $_SESSION['USERNAME'] = $USERNAME;
                $_SESSION['last_action'] = time();
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
?>
