<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SendMessageModel.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';
include_once 'model/SendMessagePythonModel.php';
include_once 'model/GetIDFromBDModel.php';
include_once 'controller/AbstractController.php';

class SendMessageController extends AbstractController {

  private $modelbis;
  private $modelSubject;
  private $modelPython;
  private $message_erreur;
  private $checkMessageGood;
  private $tabCheckSubject;
  private $subjectId;
  private $tabGetMessages;
  private $ADMINID;
  private $USERID;

  function __construct($post){


    $this->modelSubject = new SubjectModel;
    $this->tabCheckSubject = $this->modelSubject->checkSubject($post);
    $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];



    $this->modelPython = new SendMessagePythonModel();
    $this->checkMessageGood = $this->modelPython->SendMessagePython($post);

    $this->modelGetID = new GetIDFromBDModel();
    $this->USERID = $this->modelGetID->GetUSERID($post);
    $this->ADMINID = $this->modelGetID->GetADMINID($post);






    if($this->checkMessageGood == 0){

      $this->message_erreur = 'Le message envoyé contient un mot interdit.';

      $this->modelbis = new MessageModel();
      $this->modelbis-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
      $this->tabGetMessages = $this->modelbis->getMessages($post);

      $this->view = new SubjectDisplay();
      $this->view->setMessageisGood($this->message_erreur);
      $this->view->setCheckSubject($this->tabCheckSubject);
      $this->view->setGetMessages($this->tabGetMessages);
      $this->view->setADMINID($this->ADMINID);
      $this->view->setUSERID($this->USERID);


    }else{

      $this->model = new SendMessageModel();
      $this->model->getUserId($this->USERID);
      $this->model->setIdSubject($this->subjectId);
      $this->checkMessageSent = $this->model->sendMessage($post);

      $this->modelbis = new MessageModel();
      $this->modelbis-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
      $this->tabGetMessages = $this->modelbis->getMessages($post);


      $this -> view = new SubjectDisplay();
      $this->view->setCheckSubject($this->tabCheckSubject);
      $this->view->setGetMessages($this->tabGetMessages);
      $this->view->setADMINID($this->ADMINID);
      $this->view->setUSERID($this->USERID);

    }



  }

}
