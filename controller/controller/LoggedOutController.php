<?php
include_once 'view/LoggedOutView.php';
include_once 'controller/AbstractController.php';


class LoggedOutController extends AbstractController {

    function __construct($post){
        $this -> view = new LoggedOutView();
    }

}

