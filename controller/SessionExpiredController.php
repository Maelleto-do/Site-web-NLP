<?php
include_once 'view/SessionExpiredView.php';


class SessionExpiredController{
    private $view;

    function __construct(){
        $this -> view = new SessionExpiredView();
    }

    function launch(){
        $this->view->launch();
    }
}
?>
