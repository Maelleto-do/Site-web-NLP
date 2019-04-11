<?php
include_once 'controller/AbstractController.php';
include_once 'view/BasicView.php';

class BasicController extends AbstractController{
    private $value;
    private $tabCheckLogin;
    private $result;
    private $modelGetID;
    private $USERID;

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
                include_once 'model/CheckLoginModel.php';
                //Création du model et appel pour tester la connexion
                $this->model = new CheckLoginModel();
                $this->tabCheckLogin = $this->model->checkLogin($post);
                echo $this->tabCheckLogin['checkLogin'];
                //Si checkLogin() renvoie 0, pas d'erreurs
                if(isset($this->tabCheckLogin) && $this->tabCheckLogin['checkLogin'] == 0){
                  $value = 'Logged';
                }else{
                  $value = 'Welcome';
                  //On donne le message d'erreur à afficher à la vue
                  $this -> view -> setMessageNumberLogin($this->tabCheckLogin['checkLogin']);
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

        $this->view = new BasicView();
        $this->view->setValueToSwitch($value);
        if($this->result != 0){
            $this->view->setMessageNumber($this->result);
        }

    }

}
