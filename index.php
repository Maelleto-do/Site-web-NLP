<?php
define('SESSION_MAXLIFETIME', 2500); // 5 minutes avant déconnexion
session_start();
?>

<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/projet.css">
</head>
</html>


<?php

$file = fopen('log/messages.log','a');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
  fputs($file, __FILE__.'('.__LINE__.')'." | REQUEST_METHOD = GET.\n");
  if( isset($_SESSION['POST']) ){
    $post = $_SESSION['POST'];

    //Sert au refresh pour garder certaines infos. Temporaire.
    if(isset($post['TASK'])){
      $_SESSION['TASK'] = $post['TASK'];
    }
    if(isset($post['IDSUBJECT'])){
      $_SESSION['IDSUBJECT'] = $post['IDSUBJECT'];
    }

    $task = $post['TASK'];
    unset($_SESSION['POST']);

    switch($task){

      case 'Deconnexion':

      $class_name = 'BasicController';
      $post = NULL;
      session_unset();
      session_destroy();
      break;

      case 'MessageSujet':

      $class_name = 'SubjectController';
      break;

      case 'AdminSignUpNewUser':

      $class_name = 'AdminSignUpNewUserController';
      break;

      case 'SendMessage':

      $class_name = 'SendMessageController';
      break;

      case 'DeleteMessage':

      $class_name = 'DeleteMessageController';
      break;

      default:

      $class_name = 'BasicController';
      break;
    }
  }else{

    if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1){
      fputs($file, __FILE__.'('.__LINE__.')'." | Already Logged.\n");
      $class_name = 'AlreadyLoggedController';
    }else{
      $post = NULL;
      fputs($file, __FILE__.'('.__LINE__.')'." | Non connecté, retour à l'accueil.\n");
      $class_name = 'BasicController';
    }
  }

  if(isset($_SESSION['logged']) and $_SESSION['logged'] == 1){
    if( (time() - $_SESSION['last_action']) > SESSION_MAXLIFETIME ){
      session_destroy();
      unset($_SESSION['logged']);
      unset($_SESSION['last_action']);
      unset($_SESSION['USERNAME']);
      $class_name = 'BasicController';
      $post['TASK'] = 'ExpiredSession';
      fputs($file, __FILE__.'('.__LINE__.')'." | Session expiré.\n");
    }else{
      $_SESSION['last_action'] = time();
      fputs($file, __FILE__.'('.__LINE__.')'." | Actualisation du time() pour éviter la session expiré.\n");
    }
  }
}else{
  fputs($file, __FILE__.'('.__LINE__.')'."On transforme le POST en GET.\n");
  $_SESSION['POST'] = $_POST;
  header('Location: index.php');
  die;
}

//Sert au refresh pour garder certaines infos. Temporaire.
if(isset($_SESSION['TASK'])){
  $post['TASK'] = $_SESSION['TASK'];
}
if(isset($_SESSION['IDSUBJECT'])){
  $post['IDSUBJECT'] = $_SESSION['IDSUBJECT'];
}

//Sauvegarde le nom de l'utilisateur connecté
if(isset($_SESSION['USERNAME'])){
  $post['USERNAME'] = $_SESSION['USERNAME'];
}

//Création du controller
include_once 'controller/'.$class_name.'.php';
$controller = new $class_name($post);

//Sauvegarde le nom de l'utilisateur connecté pour les changement de pseudo
if(isset($_SESSION['USERNAME'])){
  $post['USERNAME'] = $_SESSION['USERNAME'];
}
if(isset($_SESSION['IDSUBJECT'])){
  $post['IDSUBJECT'] = $_SESSION['IDSUBJECT'];
}

//Lancement du controller
$controller->launch($post);


?>
