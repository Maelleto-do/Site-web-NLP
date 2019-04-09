<?php
include_once 'view/InfoView.php';
include_once 'controller/AbstractController.php';


class InfoController extends AbstractController {

    function __construct($post){
        $this -> view = new InfoView();
    }

}

