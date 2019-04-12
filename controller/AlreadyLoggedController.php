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
                    case 'CheckLogin':
                        include_once 'model/TestLoginModel.php';
                        $this->model = new TestLoginModel();
                        $this->tabCheckLogin = $this->model->checkLogin($post);
                        if(isset($this->tabCheckLogin) && $this->tabCheckLogin['checkLogin'] == 0){
                          $value = 'Logged';
                        }else{
                          $value = 'Welcome';
                        }
                        break;
                    case 'ExpiredSession':
                        $value = 'ExpiredSession';
                        break;
                    case 'SendSubject':
                    case 'CreateSubject':
                        $value = 'CreateSubject';
                        break;
                    case 'DisplayMultipleSubjects':
                        $value = 'DisplayMultipleSubjects';
                        include_once 'model/MultipleSubjectsModel.php';
                        $this->model = new MultipleSubjectsModel();
                        $this->subject_list = $this->model->checkSubjects($post);
                        break;
                    case 'Profile':
                        $value = 'Profile';
                        break;

                    case 'Logged':
                        $value = 'Logged';
                        break;
                    case 'AlreadyLogged':
                        $value = 'AlreadLogged';
                        break;
                    case 'ChangePseudo':
                        include_once 'model/ChangePseudoModel.php';
                        include_once 'model/GetIDFromBDModel.php';

                        $this->modelGetID = new GetIDFromBDModel();
                        $this->USERID = $this->modelGetID->GetUSERID($post);

                        $this->model = new ChangePseudoModel();
                        $this->model->getUserId($this->USERID);
                        $this->result = $this->model->changePseudo($post);

                        $value = 'ChangePseudo';
                        break;

                    case 'ChangePwd':
                        include_once 'model/ChangePwdModel.php';
                        include_once 'model/GetIDFromBDModel.php';

                        $this->modelGetID = new GetIDFromBDModel();
                        $this->USERID = $this->modelGetID->GetUSERID($post);

                        $this->model = new ChangePwdModel();
                        $this->model->getUserId($this->USERID);
                        $this->result = $this->model->changePwd($post);
                        $value = 'ChangePwd';
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
          if($value == 'Welcome' && isset($this->tabCheckLogin['checkLogin'])){
            //On donne le message d'erreur à afficher à la vue
            $this->view->setMessageNumberLogin($this->tabCheckLogin['checkLogin']);
          }
          if($value == 'DisplayMultipleSubjects'){
            $this->view -> setSubjectList($this->subject_list);
          }
        }
        if(isset($this->result) && $this->result != 0){
            $this->view->setMessageNumber($this->result);
        }

    }
}
