<?php
include_once 'view/SessionExpiredView.php';


class SessionExpiredController{
    private $view;

    function __construct($post){
        $this -> view = new SessionExpiredView();
    }

    function launch(){
        $this->view->launch();
    }
}
?>
