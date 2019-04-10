<?php
include_once 'Header.php';

class LoginSuccessful{

  public function launch($post){

    $header = new Header();
    $header->launch($post);

    echo <<<VIEW

   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-8 text-left">
   <h1>Bienvenue sur le forum</h1>
   Connexion réussie.
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
<!-- input type="hidden" name="TASK" value="Deconnexion" //input type="hidden" name="TASK" value="Info" //input type="hidden" name="TASK" value="Contact" -->
