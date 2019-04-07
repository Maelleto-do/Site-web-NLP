<?php
include_once 'model/DeleteMessageModel.php';
include_once 'view/SubjectDisplay.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';

/**
 * Suppression d'un message
 */
class DeleteMessageController{
    private $view;
    private $model;
    private $deleteMessage;

    function __construct($post){

        //Suppression du message
        $this->model = new DeleteMessageModel();
        $this->deleteMessage = $this->model->deleteMessage($post);

        if($this->deleteMessage != 0){
            echo 'La fonction deleteMessage dans DeleteMessageController a échoué.';
        }

        //Affichage des messages mis à jour 
        $this->modelbis = new MessageModel();
        $this->checkMessages = $this->modelbis->getMessages($post);

        $this -> view = new SubjectDisplay();
    }

    function launch($post){
        $this->view->launch($post);
    }
}
?>
