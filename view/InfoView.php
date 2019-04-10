<?php
include_once 'Header.php';

class InfoView{

    public function launch($post){

      $header = new Header();
      $header->launch($post);

        echo <<<VIEW
    <body>


    <div class="container-fluid text-center">
    <div class="row content">
    <div class="col-sm-8 text-left">
    <h1>Informations</h1>
    Vous êtes sur le forum dédié aux enfants de l'école.
    Vous pouvez accéder aux différents sous forums, poser vos questions ou répondre à vos camarades.
    </div>
    </div>
    </div>
    <form id="Main_Form" action="index.php" method="POST">
    <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
    </form>
    </body>
VIEW;

 }
}
?>
