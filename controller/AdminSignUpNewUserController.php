<?php
include_once 'view/AdminSignUpNewUserView.php';
include_once 'view/AdminCheckLoginView.php';
include_once 'model/AdminSignUpNewUserModel.php';
include_once 'view/Welcome.php';


class AdminSignUpNewUserController{
    private $view;
    private $model;
    private $ADD_DB;

    function __construct(){
        $this->ADD_DB = false;
        $this->model = new AdminSignUpNewUserModel();
        $this->ADD_DB = $this->model->SignUpUser();

        //Si SignUpUser() renvoie 0, pas d'erreurs
        if(!$this->ADD_DB){
            $this -> view = new AdminSignUpNewUserView();
        }else{
            $this -> view = new AdminCheckLoginView();
            $this -> view -> setMessageNumberSignup($this -> ADD_DB); //On donne le message d'erreur à afficher à la vue
        }
    }

    function launch(){
        $this->view->launch();
    }
}
?>
