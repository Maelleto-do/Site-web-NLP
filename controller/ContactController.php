<?php
include_once 'view/ContactView.php';


class ContactController{
    private $view;

    function __construct($post){
        $this -> view = new ContactView();
    }

    function launch(){
        $this->view->launch();
    }
}
?>
