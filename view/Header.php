<?php

class Header{
    private $username;

  public function launch($post){
    if(isset($_SESSION['logged'] ) && $_SESSION['logged'] ==1){
      $this->username = $post['USERNAME'];
      if($post['USERNAME'] == 'Admin'){
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
        <label for="email">Adresse Email</label>
        <input type="email" name="MAIL_USER" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Entrer une adresse mail" required>
        <small id="emailHelp" class="form-text text-muted">On ne diffusera pas votre adresse mail.</small>
        </div>
        <div class="form-group">
        <label for="username">Pseudo</label>
        <input type="text" name="USERNAME_USER" class="form-control" id="username" aria-describedby="username" placeholder="Entrer un Pseudo"  required>
        </div>
        <div class="form-group">
        <label for="name">Prénom</label>
        <input type="name" name="NAME_USER" class="form-control" id="name" placeholder="Entrer un Prénom"  required>
        </div>
        <div class="form-group">
        <label for="surname">Nom</label>
        <input type="surname" name="SURNAME_USER" class="form-control" id="surname" placeholder="Entrer un Nom"  required>
        </div>
        <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="PW_USER" class="form-control" id="password" placeholder="Entrer un mot de passe"  required>
        </div>
         <div class="form-group">
        <label for="password_repeat">Répéter le mot de passe</label>
        <input type="password" name="PW_USER_REPEAT" class="form-control" id="password_repeat" placeholder="Entrer un mot de passe"  required>
        </div>
        <input type="submit" value="Enregistrer">
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
        </div>
        </div>
        </div>
VIEW;
      }else{
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
        <li><a href="#" onclick="$('#Main_Form_TASK').val('AlreadyLogged'); $('#Main_Form').submit();">Bonjour $this->username</a></li>
        <li><a href="#" onclick="$('#Main_Form_TASK').val('Info'); $('#Main_Form').submit();">Informations</a></li>
        <li><a href="#" onclick="$('#Main_Form_TASK').val('Contact'); $('#Main_Form').submit();">Contacter un administrateur</a></li>
        <li><a href="#" onclick="$('#Main_Form_TASK').val('DisplayMultipleSubjects'); $('#Main_Form').submit();">Liste des sujets</a></li>
        <li><a href="#" onclick="$('#Main_Form_TASK').val('CreateSubject'); $('#Main_Form').submit();">Créer un sujet</a></li>
        <li><a href="#" onclick="$('#Main_Form_TASK').val('Deconnexion'); $('#Main_Form').submit();">Se déconnecter</a></li>
        </ul>
        </div>
        </div>
        </nav>
        </body>

        <div class="col-sm-2 sidenav">
        <div class="well">
        <p>$this->username</p>
        <p><a href="#" onclick="$('#Main_Form_TASK').val('Profile'); $('#Main_Form').submit();">Mon profil</a></p>
        <img src="img/bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
        </div>
        </div>
VIEW;
      }
    }else{
      echo <<<VIEW
      <body>

      <nav class="navbar navbar-default">
      <div class="container-fluid">
      <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <li><a data-target="#loginModal" href="#loginModal" data-toggle="modal">Se connecter</a></li>
      <li><a data-target="#loginAdminModal" href="#loginAdminModal" data-toggle="modal">Admin</a></li>
      </ul>
      </div>
      </div>
      </nav>

      <!-- Modal login-->
      <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
      <form action="index.php" method="POST">
      <input type="hidden" name="TASK" value="CheckLogin">
      <div class="form-group">
      <label for="exampleInputUsername1">Pseudo</label>
      <input type="text" name="USERNAME" class="form-control" id="exampleInputUsername1" placeholder="Pseudo" required>
      </div>
      <div class="form-group">
      <label for="exampleInputPassword1">Mot de pase</label>
      <input type="password" name="PW" class="form-control" id="exampleInputPassword1" placeholder="Mot de pase" required>
      </div>
      <input type="submit" value="Se connecter">
      </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
      </div>
      </div>
      </div>

      <!-- Modal Admin login-->
      <div class="modal fade" id="loginAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
      <form action="index.php" method="POST">
      <input type="hidden" name="TASK" value="AdminCheckLogin">
      <div class="form-group">
      <label for="exampleInputPassword1">Mot de passe</label>
      <input type="password" name="Admin_PW" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe" required>
      </div>
      <input type="submit" value="Se connecter">
      </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
      </div>
      </div>
      </div>
      </body>
VIEW;
    }
  }
}
?>
