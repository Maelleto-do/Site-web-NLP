<?php
include_once 'controller/AbstractController.php';
include_once 'model/CheckLoginModel.php';
include_once 'model/ChangePseudoModel.php';
include_once 'model/ChangePwdModel.php';
include_once 'view/BasicView.php';

class BasicController extends AbstractController{
    private $value;
    private $checkLoginAnswer;
    private $result;

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
                $value = 'Profile';
                break;

            case 'Logged':
                $value = 'Logged';
                break;

            case 'ChangePseudo':
                $this->model = new ChangePseudoModel();
                $this->result = $this->model->changePseudo($post);

                $value = 'ChangePseudo';
                break;

            case 'ChangePwd':
                $this->model = new ChangePwdModel();
                $this->result = $this->model->changePwd($post);
                $value = 'ChangePwd';
                break;

            default:
                $value = 'Welcome';
                break;
        }

        $this->view = new BasicView();
        $this->view->setValueToSwitch($value);
        if($this->result != 0){
            $this->view->setMessageNumber($this->result);
        }

    }

}
