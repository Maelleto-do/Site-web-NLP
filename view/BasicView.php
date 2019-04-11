<?php
include_once 'Header.php';

class BasicView{
  private $switch;
  private $messageNumberLogin;
  private $MESSAGE_LOGIN;
  private $messagetoprint;
  private $MESSAGE;
  private $messageNumber;
  private $subject_list;

  public function setmessageNumber($value){
      $this->messageNumber = $value;
  }

  public function setSubjectList($subject_list){
    $this->subject_list = $subject_list;
  }

  public function setmessageNumberLogin($value){
    $this->messageNumberLogin = $value;
  }

  public function setValueToSwitch($value){
    $this->switch = $value;
  }

  public function launch($post){

    $header = new Header();
    $header->launch($post);

    switch($this->switch){
      case 'CreateSubject':
      echo <<<VIEW
     <body>
     <div class="container-fluid text-center">
     <div class="row content">
     <div class="col-sm-8 text-left">
     <form action = "index.php" method = "POST">
      Nom du sujet:<br>
      <input type="text" name="subjectname" required>
      <br>
      Sujet:<br>
      <textarea rows = "5" cols = "124" name = "MESSAGE" required></textarea>
      <br><br>
      <input type="submit" name="TASK" value="SendSubject">
     </form>
     </div>
     </div>
     </div>
     </body>
VIEW;
          break;
      case 'DisplayMultipleSubjects':
      echo <<<VIEW
      <body>
      <div class="container-fluid text-center">
      <div class="row content">
      <div class="col-sm-8 text-left">
VIEW;
      foreach ($this->subject_list as $row => $link) {
        echo <<<FE
        <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
        <div class="col-6">
        <div class="well">
        <a href="#" onclick="$('#Main_Form_IDSUBJECT').val($link[subjectID]); $('#Main_Form_TASK').val('MessageSujet'); $('#Main_Form').submit();">$link[nameSubject]</a>
        </div>
        </div>
        </div>
        </div>
        </div>
FE;
      }
      echo <<<VIEW
      </div>
      </div>
      </div>
      </body>
VIEW;
          break;

      case 'Deconnexion':
          echo <<<VIEW
          <body>
          <div class="container-fluid text-center">
          <div class="row content">
          <div class="col-sm-2 sidenav">
          <p><a href="#"></a></p>
          </div>
          <div class="col-sm-8 text-left">
          <p>Vous vous êtes bien déconnecté.</p>
          </div>
          <div class="col-sm-2 sidenav">
          </div>
          </div>
          </div>
          </body>
VIEW;
      break;

      case 'Info':
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
      break;

      case 'Logged':
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
      break;

      case 'ExpiredSession':
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
      break;

      case 'Contact':
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
VIEW;
      break;

      case 'Welcome':
          //Array message d'erreur
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
      break;

      case 'ChangePseudo':
      case 'ChangePwd':
      case 'Profile':
          //Array message d'erreur
          $this->MESSAGE = array(
              'Le prénom.nom que vous avez tenté d\'ajouter fais déjà parti de la base de données !',
              'Erreur de connexion à la base de données !',
          );
          if ($this -> messageNumber > 0){
              $this->messagetoprint = $this->MESSAGE[$this -> messageNumber - 1];
          }
          echo <<<VIEW
          <div class="container-fluid text-center">
          <div class="row content">
          <div class="col-sm-8 text-left">

          <form action="index.php" method="POST">
          <p> $this->messagetoprint</p>
          <input type="hidden" name="TASK" value="ChangePseudo">
          <div class="form-group">
          <label for="username">Nouveau pseudo</label>
          <input type="text" name="NEW_PSEUDO" class="form-control" id="new_pseudo" placeholder="Saisir le nouveau pseudo">
          </div>
          <input type="submit" value="Enregistrer">
          </form>
          <form action="index.php" method="POST">
          <input type="hidden" name="TASK" value="ChangePwd">
          <div class="form-group">
          <label for="username">Nouveau mot de passe</label>
          <input type="text" name="NEW_PWD" class="form-control" id="new_pwd" placeholder="Saisir le nouveau mot de passe">
          </div>
          <input type="submit" value="Enregistrer">
          </form>
          </div>
VIEW;
    }


    echo <<<FORM

    <form id="Main_Form" action="index.php" method="POST">
    <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
    <input id="Main_Form_IDSUBJECT" type="hidden" name="IDSUBJECT" value="">
    </form>

FORM;

  }
}
?>
