<?php
include_once 'view/Welcome.php';

$output = shell_exec('python model/python/test.py');
echo "<pre>$output</pre>";


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
