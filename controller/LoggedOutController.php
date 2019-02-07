<?php
include_once 'view/LoggedOutView.php';


class LoggedOutController{
    private $view;

    function __construct(){
        $this -> view = new LoggedOutView();
    }

    function launch(){
        $this->view->launch();
    }
}
?>
