<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SendMessageModel.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';
include_once 'model/SendMessagePythonModel.php';
include_once 'controller/AbstractController.php';

class SendMessageController extends AbstractController {

    private $modelbis;
    private $checkMessageSent;
    private $checkMessageGood;

    function __construct($post){


        $this->model = new SendMessageModel();
        $this->modelPython = new SendMessagePythonModel();
        $this->checkMessageGood = $this->modelPython->SendMessagePython($post);

        if($this->checkMessageGood == 0){

            echo 'Le message envoyé contient un mot interdit.';
            $this -> view = new SubjectDisplay();

        }else{


        $this->checkMessageSent = $this->model->sendMessage($post);



        if($this->checkMessageSent != 0 ){
            echo 'La fonction sendMessage dans SendMessageController a échoué.';
        }


                    $this->modelbis = new MessageModel();
                    $this->checkMessages = $this->modelbis->getMessages($post);
                    $this -> view = new SubjectDisplay();


        }



    }

}
