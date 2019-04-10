<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/ChangePseudoModel.php';

include_once 'controller/AbstractController.php';

class ChangePseudoController extends AbstractController {

    private $CHANGE_DB;

    function __construct($post){
        $this->CHANGE_DB = false;
        $this->model = new ChangePseudoModel();
        $this->CHANGE_DB = $this->model->changePseudo($post);

        //Si SignUpUser() renvoie 0, pas d'erreurs
        if(!$this->CHANGE_DB){
            $this -> view = new InfoView();
        }
    }
}
