<?php
include_once 'controller/AbstractController.php';
include_once 'view/BasicView.php';
require_once("model/SelectModel.php");
require_once("model/InsertModel.php");

class SendSubjectController extends AbstractController {

    private $model2;
    private $checkSubjectSent;
    private $subject_list;

    function __construct($post){
        $this->model = new InsertModel();
        $this->checkSubjectSent = $this->model->sendSubject($post);

        $this->model2 = new SelectModel();
        $this->subject_list = $this->model2->checkSubjects($post);

        $this -> view = new BasicView();
        $this->view->setSubjectList($this->subject_list);

    }

}
