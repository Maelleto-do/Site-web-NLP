<?php
include_once 'view/MultipleSubjectsDisplay.php';
include_once 'model/MultipleSubjectsModel.php';
include_once 'view/Welcome.php';

class MultipleSubjectsController{
    private $view;
    private $model;
    private $checkSubject;

    function __construct($post){
        $this->model = new MultipleSubjectsModel();
        $this->checkSubject = $this->model->checkSubjects($post);

        //Si checkLogin() renvoie 0, pas d'erreurs
        //if(!$this->checkSubject){
            $this -> view = new MultipleSubjectsDisplay();
        /*}else{
            $this -> view = new Welcome();
            $this -> view -> setMessageNumberLogin($this -> checkSubject); //On donne le message d'erreur à afficher à la vue

        }*/
    }

    function launch(){
        $this->view->launch();
    }
}
