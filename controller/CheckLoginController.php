<?php
include_once 'view/LoginSuccessful.php';
include_once 'model/CheckLoginModel.php';
include_once 'view/Welcome.php';
include_once 'controller/AbstractController.php';

class CheckLoginController extends AbstractController {

    private $checkLoginAnswer;

    function __construct($post){
        $checkLoginAnswer = false;
        $this->model = new CheckLoginModel();
        $this->checkLoginAnswer = $this->model->checkLogin($post);

        //Si checkLogin() renvoie 0, pas d'erreurs
        if($this->checkLoginAnswer == 0){
            $this -> view = new LoginSuccessful();
        }else{
            $this -> view = new Welcome();
            $this -> view -> setMessageNumberLogin($this -> checkLoginAnswer); //On donne le message d'erreur à afficher à la vue

        }
    }

}

