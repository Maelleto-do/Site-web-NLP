<?php
define("HOST", "dbserver"); // The host to connect to
define("USER", "tdesbarat001"); // The database username
define("PASSWORD", "Tristan29!"); // The database password
define("DATABASE", "tdesbarat001"); // The database name

class AdminSignUpNewUserModel{

    public function SignUpUser(){

        //Connection to PDO
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->getMessage();
            exit();
        }


        //On récupère l'ID, l'E-Mail et le PW que l'utilisateur a tapé dans le formulaire
        $ID = $_POST['ID_USER'];
        $MAIL = $_POST['MAIL_USER'];
        $PW = $_POST['PW_USER'];
        $PW_REPEAT = $_POST['PW_USER_REPEAT'];


        // echo '$ID = ' . $ID . '<br/>';
        // echo '$PW = ' . $PW . '<br/>';
        // echo '$MAIL = ' . $MAIL . '<br/>';
        // echo '$_POST[\'ID_USER\'] = ' . $_POST['ID_USER'] . '<br/>';
        // echo '$_POST[\'MAIL_USER\'] = ' . $_POST['MAIL_USER'] . '<br/>';
        // echo '$_POST[\'PW_USER\'] = ' . $_POST['PW_USER'] . '<br/>';

        //Connexion raté car ID ou PW est vide :
        if (empty($ID) || empty($PW) || empty($MAIL) ){
            return 1;
        }


        //Vérification si l'ID n'est pas déjà dans la BDD :
        $req = $bdd->prepare("SELECT ID FROM utilisateurs WHERE ID = ?");
        $req->execute(array($ID));
        $res = $req->fetch();
        if($res['ID']){
            return 2;
        }

        //Vérification si l'EMAIL n'est pas déjà dans la BDD :
        $req = $bdd->prepare("SELECT EMAIL FROM utilisateurs WHERE EMAIL = ?");
        $req->execute(array($MAIL));
        $res = $req->fetch();
        if($res['EMAIL']){
            return 3;
        }

        if ($PW != $PW_REPEAT){
            return 4;
        }

        //Recherche du mot de passe dans la BDD SI la connexion a marché en PDO
        $req = $bdd->prepare("INSERT INTO utilisateurs(ID, EMAIL, MDP)VALUES(:ID, :EMAIL, :MDP)");
        if($req){
            $req->execute(array('ID' => $ID, 'EMAIL' => $MAIL, 'MDP' => $PW));
            return 0;
        }else{
            $req->errorInfo();
            return 5;
        }

    }
}
?>
