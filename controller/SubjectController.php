<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SubjectModel.php';
include_once 'model/MessageModel.php';
include_once 'view/Welcome.php';
include_once 'controller/AbstractController.php';


class SubjectController extends AbstractController {

    private $modelbis;
    private $checkSubject;

    function __construct($post){

        $this->model = new SubjectModel();
        $this->checkSubject = $this->model->checkSubject($post);


        $this->modelbis = new MessageModel();
        $this->checkMessages = $this->modelbis->getMessages($post);


        $this -> view = new SubjectDisplay();
    }

}

