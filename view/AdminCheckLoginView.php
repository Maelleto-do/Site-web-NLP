<?php
include_once 'Header.php';

class AdminCheckLoginView{

  private $messageNumberSignup;
  private $MESSAGE_SIGNUP;
  private $messagetoprint;

  public function setMessageNumberSignup($nb){
    $this -> messageNumberSignup = $nb;
  }

  public function launch($post){

    $header = new Header();
    $header->launch($post);

    $this->MESSAGE_SIGNUP = array(
      'Vous avez ajouté un nouvel utilisateur !',
      'Le prénom.nom que vous avez tenté d\'ajouter fais déjà parti de la base de données !',
      'L\'E-MAIL que vous avez tenté d\'ajouter fais déjà parti de la base de données !',
      'Les mots de passe ne correspondent pas !',
      'Erreur de connexion à la base de données !'
  );
    $this->messagetoprint = 'Vous pouvez dès à présent inscrire un nouvel utilisateur';
    //Dans le cas où il y a une erreur lorsque l'administrateur inscrit un élève, affichage d'un message d'erreur
    if (isset($this->messageNumberSignup)){
      $this->messagetoprint = $this->MESSAGE_SIGNUP[$this->messageNumberSignup];
    }

    echo <<<VIEW

   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-8 text-left">
   $this->messagetoprint

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
