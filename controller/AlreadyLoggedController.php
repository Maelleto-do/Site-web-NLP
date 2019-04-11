<?php
include_once 'controller/AbstractController.php';
class AlreadyLoggedController extends AbstractController {

    private $modelbis;
    private $modelGetID;
    private $tabCheckSubject;
    private $subjectId;
    private $tabGetMessages;
    private $ADMINID;
    private $USERID;
    private $subject_list;



    function __construct($post){

        if($_SESSION['USERNAME'] == 'Admin'){
            $class_name = 'AdminCheckLoginView';
        }else{
            switch($post['TASK']){

                case 'SendMessage':
                $class_name = 'SubjectDisplay';
                include_once 'model/MessageModel.php';
                include_once 'model/SubjectModel.php';
                include_once 'model/GetIDFromBDModel.php';

                $this->model = new SubjectModel();
                $this->tabCheckSubject = $this->model->checkSubject($post);
                $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];

                $this->modelbis = new MessageModel();
                $this->modelbis-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
                $this->tabGetMessages = $this->modelbis->getMessages($post);

                $this->modelGetID = new GetIDFromBDModel();
                $this->ADMINID = $this->modelGetID->GetADMINID($post);
                $this->USERID = $this->modelGetID->GetUSERID($post);

                break;

                case 'DeleteMessage':
                case 'MessageSujet':
                $class_name = 'SubjectDisplay';
                include_once 'model/MessageModel.php';
                include_once 'model/SubjectModel.php';
                include_once 'model/GetIDFromBDModel.php';

                $this->model = new SubjectModel();
                $this->tabCheckSubject = $this->model->checkSubject($post);
                $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];

                $this->modelbis = new MessageModel();
                $this->modelbis-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
                $this->tabGetMessages = $this->modelbis->getMessages($post);

                $this->modelGetID = new GetIDFromBDModel();
                $this->USERID = $this->modelGetID->GetUSERID($post);
                $this->ADMINID = $this->modelGetID->GetADMINID($post);

                break;

                case 'DisplayMultipleSubjects':
                  $class_name = 'MultipleSubjectsDisplay';
                  include_once 'model/MultipleSubjectsModel.php';
                  $this->model = new MultipleSubjectsModel();
                  $this->subject_list = $this->model->checkSubjects($post);
                break;

                case 'SendSubject':
                case 'CreateSubject':
                include_once 'view/SubjectCreationPage.php';
                $class_name = 'SubjectCreationPage';
                break;

                default:
                switch($post['TASK']){
                    case 'Info':
                        $value = 'Info';
                        break;
                    case 'Contact':
                        $value = 'Contact';
                        break;
                    case 'Deconnexion':
                        $value = 'Deconnexion';
                        break;
                    case 'ExpiredSession':
                        $value = 'ExpiredSession';
                        break;
                    case 'Profile':
                    case 'ChangePwd':
                    case 'ChangePseudo':
                        $value = 'Profile';
                        break;
                    case 'CheckLogin':
                    case 'Logged':
                        $value = 'Logged';
                        break;
                    default:
                        $value = 'Welcome';
                        break;
                }
                $class_name = 'BasicView';
                break;
            }
        }
        include_once 'view/'.$class_name.'.php';
        $this -> view = new $class_name();

        if($class_name == 'SubjectDisplay'){
          $this->view->setCheckSubject($this->tabCheckSubject);
          $this->view->setGetMessages($this->tabGetMessages);
          $this->view->setADMINID($this->ADMINID);
          $this->view->setUSERID($this->USERID);
        }
        if($class_name == 'MultipleSubjectsDisplay'){
          $this->view -> setSubjectList($this->subject_list);

        }
        if(isset($value)){
          $this -> view -> setValueToSwitch($value);
        }
    }
}
