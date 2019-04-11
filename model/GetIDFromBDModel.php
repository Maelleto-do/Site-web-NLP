<?php

require_once("DBConnection.php");

class GetIDFromBDModel{

  public function GetUSERID($post){
      //Connexion à la db
      $DBConnection = new DBConnection();
      $db = $DBConnection->getDB();

      $USERNAME = $post['USERNAME'];

      //Récupération de l'id de l'utilisateur
      $req = $db->prepare('SELECT ID FROM users WHERE USERNAME = ?');
      $req->execute(array($USERNAME));
      $USERID = $req->fetch()[0];

      return $USERID;
  }

  public function GetADMINID($post){

      //Connexion à la db
      $DBConnection = new DBConnection();
      $db = $DBConnection->getDB();

      //Récupération de l'id de l'utilisateur
      $req = $db->prepare('SELECT ID FROM users WHERE USERNAME = ?');
      $req->execute(array('Admin'));
      $ADMINID = $req->fetch()[0];


      return $ADMINID;
  }


}
