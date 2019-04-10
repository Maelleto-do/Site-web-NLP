<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SendMessageModel.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';
include_once 'model/SendMessagePythonModel.php';
include_once 'controller/AbstractController.php';

class SendMessageController extends AbstractController {

    private $modelbis;
    private $modelPython;
    private $message_erreur;
    private $checkMessageSent;
    private $checkMessageGood;

    function __construct($post){


        $this->model = new SendMessageModel();
        $this->modelPython = new SendMessagePythonModel();
        $this->checkMessageGood = $this->modelPython->SendMessagePython($post);

        if($this->checkMessageGood == 0){
            $this->message_erreur = 'Le message envoyé contient un mot interdit.';
            $this -> view = new SubjectDisplay();

        }else{


        $this->checkMessageSent = $this->model->sendMessage($post);


        //A patché, faire passer l'erreur à la vue
        if($this->checkMessageSent != 0 ){
            echo 'La fonction sendMessage dans SendMessageController a échoué.';
        }


                    $this->modelbis = new MessageModel();
                    $this->checkMessages = $this->modelbis->getMessages($post);
                    $this -> view = new SubjectDisplay();


        }



    }

    public function launch($post){
        $post['MESSAGE_ERREUR'] = $this->message_erreur;
        $this->view->launch($post);
    }

}
