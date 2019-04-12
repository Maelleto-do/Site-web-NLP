<?php
include_once 'controller/AbstractController.php';
include_once 'view/SubjectDisplay.php';
require_once("model/SelectModel.php");
require_once("model/DeleteModel.php");

/**
* Suppression d'un message
*/
class DeleteMessageController extends AbstractController {

  private $modelbis;
  private $deleteMessage;
  private $tabCheckSubject;
  private $tabGetMessages;
  private $ADMINID;
  private $USERID;


  function __construct($post){

    $this->model = new SelectModel();
    $this->tabCheckSubject = $this->model->checkSubject($post);
    $this->checkSubject = $this->tabCheckSubject['checkSubject'];


    //Suppression du message
    $this->modelbis = new DeleteModel();
    $this->deleteMessage = $this->modelbis->deleteMessage($post);

    if($this->deleteMessage != 0){
      echo 'La fonction deleteMessage dans DeleteMessageController a échoué.';
    }

    //Affichage des messages mis à jour
    $this->model->setIdSubject($this->tabCheckSubject['IDSUBJECT']);
    $this->tabGetMessages = $this->model->getMessages($post);
    //Get USER & ADMIN ID !
    $this->USERID = $this->model->GetUSERID($post);
    $this->ADMINID = $this->model->GetADMINID($post);

    $this->view = new SubjectDisplay();
    $this->view-> setCheckSubject($this->tabCheckSubject);
    $this->view->setGetMessages($this->tabGetMessages);
    $this->view->setADMINID($this->ADMINID);
    $this->view->setUSERID($this->USERID);
  }
}
