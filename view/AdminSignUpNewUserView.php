<?php


class AdminSignUpNewUserView{


  public function launch($post){

    $header = new Header();
    $header->launch($post);


    echo <<<VIEW

   <!-- Modal inscription-->
   <div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
   <div class="modal-content">
   <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
   </button>
   </div>
   <div class="modal-body">
    <form action="index.php" method="POST">
    <input type="hidden" name="TASK" value="AdminSignUpNewUser">
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="MAIL_USER" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter parent email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
   <div class="form-group">
   <label for="username">Username</label>
        <input type="text" name="USERNAME_USER" class="form-control" id="username" aria-describedby="username" placeholder="Enter Username">
   </div>
   <div class="form-group">
   <label for="password">Password</label>
   <input type="password" name="PW_USER" class="form-control" id="password" placeholder="Enter Password">
   </div>
    <div class="form-group">
   <label for="password_repeat">Repeat password</label>
   <input type="password" name="PW_USER_REPEAT" class="form-control" id="password_repeat" placeholder="Enter Password again">
   </div>
   <input type="submit" value="signup">
   </form>
   </div>
   <div class="modal-footer">
   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   </div>
   </div>
   </div>
   </div>


   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-2 sidenav">
   <p><a href="#"></a></p>
   </div>
   <div class="col-sm-8 text-left">
   Vous avez ajouté un nouvel utilisateur !
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
