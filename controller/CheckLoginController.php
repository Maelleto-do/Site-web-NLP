<?php
include_once 'view/LoginSuccessful.php';
include_once 'model/CheckLoginModel.php';
include_once 'view/Welcome.php';

class CheckLoginController{
    private $view;
    private $model;
    private $checkLoginAnswer;

    function __construct($post){
        $checkLoginAnswer = false;
        $this->model = new CheckLoginModel();
        $this->checkLoginAnswer = $this->model->checkLogin($post);

        //Si checkLogin() renvoie 0, pas d'erreurs
        if(!$this->checkLoginAnswer){
            $this -> view = new LoginSuccessful();
        }else{
            $this -> view = new Welcome();
            $this -> view -> setMessageNumberLogin($this -> checkLoginAnswer); //On donne le message d'erreur à afficher à la vue

        }
    }

    function launch(){
        $this->view->launch();
    }
}
?>
