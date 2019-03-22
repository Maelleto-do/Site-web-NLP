<?php
include_once 'view/SubjectDisplay.php';
include_once 'model/MessageModel.php';
include_once 'view/Welcome.php';

class MessageController{
    private $model;
    private $checkMessages;

    function __construct($post){

        $this->model = new MessageModel();
        $this->checkMessages = $this->model->getMessages($post);

        //Si checkLogin() renvoie 0, pas d'erreurs
        /*if(!$this->checkMessages){
            $this -> view = new SubjectDisplay();
        }else{
            $this -> view = new Welcome();
            $this -> view -> setMessageNumberLogin($this -> checkMessages); //On donne le message d'erreur à afficher à la vue

        }*/

        if($this->checkMessages){
            $this -> view = new Welcome();
            $this -> view -> setMessageNumberLogin($this -> checkMessages); //On donne le message d'erreur à afficher à la vue
        }
    }
}
?>
