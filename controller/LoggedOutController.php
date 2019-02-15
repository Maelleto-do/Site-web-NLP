<?php
include_once 'view/LoggedOutView.php';


class LoggedOutController{
    private $view;

    function __construct($post){
        $this -> view = new LoggedOutView();
    }

    function launch($post){
        $this->view->launch($post);
    }
}
?>
