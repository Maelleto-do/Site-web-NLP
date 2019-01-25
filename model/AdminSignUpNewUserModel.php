<?php
define("HOST", "dbserver"); // The host to connect to
define("USER", "tdesbarat001"); // The database username
define("PASSWORD", "Tristan29!"); // The database password
define("DATABASE", "tdesbarat001"); // The database name

class AdminSignUpNewUserModel{

    private $PW_HASH;
    private $EMAIL_HASH;
    public function SignUpUser(){

        //On récupère l'ID, l'E-Mail et le PW que l'utilisateur a tapé dans le formulaire
        $ID = $_POST['ID_USER'];
        $MAIL = $_POST['MAIL_USER'];
        $PW = $_POST['PW_USER'];
        $PW_REPEAT = $_POST['PW_USER_REPEAT'];

        //Connexion raté car ID ou PW ou MAIL est vide :
        if (empty($ID) || empty($PW) || empty($MAIL) ){
            return 1;
        }

        if ($PW != $PW_REPEAT){
            return 4;
        }

        //Connection to PDO
        try {
            $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
            $bdd = new PDO($dsn, USER, PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "La connexion à la base de données a echoué".$e->getMessage();
            exit();
        }

        //Hash
        $options = [
          'cost' => 12,
        ];
        $this->PW_HASH = password_hash($PW, PASSWORD_BCRYPT, $options);
        $this->EMAIL_HASH = password_hash($MAIL, PASSWORD_BCRYPT, $options);
        echo $this->PW_HASH;
        echo $this->EMAIL_HASH;


        //Vérification si l'ID n'est pas déjà dans la BDD :
        $req = $bdd->prepare("SELECT USERNAME FROM users WHERE USERNAME = ?");
        $req->execute(array($ID));
        $res = $req->fetch();
        if($res['ID']){
            return 2;
        }

        //Vérification si l'EMAIL n'est pas déjà dans la BDD :
        $req = $bdd->prepare("SELECT EMAIL FROM users");
        $req->execute();

        while ($res = $req->fetch()){
            if(password_verify($MAIL,$res['EMAIL'])){
                return 3; //EMAIL DEJA DANS LA BDD
            }
        }


        //Insertion dans la BD
        $req = $bdd->prepare("INSERT INTO users(USERNAME, EMAIL, PWD)VALUES(:USERNAME, :EMAIL, :PWD)");
        if($req){
            $req->execute(array('USERNAME' => $ID, 'EMAIL' => $this->EMAIL_HASH, 'PWD' => $this->PW_HASH));
            //return 0;
        }else{
            $req->errorInfo();
            return 5;
        }



    }
}
?>
