<?php
include_once 'view/Welcome.php';

echo shell_exec('python3 model/python/doudou.py 2> doudou.log');


class WelcomeController{
    private $view;

    function __construct($post){
        $this -> view = new Welcome();
    }

    function launch($post){
        $this->view->launch($post);
    }
}
?>
