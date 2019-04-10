<?php

define("HOST", "localhost"); // The host to connect to
define("USER", "root"); // The database username
define("PASSWORD", "root"); // The database password
define("DATABASE", "tdesbarat001"); // The database

class DBConnection{

  private $db;

  public function __construct(){
    try {
      $dsn = "mysql:host=".HOST.";dbname=".DATABASE;
      $this->db = new PDO($dsn, USER, PASSWORD);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      echo "La connexion à la base de données a echoué".$e->getMessage();
      exit();
  }
  }

  public function getDB(){
    return $this->db;
  }

}
