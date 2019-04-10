<?php
include_once 'Header.php';

class ContactView{

  public function launch($post){

    $header = new Header();
    $header->launch($post);

      echo <<<VIEW
   <body>
   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-8 text-left">
   <h1>Contact</h1>
   <p>Pour contacter un administrateur, veuillez envoyer un mail à l'adresse admin@admin.fr.</p>
   </div>
   </div>
   </div>
   </body>

   <form id="Main_Form" action="index.php" method="POST">
   <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
   </form>

VIEW;

 }
}
?>
