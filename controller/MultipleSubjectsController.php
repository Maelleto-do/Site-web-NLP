<?php
include_once 'view/MultipleSubjectsDisplay.php';
include_once 'model/MultipleSubjectsModel.php';
include_once 'controller/AbstractController.php';

class MultipleSubjectsController extends AbstractController {

    private $checkSubject;

    function __construct($post){
        $this->model = new MultipleSubjectsModel();
        $this->model->checkSubjects($post);
        $this -> view = new MultipleSubjectsDisplay();
    }

}
