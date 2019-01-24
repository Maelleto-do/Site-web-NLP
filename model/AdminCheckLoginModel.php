<?php

define("HOST", "dbserver"); // The host to connect to
define("USER", "tdesbarat001"); // The database username
define("PASSWORD", "Tristan29!"); // The database password
define("DATABASE", "tdesbarat001"); // The database name

class AdminCheckLoginModel{
    public function checkLoginAdmin(){

        //Connection to PDO
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->getMessage();
            exit();
        }


        //On récupère l'ID et le PW que l'utilisateur a tapé dans le formulaire
        $ID = "ADMIN";
        $PW = $_POST['Admin_PW'];
        // echo '$ID = ' . $ID . '<br/>';
        // echo '$PW = ' . $PW . '<br/>';
        // echo '$_POST[\'Admin_PW\'] = ' . $_POST['Admin_PW'] . '<br/>';

        //Connexion raté car ID ou PW est vide -> LoginNotOk
        if (empty($PW)){
            return 1;
        }

        //Recherche du mot de passe dans la BDD SI la connexion a marché en PDO
        $req = $bdd->prepare("SELECT MDP FROM utilisateurs WHERE ID = ?");
        $req->execute(array($ID));
        $res = $req->fetch();

        //On test si le PW de la BDD correspond au PW de l'utilisateur
        if($res['MDP']){
            if($PW === $res['MDP']){
                $checkLogin = 0;
            }else{
                $checkLogin = 2;
            }
        }
        return $checkLogin;
    }
}
?>
