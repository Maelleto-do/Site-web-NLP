<?php
include_once 'view/MultipleSubjectsDisplay.php';
include_once 'model/MultipleSubjectsModel.php';
include_once 'controller/AbstractController.php';

class MultipleSubjectsController extends AbstractController {

    private $subject_list;

    function __construct($post){

        $this->model = new MultipleSubjectsModel();
        $this->subject_list = $this->model->checkSubjects($post);


        $this -> view = new MultipleSubjectsDisplay();
        $this->view -> setSubjectList($this->subject_list);

    }

}
