<?php
include_once 'controller/AbstractController.php';
include_once 'view/SubjectDisplay.php';
include_once 'model/SendMessagePythonModel.php';
require_once("model/SelectModel.php");
require_once("model/InsertModel.php");

class SendMessageController extends AbstractController {

    private $modelbis;
    private $modelPython;
    private $message_erreur;
    private $checkMessageGood;
    private $tabCheckSubject;
    private $subjectId;
    private $tabGetMessages;
    private $ADMINID;
    private $USERID;

    function __construct($post){
        $this->message_erreur = 'Le message envoyé contient un mot interdit.';

        $this->model = new SelectModel;
        $this->tabCheckSubject = $this->model->checkSubject($post);
        $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];
        $this->USERID = $this->model->GetUSERID($post);
        $this->ADMINID = $this->model->GetADMINID($post);

        //PYTHON pour NLTK
        $this->modelPython = new SendMessagePythonModel();
        $this->checkMessageGood = $this->modelPython->SendMessagePython($post);

        if($this->checkMessageGood == 0){
            $this->model-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
            $this->tabGetMessages = $this->model->getMessages($post);

            $this->view = new SubjectDisplay();
            $this->view->setMessageisGood($this->message_erreur);
            $this->view->setCheckSubject($this->tabCheckSubject);
            $this->view->setGetMessages($this->tabGetMessages);
            $this->view->setADMINID($this->ADMINID);
            $this->view->setUSERID($this->USERID);


        }else{

            $this->modelbis = new InsertModel();
            $this->modelbis->getUserId($this->USERID);
            $this->modelbis->setIdSubject($this->subjectId);
            $this->checkMessageSent = $this->modelbis->sendMessage($post);

            $this->model-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
            $this->tabGetMessages = $this->model->getMessages($post);


            $this -> view = new SubjectDisplay();
            $this->view->setCheckSubject($this->tabCheckSubject);
            $this->view->setGetMessages($this->tabGetMessages);
            $this->view->setADMINID($this->ADMINID);
            $this->view->setUSERID($this->USERID);

        }



    }

}
