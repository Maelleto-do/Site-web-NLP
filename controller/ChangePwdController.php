<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/ChangePseudoModel.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';
include_once 'controller/AbstractController.php';

class ChangePwdController extends AbstractController {

    private $modelbis;
    private $checkMessageSent;

    function __construct($post){
        $this->model = new ChangePseudoModel();
        $this->checkMessageSent = $this->model->sendMessage($post);


        $this -> view = new SubjectDisplay();
    }

}

