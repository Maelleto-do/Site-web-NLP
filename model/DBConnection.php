<?php

define("HOST", "dbserver"); // The host to connect to
define("USER", "tdesbarat001"); // The database username
define("PASSWORD", "Tristan29"); // The database password
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
