<?php
include("bdd_connection.php");

class AdminCheckLoginModel{
    public function checkLoginAdmin($post){

        //Connection to PDO
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->getMessage();
            exit();
        }


        //On récupère l'USERNAME et le PW que l'utilisateur a tapé dans le formulaire
        $USERNAME = 'Admin';
        $PW = $post['Admin_PW'];

        //Connexion raté car USERNAME ou PW est vide -> LoginNotOk
        if (empty($PW)){
            return 1;
        }

        //Recherche du mot de passe dans la BDD SI la connexion a marché en PDO
        $req = $bdd->prepare('SELECT PWD FROM users WHERE USERNAME = ?');
        $req->execute(array($USERNAME));
        $res = $req->fetch();

        //On test si le PW de la BDD correspond au PW de l'utilisateur
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
?>
