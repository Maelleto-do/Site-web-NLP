<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
</html>


<?php

if(isset($_POST['TASK'])){
    switch($_POST['TASK']){

      case 'CheckLogin':
          $class_name = 'CheckLoginController';
          break;

      case 'AdminCheckLogin':
          $class_name = 'AdminCheckLoginController';
          break;

      case 'AdminSignUpNewUser':
          $class_name = 'AdminSignUpNewUserController';
          break;

      default:
          $class_name = 'WelcomeController';
          break;
    }
}else{
    $class_name = 'WelcomeController';
}

include_once 'controller/'.$class_name.'.php';
$controller = new $class_name();
$controller->launch();


?>
