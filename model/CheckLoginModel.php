<?php

define("HOST", "dbserver"); // The host to connect to
define("USER", "tdesbarat001"); // The database username
define("PASSWORD", "Tristan29!"); // The database password
define("DATABASE", "tdesbarat001"); // The database name


class CheckLoginModel{
    public function checkLogin(){

        // Establishement of connexion to the database
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->getMessage();
            exit();
        }


        //On récupère l'ID et le PW que l'utilisateur a tapé dans le formulaire
        $ID = $_POST['ID'];
        $PW = $_POST['PW'];


        if (empty($ID) || empty($PW)){
            $checkLogin = 1;
            return $checkLogin;
        }

        //Recherche du mot de passe dans la BDD SI la connexion a marché en PDO
      $req = $bdd->prepare('SELECT MDP FROM utilisateurs WHERE ID = ? LIMIT 1');
      $req->execute(array($ID));
      $res = $req->fetch();

        //On test si le PW de la BDD correspond au PW de l'utilisateur
      if($res['MDP']){
        if($PW === $res['MDP']){
            $checkLogin = 0;
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
