<?php
include_once 'model/DeleteMessageModel.php';
include_once 'view/SubjectDisplay.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';
include_once 'model/GetIDFromBDModel.php';
include_once 'controller/AbstractController.php';

/**
* Suppression d'un message
*/
class DeleteMessageController extends AbstractController {

  private $modelbis;
  private $modelGetID;
  private $deleteMessage;
  private $tabCheckSubject;
  private $tabGetMessages;
  private $ADMINID;
  private $USERID;


  function __construct($post){

    $this->model = new SubjectModel();
    $this->tabCheckSubject = $this->model->checkSubject($post);
    $this->checkSubject = $this->tabCheckSubject['checkSubject'];


    //Suppression du message
    $this->model = new DeleteMessageModel();
    $this->deleteMessage = $this->model->deleteMessage($post);

    if($this->deleteMessage != 0){
      echo 'La fonction deleteMessage dans DeleteMessageController a échoué.';
    }

    //Affichage des messages mis à jour
    $this->modelbis = new MessageModel();
    $this->modelbis-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
    $this->tabGetMessages = $this->modelbis->getMessages($post);

    $this->modelGetID = new GetIDFromBDModel();
    $this->USERID = $this->modelGetID->GetUSERID($post);
    $this->ADMINID = $this->modelGetID->GetADMINID($post);

    $this -> view = new SubjectDisplay();
    $this->view-> setCheckSubject($this->tabCheckSubject);
    $this->view->setGetMessages($this->tabGetMessages);
    $this->view->setADMINID($this->ADMINID);
    $this->view->setUSERID($this->USERID);
  }
}
