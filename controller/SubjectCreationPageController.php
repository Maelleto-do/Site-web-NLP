<?php
include_once 'view/SubjectCreationPage.php';


class SubjectCreationPageController{
    private $view;

    function __construct($post){
        $this -> view = new SubjectCreationPage();
    }

    function launch($post){
        $this->view->launch($post);
    }
}
?>
