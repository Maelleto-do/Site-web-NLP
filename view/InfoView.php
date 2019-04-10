<?php


class InfoView{
  private $username;
    private $messageNumber;
    private $MESSAGE;
    private $messagetoprint;

    public function setmessageNumber($nb){
        $this -> messageNumber = $nb;
    }

    public function launch($post){

        $this->username = $post['TEMP_SUBJECT_INFO']['USERNAME'];
    $this->MESSAGE = array(
          'Le prénom.nom que vous avez tenté d\'ajouter fais déjà parti de la base de données !',
          'L\'E-MAIL que vous avez tenté d\'ajouter fais déjà parti de la base de données !',
          'Les mots de passe ne correspondent pas',
          'Erreur de connexion à la base de données !'
      );

    if ($this -> messageNumber > 0){
        $this->messagetoprint = $this->MESSAGE[$this -> messageNumber - 1];
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
    <li><a href="#" onclick="$('#Main_Form_TASK').val('Logged'); $('#Main_Form').submit();">Bonjour $this->username</a></li>
    <li><a href="#" onclick="$('#Main_Form_TASK').val('Info'); $('#Main_Form').submit();">Informations</a></li>
    <li><a href="#" onclick="$('#Main_Form_TASK').val('Contact'); $('#Main_Form').submit();">Contacter un administrateur</a></li>
    <li><a href="#" onclick="$('#Main_Form_TASK').val('Deconnexion'); $('#Main_Form').submit();">Se déconnecter</a></li>
    <li><a href="#" onclick="$('#Main_Form_TASK').val('DisplayMultipleSubjects'); $('#Main_Form').submit();">Liste des sujets</a></li>
    <li><a href="#" onclick="$('#Main_Form_TASK').val('CreateSubject'); $('#Main_Form').submit();">Créer un sujet</a></li>
    </ul>
    </div>
    </div>
    </nav>






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
    <h1>Informations</h1>
    Vous êtes sur le forum dédié aux enfants de l'école.
    Vous pouvez accéder aux différents sous forums, poser vos questions ou répondre à vos camarades.
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
