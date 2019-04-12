<?php

require_once("DBConnection.php");

class TestLoginModel{

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

      //Récupération de l'id de l'utilisateur
      $req = $db->prepare('SELECT ID FROM users WHERE USERNAME = ?');
      $req->execute(array($USERNAME));
      $USERID = $req->fetch()[0];

      //On test si le PW de la db correspond au PW de l'utilisateur
      if($res['PWD']){
          if(password_verify($PW,$res['PWD'])){
              //Sauvegarde des données propres à l'utilisateur
              $tabCheckLogin = array (

                'USERNAME' => $USERNAME,
                'USERID' => $USERID,
                'checkLogin' => 0,
              );

              $_SESSION['logged'] = 1;
              $_SESSION['USERNAME'] = $USERNAME;
              $_SESSION['last_action'] = time();
              return $tabCheckLogin;

          }else{
              //Incorrect password
              $tabCheckLogin['checkLogin']= 2;
          }
      }else{
          //The username does not exist
          $tabCheckLogin['checkLogin']= 3;
      }
      return $tabCheckLogin;
  }

  public function checkLoginAdmin($post){

      //Connexion à la db
      $DBConnection = new DBConnection();
      $db = $DBConnection->getDB();
      //On récupère l'USERNAME et le PW que l'utilisateur a tapé dans le formulaire
      $USERNAME = 'Admin';
      $PW = $post['Admin_PW'];
      //Connexion raté car USERNAME ou PW est vide -> LoginNotOk
      if (empty($PW)){
          return 1;
      }
      //Recherche du mot de passe dans la db SI la connexion a marché en PDO
      $req = $db->prepare('SELECT PWD FROM users WHERE USERNAME = ?');
      $req->execute(array($USERNAME));
      $res = $req->fetch();
      //Récupération de l'id de l'utilisateur
      $req = $db->prepare('SELECT ID FROM users WHERE USERNAME = ?');
      $req->execute(array($USERNAME));
      $ADMINID = $req->fetch()[0];
      //On test si le PW de la db correspond au PW de l'utilisateur
      if($res['PWD']){
          if(password_verify($PW,$res['PWD'])){
              //Sauvegarde des données propres à l'administrateur
              $_SESSION['logged'] = 1;
              $_SESSION['USERNAME'] = $USERNAME;
              $tabCheckLoginAdmin = array (
                'USERNAME' => $USERNAME,
                'ADMINID' => $ADMINID,
                'checkLogin' => 0,
              );
              $_SESSION['last_action'] = time();
              return $tabCheckLoginAdmin;

          }else{
              //Incorrect password
              $tabCheckLoginAdmin['checkLogin']= 2;
              //$checkLogin = 2;
          }
      }else{
          //The username does not exist
          $tabCheckLoginAdmin['checkLogin']= 3;
          //$checkLogin = 3;
      }
      return $tabCheckLoginAdmin;
  }


}
