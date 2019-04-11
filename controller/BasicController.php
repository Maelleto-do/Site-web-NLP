<?php
include_once 'controller/AbstractController.php';
include_once 'view/BasicView.php';

class BasicController extends AbstractController{
    private $value;
    private $tabCheckLogin;
    private $result;
    private $modelGetID;
    private $USERID;
    private $subject_list;

    function __construct($post){

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
            case 'ExpiredSession':
                $value = 'ExpiredSession';
                break;
            case 'SendSubject':
                $value = 'SendSubject';
                include_once 'model/MultipleSubjectsModel.php';
                include_once 'model/SendSubjectModel.php';
                $this->model = new SendSubjectModel();
                $this->checkSubjectSent = $this->model->sendSubject($post);
                $this->model2 = new MultipleSubjectsModel();
                $this->subject_list = $this->model2->checkSubjects($post);
                break;
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


        if(isset($value)){
          if($value = 'AdminLogged'){
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
