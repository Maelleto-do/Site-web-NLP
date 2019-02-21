<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/SendMessageModel.php';
include_once 'view/Welcome.php';

class SendMessageController{
    private $view;
    private $model;
    private $checkMessageSent;

    function __construct($post){
        $this->model = new SendMessageModel();
        $this->checkMessageSent = $this->model->sendMessage($post);

        //Si checkLogin() renvoie 0, pas d'erreurs
        if(!$this->checkMessageSent){
            $this -> view = new SubjectDisplay();
        }else{
            $this -> view = new Welcome();
            $this -> view -> setMessageNumberLogin($this -> checkSubject); //On donne le message d'erreur à afficher à la vue

        }
    }

    function launch(){
        $this->view->launch();
    }
}
?>
