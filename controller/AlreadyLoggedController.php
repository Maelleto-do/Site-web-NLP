<?php

include_once 'controller/AbstractController.php';

class AlreadyLoggedController extends AbstractController {

    private $modelbis;
    private $checkSubject;

    function __construct($post){
        if($_SESSION['USERNAME'] == 'Admin'){
            $class_name = 'AdminCheckLoginView';
        }else{
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

                case 'DisplayMultipleSubjects':
                  $class_name = 'MultipleSubjectsDisplay';
                  include_once 'model/MultipleSubjectsModel.php';
                  $this->model = new MultipleSubjectsModel();
                  $this->model->checkSubjects($post);
                break;

                case 'CreateSubject':
                include_once 'view/SubjectCreationPage.php';
                $class_name = 'SubjectCreationPage';
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

                case 'Profile':
                $class_name = 'ProfileView';
                break;

                default:
                $class_name = 'LoginSuccessful';
                break;
            }
        }


        include_once 'view/'.$class_name.'.php';
        $this -> view = new $class_name();
    }

}
