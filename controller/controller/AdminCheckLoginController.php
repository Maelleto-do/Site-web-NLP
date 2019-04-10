<?php
include_once 'view/AdminCheckLoginView.php';
include_once 'model/AdminCheckLoginModel.php';
include_once 'view/Welcome.php';
include_once 'controller/AbstractController.php';


class AdminCheckLoginController extends AbstractController {

    private $checkLoginAdminAnswer;

    function __construct($post){
        $this->checkLoginAdminAnswer = 0;
        $this->model = new AdminCheckLoginModel();
        $this->checkLoginAdminAnswer = $this->model->checkLoginAdmin($post);

        //Si checkLoginAdmin() renvoie 0, pas d'erreurs
        if(!$this->checkLoginAdminAnswer){
            $this -> view = new AdminCheckLoginView();
        }else{
            $this -> view = new Welcome();
            $this -> view -> setMessageNumberLogin($this -> checkLoginAdminAnswer); //On donne le message d'erreur à afficher à la vue
        }
    }

}
