<?php
include_once 'view/SessionExpiredView.php';
include_once 'controller/AbstractController.php';


class SessionExpiredController extends AbstractController {

    function __construct($post){
        $this -> view = new SessionExpiredView();
    }

}

