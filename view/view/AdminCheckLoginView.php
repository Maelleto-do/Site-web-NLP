<?php

class AdminCheckLoginView{

  private $messageNumberSignup;
  private $username;
  private $messageNumberLogin;
  private $MESSAGE_SIGNUP;
  private $messagetoprint;

  public function setmessageNumberLogin($nb){
    $this -> messageNumberLogin = $nb;
  }

  public function setMessageNumberSignup($nb){
    $this -> messageNumberSignup = $nb;
  }


  public function launch($post){
    $this->username = $post['USERNAME'];
    $this->MESSAGE_SIGNUP = array(
      'Veuillez saisir des données',
      'Le prénom.nom que vous avez tenté d\'ajouter fais déjà parti de la base de données !',
      'L\'E-MAIL que vous avez tenté d\'ajouter fais déjà parti de la base de données !',
      'Les mots de passe ne correspondent pas',
      'Erreur de connexion à la base de données !'
  );

    //Dans le cas où l'administrateur souhaite s'identifier et qu'il y a une erreur, affichage d'un message d'erreur
    if ($this -> messageNumberLogin > 0){
      $this->messagetoprint = $this->MESSAGE_LOGIN[$this -> messageNumberLogin - 1];
    }

    //Dans le cas où il y a une erreur lorsque l'administrateur inscrit un élève, affichage d'un message d'erreur
    if ($this -> messageNumberSignup > 0){
      $this->messagetoprint = $this->MESSAGE_SIGNUP[$this -> messageNumberSignup - 1];
    }

    echo <<<VIEW
   <body>


   <nav class="navbar navbar-default">
   <div class="container-fluid">
   <div class="navbar-header">
   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
   </button>
   </div>
   <div class="collapse navbar-collapse" id="myNavbar">
   <ul class="nav navbar-nav">
   <li><a data-target="#" data-toggle="modal">Bonjour $this->username </a></li>
   <li><a data-target="#inscriptionModal" href="#inscriptionModal" data-toggle="modal">Inscrire un utilisateur</a></li>
   <li><a href="#" onclick="$('#Main_Form_TASK').val('Deconnexion'); $('#Main_Form').submit();">Se déconnecter</a></li>
   <li><a href="#" onclick="$('#Main_Form_TASK').val('DisplayMultipleSubjects'); $('#Main_Form').submit();">Liste des sujets</a></li>
   <li><a href="#" onclick="$('#Main_Form_TASK').val('CreateSubject'); $('#Main_Form').submit();">Créer un sujet</a></li>
   </ul>
   </div>
   </div>
   </nav>

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

   $this->messagetoprint
   Vous pouvez dès à présent inscrire un nouvel utilisateur.

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