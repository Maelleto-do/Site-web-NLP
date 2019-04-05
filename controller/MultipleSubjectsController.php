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

            $this -> view = new MultipleSubjectsDisplay();
    }

    function launch($post){
        $this->view->launch($post);
    }
}
