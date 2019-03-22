<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SendMessageModel.php';
include_once 'controller/MessageController.php';
include_once 'model/SubjectModel.php';

class SendMessageController{
    private $view;
    private $model;
    private $modelbis;
    private $checkMessageSent;

    function __construct($post){
        $this->model = new SendMessageModel();
        $this->checkMessageSent = $this->model->sendMessage($post);

        if($this->checkMessageSent != 0){
            echo 'La fonction sendMessage dans SendMessageController a échoué.';
        }

        $this->modelbis = new SubjectModel();
        $this->checkSubject = $this->modelbis->checkSubject($post);
        $controller = new MessageController($post);

        $this -> view = new SubjectDisplay();
    }

    function launch(){
        $this->view->launch();
    }
}
?>
