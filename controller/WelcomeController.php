<?php
include_once 'view/Welcome.php';




class WelcomeController{
    private $view;

    function __construct($post){
        $this -> view = new Welcome();
    }

    function launch($post){
        $this->view->launch($post);
    }
}
?>
