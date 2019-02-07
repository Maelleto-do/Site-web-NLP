<?php
include_once 'view/AdminCheckLoginView.php';
include_once 'model/AdminCheckLoginModel.php';
include_once 'view/Welcome.php';


class AdminCheckLoginController{
    private $view;
    private $model;
    private $checkLoginAdminAnswer;

    function __construct(){
        $this->checkLoginAdminAnswer = 0;
        $this->model = new AdminCheckLoginModel();
        $this->checkLoginAdminAnswer = $this->model->checkLoginAdmin();

        //Si checkLoginAdmin() renvoie 0, pas d'erreurs
        if(!$this->checkLoginAdminAnswer){
            $this -> view = new AdminCheckLoginView();
        }else{
            $this -> view = new Welcome();
            $this -> view -> setMessageNumberLogin($this -> checkLoginAdminAnswer); //On donne le message d'erreur à afficher à la vue
        }
    }

    function launch(){
        $this->view->launch();
    }
}
?>
