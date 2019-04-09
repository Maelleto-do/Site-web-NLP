<?php
include_once 'model/DeleteMessageModel.php';
include_once 'view/SubjectDisplay.php';
include_once 'model/MessageModel.php';
include_once 'model/SubjectModel.php';
include_once 'controller/AbstractController.php';

/**
 * Suppression d'un message
 */
class DeleteMessageController extends AbstractController {

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
}

