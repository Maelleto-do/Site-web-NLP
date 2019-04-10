<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SendMessageModel.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';
include_once 'model/SendMessagePythonModel.php';
include_once 'controller/AbstractController.php';

class SendMessageController extends AbstractController {

  private $modelbis;
  private $modelSubject;
  private $modelPython;
  private $message_erreur;
  private $checkMessageSent;
  private $checkMessageGood;
  private $tabCheckSubject;
  private $subjectId;

  function __construct($post){


    $this->modelSubject = new SubjectModel;
    $this->tabCheckSubject = $this->modelSubject->checkSubject($post);
    $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];



    $this->modelPython = new SendMessagePythonModel();
    $this->checkMessageGood = $this->modelPython->SendMessagePython($post);

    if($this->checkMessageGood == 0){

      $this->message_erreur = 'Le message envoyé contient un mot interdit.';
      $this->view = new SubjectDisplay();
      $this->view -> setMessageisGood($this->message_erreur);


    }else{

      $this->model = new SendMessageModel();
      $this->model->setIdSubject($this->subjectId);

      $this->checkMessageSent = $this->model->sendMessage($post);
      $this->modelbis = new MessageModel();
      $this->modelbis-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
      $this->checkMessages = $this->modelbis->getMessages($post);

      $this -> view = new SubjectDisplay();
      $this->view->setCheckSubject($this->tabCheckSubject);

    }



  }

  public function launch($post){
    $post['MESSAGE_ERREUR'] = $this->message_erreur;
    $this->view->launch($post);
  }

}
