<?php
include_once 'view/Welcome.php';


class WelcomeController{
    private $view;

    function __construct(){
        $this -> view = new Welcome();
    }

    function launch(){
        $this->view->launch();
    }
}
?>
