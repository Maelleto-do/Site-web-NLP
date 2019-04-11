<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SubjectModel.php';
include_once 'model/MessageModel.php';
include_once 'model/GetIDFromBDModel.php';
include_once 'controller/AbstractController.php';


class SubjectController extends AbstractController {

    private $modelbis;
    private $modelGetID;
    private $tabCheckSubject;
    private $tabGetMessages;
    private $ADMINID;
    private $USERID;

    function __construct($post){

        $this->model = new SubjectModel();
        $this->tabCheckSubject = $this->model->checkSubject($post);
        $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];


        $this->modelbis = new MessageModel();
        $this->modelbis-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
        $this->tabGetMessages = $this->modelbis->getMessages($post);

        $this->modelGetID = new GetIDFromBDModel();
        $this->USERID = $this->modelGetID->GetUSERID($post);
        $this->ADMINID = $this->modelGetID->GetADMINID($post);

        $this -> view = new SubjectDisplay();
        $this->view->setCheckSubject($this->tabCheckSubject);
        $this->view->setGetMessages($this->tabGetMessages);
        $this->view->setADMINID($this->ADMINID);
        $this->view->setUSERID($this->USERID);


    }

}
