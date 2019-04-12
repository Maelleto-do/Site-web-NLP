<?php
include_once 'controller/AbstractController.php';
include_once 'view/SubjectDisplay.php';
require_once("model/SelectModel.php");


class SubjectController extends AbstractController {

    private $modelbis;
    private $modelGetID;
    private $tabCheckSubject;
    private $tabGetMessages;
    private $ADMINID;
    private $USERID;

    function __construct($post){

        $this->model = new SelectModel();
        $this->tabCheckSubject = $this->model->checkSubject($post);
        $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];
        $this->model-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
        $this->tabGetMessages = $this->model->getMessages($post);
        $this->USERID = $this->model->GetUSERID($post);
        $this->ADMINID = $this->model->GetADMINID($post);

        $this -> view = new SubjectDisplay();
        $this->view->setCheckSubject($this->tabCheckSubject);
        $this->view->setGetMessages($this->tabGetMessages);
        $this->view->setADMINID($this->ADMINID);
        $this->view->setUSERID($this->USERID);


    }

}
