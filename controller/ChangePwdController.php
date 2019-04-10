<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/ChangePwdModel.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';
include_once 'controller/AbstractController.php';
include_once 'view/ProfileView.php';


class ChangePwdController extends AbstractController {

    private $CHANGE_DB;

    function __construct($post){
        $this->CHANGE_DB = false;
        $this->model = new ChangePwdModel();
        $this->CHANGE_DB = $this->model->changePwd($post);

        //Si SignUpUser() renvoie 0, pas d'erreurs
        if(!$this->CHANGE_DB){
            $this -> view = new ProfileView();
        }else{
            $this -> view = new ProfileView();
            $this -> view -> setMessageNumber($this -> CHANGE_DB); //On donne le message d'erreur à afficher à la vue
        }
    }
}

