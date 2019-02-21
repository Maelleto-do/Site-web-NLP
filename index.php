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

$file = fopen('log/messages.log','a');


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    fputs($file, __FILE__.'('.__LINE__.')'."\n");
    if( isset($_SESSION['POST']) ){
        $post = $_SESSION['POST'];

        $task = $post['TASK'];
        unset($_SESSION['POST']);
        fputs($file, __FILE__.'('.__LINE__.')'."\n");
        switch($task){

            case 'Deconnexion':
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'LoggedOutController';
            session_unset();
            session_destroy();
            break;

            case 'TestSujet':
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'SubjectController';
            break;

            case 'CheckLogin':
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'CheckLoginController';
            break;

            case 'AdminCheckLogin':
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'AdminCheckLoginController';
            break;

            case 'AdminSignUpNewUser':
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'AdminSignUpNewUserController';
            break;

            case 'SendMessage':
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'SendMessageController';
            break;

            case 'Info':
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'InfoController';
            break;

            case 'Contact':
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'ContactController';
            break;

            default:
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'WelcomeController';
            break;
        }
    }else{
        $post = NULL;
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1){
            fputs($file, __FILE__.'('.__LINE__.')'."Already Logged.\n");
            $class_name = 'AlreadyLoggedController';
        }else{
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
            $class_name = 'WelcomeController';
        }
    }

    if(isset($_SESSION['logged']) and $_SESSION['logged'] == 1){
        if( (time() - $_SESSION['last_action']) > SESSION_MAXLIFETIME ){
            session_destroy();
            unset($_SESSION['logged']);
            unset($_SESSION['last_action']);
            unset($_SESSION['USERNAME']);
            $class_name = 'SessionExpiredController';
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
        }else{
            $_SESSION['last_action'] = time();
            fputs($file, __FILE__.'('.__LINE__.')'."\n");
        }
    }
}else{
    fputs($file, __FILE__.'('.__LINE__.')'."\n");
    $_SESSION['POST'] = $_POST;
    header('Location: index.php');
    die;
}



fputs($file, __FILE__.'('.__LINE__.')'."\n");
include_once 'controller/'.$class_name.'.php';
$controller = new $class_name($post);

if(isset($_SESSION['USERNAME'])){
    $post['USERNAME'] = $_SESSION['USERNAME'];
}

/*if(isset($_SESSION['IDSUBJECT'])){
    $post['IDSUBJECT'] = $_SESSION['IDSUBJECT'];
}*/

$controller->launch($post);


?>
