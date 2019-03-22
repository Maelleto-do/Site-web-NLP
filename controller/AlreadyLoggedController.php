<?php

class AlreadyLoggedController{
    private $view;
    private $model;
    private $modelbis;
    private $checkSubject;

    function __construct($post){
        switch($post['TASK']){

            case 'SendMessage':
            $class_name = 'SubjectDisplay';
            include_once 'model/MessageModel.php';
            include_once 'model/SubjectModel.php';
            $this->model = new SubjectModel();
            $this->checkSubject = $this->model->checkSubject($post);
            $this->modelbis = new MessageModel();
            $this->checkMessages = $this->modelbis->getMessages($post);

            case 'MessageSujet':
            $class_name = 'SubjectDisplay';
            include_once 'model/MessageModel.php';
            include_once 'model/SubjectModel.php';
            $this->model = new SubjectModel();
            $this->checkSubject = $this->model->checkSubject($post);
            $this->modelbis = new MessageModel();
            $this->checkMessages = $this->modelbis->getMessages($post);
            break;

            case 'TestMultipleSubjets':
            $class_name = 'MultipleSubjectsDisplay';
            include_once 'model/MultipleSubjectsModel.php';
            $this->model = new MultipleSubjectsModel();
            $this->checkSubject = $this->model->checkSubjects($post);
            break;

            case 'Info':
            $class_name = 'InfoView';
            break;

            case 'Contact':
            $class_name = 'ContactView';
            break;

            case 'Logged':
            $class_name = 'LoginSuccessful';
            break;

            default:
            $class_name = 'LoginSuccessful';
            break;
        }

        include_once 'view/'.$class_name.'.php';
        $this -> view = new $class_name();
    }

    function launch($post){
        $this->view->launch($post);
    }
}
?>
