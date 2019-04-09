<?php
include_once 'view/SubjectCreationPage.php';
include_once 'controller/AbstractController.php';

class SubjectCreationPageController extends AbstractController {

    function __construct($post){
        $this -> view = new SubjectCreationPage();
    }

    function launch($post){
        $this->view->launch($post);
    }
}

