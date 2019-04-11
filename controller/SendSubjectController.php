<?php
include_once 'controller/AbstractController.php';
include_once 'model/MultipleSubjectsModel.php';
include_once 'model/SendSubjectModel.php';
include_once 'model/SubjectModel.php';
include_once 'view/BasicView.php';

class SendSubjectController extends AbstractController {

    private $model2;
    private $checkSubjectSent;
    private $subject_list;

    function __construct($post){
        $this->model = new SendSubjectModel();
        $this->checkSubjectSent = $this->model->sendSubject($post);

        $this->model2 = new MultipleSubjectsModel();
        $this->subject_list = $this->model2->checkSubjects($post);

        $this -> view = new BasicView();
        $this->view -> setSubjectList($this->subject_list);

    }

}
