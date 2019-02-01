<?php
define('SESSION_MAXLIFETIME', 300); // 5 minutes avant déconnexion
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

if(isset($_SESSION['logged']) and $_SESSION['logged'] == 1){
    if( (time() - $_SESSION['last_action']) > SESSION_MAXLIFETIME ){
        session_destroy();
        $class_name = 'SessionExpiredController';
    }else{
        $_SESSION['last_action'] = time();
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

                case 'Contact':
                $class_name = 'ContactController';
                break;

                case 'Info':
                $class_name = 'InfoController';
                break;

                default:
                $class_name = 'WelcomeController';
                break;
            }
        }else{
            $class_name = 'WelcomeController';
        }
    }
}else{
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

            case 'Info':
            $class_name = 'InfoController';
            break;

            default:
            $class_name = 'WelcomeController';
            break;
        }
    }else{
        $class_name = 'WelcomeController';
    }
}



include_once 'controller/'.$class_name.'.php';
$controller = new $class_name();
$controller->launch();


?>
