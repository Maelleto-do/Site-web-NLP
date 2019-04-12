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
                require_once("model/SelectModel.php");

                $this->model = new SelectModel();
                $this->tabCheckSubject = $this->model->checkSubject($post);
                $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];
                $this->model->setIdSubject($this->tabCheckSubject['IDSUBJECT']);
                $this->tabGetMessages = $this->model->getMessages($post);
                $this->ADMINID = $this->model->GetADMINID($post);
                $this->USERID = $this->model->GetUSERID($post);

                break;

                case 'DeleteMessage':
                case 'MessageSujet':
                $class_name = 'SubjectDisplay';
                require_once("model/SelectModel.php");

                $this->model = new SelectModel();
                $this->tabCheckSubject = $this->model->checkSubject($post);
                $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];
                $this->model-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
                $this->tabGetMessages = $this->model->getMessages($post);
                $this->USERID = $this->model->GetUSERID($post);
                $this->ADMINID = $this->model->GetADMINID($post);

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
                    case 'AdminSignUpNewUser':
                        include_once 'model/InsertModel.php';
                        $this->model = new InsertModel();
                        $this->result = $this->model->SignUpUser($post);
                        $value = 'AdminLogged';
                        break;
                    case 'AdminCheckLogin':
                        include_once 'model/TestLoginModel.php';
                        $this->model = new TestLoginModel();
                        $this->tabCheckLogin = $this->model->checkLoginAdmin($post);
                        if(isset($this->tabCheckLogin) && $this->tabCheckLogin['checkLogin'] == 0){
                          $value = 'AdminLogged';
                        }else{
                          $value = 'Welcome';
                        }
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
                    case 'Logged':
                        $value = 'Logged';
                        break;
                    case 'ExpiredSession':
                        $value = 'ExpiredSession';
                        break;
                    case 'CreateSubject':
                        $value = 'CreateSubject';
                        break;
                    case 'SendSubject':
                    case 'DisplayMultipleSubjects':
                        $value = 'DisplayMultipleSubjects';
                        require_once("model/SelectModel.php");
                        $this->model = new SelectModel();
                        $this->subject_list = $this->model->checkSubjects($post);
                        break;
                    case 'Profile':
                        $value = 'Profile';
                        break;

                    case 'ChangePseudo':
                        require_once("model/SelectModel.php");
                        $this->modelGetID = new SelectModel();
                        require_once("model/UpdateModel.php");
                        $this->model = new UpdateModel();
                        $this->model->getUserId($this->USERID);
                        $this->result = $this->model->changePseudo($post);
                        $value = 'ChangePseudo';
                        break;

                    case 'ChangePwd':
                        require_once("model/SelectModel.php");
                        $this->modelGetID = new SelectModel();
                        require_once("model/UpdateModel.php");
                        $this->model = new UpdateModel();
                        $this->USERID = $this->modelGetID->GetUSERID($post);
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
          if($value == 'AdminLogged'){
              include_once 'view/AdminCheckLoginView.php';
              $this->view= new AdminCheckLoginView();
              if(isset($this->result)){
                $this->view->setMessageNumberSignup($this->result);
              }
          }else{
              $this->view = new BasicView();
              $this->view->setValueToSwitch($value);
              if(isset($this->subject_list)){
                $this->view->setSubjectList($this->subject_list);
              }
              if($value == 'Welcome' && isset($this->tabCheckLogin['checkLogin'])){
                //On donne le message d'erreur à afficher à la vue
                $this->view->setMessageNumberLogin($this->tabCheckLogin['checkLogin']);
              }
              if($value == 'DisplayMultipleSubjects'){
                $this->view -> setSubjectList($this->subject_list);
              }
              if(isset($this->result) && $this->result != 0){
                  $this->view->setMessageNumber($this->result);
              }
          }
        }

    }
}
