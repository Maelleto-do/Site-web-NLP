<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SubjectModel.php';
include_once 'view/Welcome.php';

class SubjectController{
    private $view;
    private $model;
    private $checkSubject;

    function __construct($post){
        $this->model = new SubjectModel();
        $this->checkSubject = $this->model->checkSubject($post);

        //Si checkLogin() renvoie 0, pas d'erreurs
        if(!$this->checkSubject){
            $this -> view = new SubjectDisplay();
        }else{
            $this -> view = new Welcome();
            $this -> view -> setMessageNumberLogin($this -> checkSubject); //On donne le message d'erreur à afficher à la vue

        }
    }

    function launch(){
        $this->view->launch();
    }
}
?>
