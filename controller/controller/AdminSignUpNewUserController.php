<?php
include_once 'view/AdminSignUpNewUserView.php';
include_once 'view/AdminCheckLoginView.php';
include_once 'model/AdminSignUpNewUserModel.php';
include_once 'view/Welcome.php';
include_once 'controller/AbstractController.php';


class AdminSignUpNewUserController extends AbstractController {

    private $ADD_DB;

    function __construct($post){
        $this->ADD_DB = false;
        $this->model = new AdminSignUpNewUserModel();
        $this->ADD_DB = $this->model->SignUpUser($post);

        //Si SignUpUser() renvoie 0, pas d'erreurs
        if(!$this->ADD_DB){
            $this -> view = new AdminSignUpNewUserView();
        }else{
            $this -> view = new AdminCheckLoginView();
            $this -> view -> setMessageNumberSignup($this -> ADD_DB); //On donne le message d'erreur à afficher à la vue
        }
    }

}

