<?php
include_once 'view/Welcome.php';
include_once 'controller/AbstractController.php';




class WelcomeController extends AbstractController {

    function __construct($post){
        $this -> view = new Welcome();
    }

}
