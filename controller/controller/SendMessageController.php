<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SendMessageModel.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';
include_once 'controller/AbstractController.php';

class SendMessageController extends AbstractController {

    private $modelbis;
    private $checkMessageSent;

    function __construct($post){
        $this->model = new SendMessageModel();
        $this->checkMessageSent = $this->model->sendMessage($post);

        if($this->checkMessageSent != 0){
            echo 'La fonction sendMessage dans SendMessageController a échoué.';
        }

        $this->modelbis = new MessageModel();
        $this->checkMessages = $this->modelbis->getMessages($post);


        $this -> view = new SubjectDisplay();
    }

}

