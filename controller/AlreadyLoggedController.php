<?php
include_once 'controller/AbstractController.php';
class AlreadyLoggedController extends AbstractController {

    private $modelbis;
    private $tabCheckSubject;
    private $subjectId;

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
                $this->tabCheckSubject = $this->model->checkSubject($post);
                $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];

                $this->modelbis = new MessageModel();
                $this->modelbis-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
                $this->checkMessages = $this->modelbis->getMessages($post);
                break;

                case 'MessageSujet':
                $class_name = 'SubjectDisplay';
                include_once 'model/MessageModel.php';
                include_once 'model/SubjectModel.php';
                $this->model = new SubjectModel();
                $this->checkSubject = $this->model->checkSubject($post);
                $this->subjectId = $this->tabCheckSubject['IDSUBJECT'];

                $this->modelbis = new MessageModel();
                $this->modelbis-> setIdSubject($this->tabCheckSubject['IDSUBJECT']);
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
                        //Création du model et appel pour tester la connexion
                        $this->model = new CheckLoginModel();
                        $this->checkLoginAnswer = $this->model->checkLogin($post);
                        //Si checkLogin() renvoie 0, pas d'erreurs
                        if(isset($this->checkLoginAnswer) && $this->checkLoginAnswer == 0){
                          $value = 'Logged';
                        }else{
                          $value = 'Welcome';
                          //On donne le message d'erreur à afficher à la vue
                          $this -> view -> setMessageNumberLogin($this -> checkLoginAnswer);
                        }
                        break;
                    case 'ExpiredSession':
                        $value = 'ExpiredSession';
                        break;
                    case 'Profile':
                    case 'ChangePwd':
                    case 'ChangePseudo':
                        $value = 'Profile';
                        break;
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
        }
        if(isset($value)){
          $this -> view -> setValueToSwitch($value);
        }
    }
}
