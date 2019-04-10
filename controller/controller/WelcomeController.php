<?php
include_once 'view/Welcome.php';
include_once 'controller/AbstractController.php';

echo shell_exec('python3 model/python/doudou.py 2> doudou.log');


class WelcomeController extends AbstractController {

    function __construct($post){
        $this -> view = new Welcome();
    }

}
