<?php
include_once 'Header.php';

class SessionExpiredView{

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
    <p>Votre session a expiré, veuillez vous reconnecter !</p>
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
