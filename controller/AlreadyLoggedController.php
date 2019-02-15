<?php
include_once 'view/LoginSuccessful.php';

class AlreadyLoggedController{
    private $view;

    function __construct($post){
        $this -> view = new LoginSuccessful();
    }

    function launch($post){
        $this->view->launch($post);
    }
}
?>
