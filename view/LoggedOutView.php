<?php
include_once 'Header.php';

class LoggedOutView{

  public function launch($post){
    $header = new Header();
    $header->launch($post);

    echo <<<VIEW
    <body>

    <div class="container-fluid text-center">
    <div class="row content">
    <div class="col-sm-2 sidenav">
    <p><a href="#"></a></p>
    </div>
    <div class="col-sm-8 text-left">
    <p>Vous vous êtes bien déconnecté.</p>
    </div>
    <div class="col-sm-2 sidenav">

    </div>
    </div>
    </div>

    </body>


VIEW;
  }
}
?>
