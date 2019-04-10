<?php
include_once 'view/ContactView.php';
include_once 'controller/AbstractController.php';


class ContactController extends AbstractController {

    function __construct($post){
        $this -> view = new ContactView();
    }

}

