<?php
include_once 'view/ProfileView.php';
include_once 'controller/AbstractController.php';


class ProfileController extends AbstractController {

    function __construct($post){
        $this -> view = new ProfileView();
    }

}

