<?php
include_once 'Header.php';

class AdminCheckLoginView{

  private $messageNumberSignup;
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

    $this->username = $post['TEMP_SUBJECT_INFO']['USERNAME'];

    $header = new Header();
    $header->launch($post);

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
