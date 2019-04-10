<?php
include_once 'Header.php';

class Welcome{

  private $messageNumberLogin;
  private $MESSAGE_LOGIN;
  private $messagetoprint;

  public function setmessageNumberLogin($nb){
    $this -> messageNumberLogin = $nb;
  }


  public function launch($post){

    $this->username = $post['TEMP_SUBJECT_INFO']['USERNAME'];

    $header = new Header();
    $header->launch($post);

    $this->MESSAGE_LOGIN = array(
      'Veuillez saisir des données',
      'Le mot de passe que vous avez tapé est incorrect',
      'L\'identifiant demandé n\'existe pas dans notre base de données'
    );
    //Dans le cas où il y a une erreur, affiche un message
    if ($this -> messageNumberLogin > 0){
      $this->messagetoprint = $this->MESSAGE_LOGIN[$this -> messageNumberLogin - 1];
    }

    echo <<<VIEW

    <div class="container-fluid text-center">
    <div class="row content">
    <div class="col-sm-2 sidenav">
    </div>
    <div class="col-sm-8 text-left">
    <p>Veuillez vous connecter pour continuer.</p>
    $this->messagetoprint
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
