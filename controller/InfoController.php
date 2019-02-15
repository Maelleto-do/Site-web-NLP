<?php
include_once 'view/InfoView.php';


class InfoController{
    private $view;

    function __construct($post){
        $this -> view = new InfoView();
    }

    function launch($post){
        $this->view->launch($post);
    }
}
?>
