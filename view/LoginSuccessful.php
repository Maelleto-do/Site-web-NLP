<?php
include_once 'Header.php';

class LoginSuccessful{
  private $username;

  public function launch($post){

      $this->username = $post['TEMP_SUBJECT_INFO']['USERNAME'];


    $header = new Header();
    $header->launch($post);

    echo <<<VIEW

   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-2 sidenav">
   <div class="well">
       <p>$this->username</p>
       <p><a href="#" onclick="$('#Main_Form_TASK').val('Profile'); $('#Main_Form').submit();">My Profile</a></p>
       <img src="img/bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
     </div>
     <div class="well">
       <p><a href="#">Interests</a></p>
       <p>
         <span class="label label-default">Aya Nakamura</span><br><br>
         <span class="label label-primary">Norman fait des vidéos</span><br><br>
         <span class="label label-success">Mentir</span>
       </p>
     </div>
   <p><a href="#"></a></p>
   </div>
   <div class="col-sm-8 text-left">
   <h1>Bienvenue sur le forum</h1>
   Connexion réussie.
   </div>
   <div class="col-sm-2 sidenav">

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
