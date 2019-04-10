<?php
include_once 'view/MultipleSubjectsDisplay.php';
include_once 'model/MultipleSubjectsModel.php';
include_once 'model/SendSubjectModel.php';
include_once 'model/SubjectModel.php';
include_once 'controller/AbstractController.php';

class SendSubjectController extends AbstractController {

    private $model2;
    private $checkSubjectSent;

    function __construct($post){
        $this->model = new SendSubjectModel();
        $this->checkSubjectSent = $this->model->sendSubject($post);

        if($this->checkSubjectSent != 0){
            echo 'La fonction sendSubject dans SendSubjectController a échoué.';
        }

        $this->model2 = new MultipleSubjectsModel();
        $this->checkSubjectSent = $this->model2->checkSubjects($post);
        $this -> view = new MultipleSubjectsDisplay();
    }

}

