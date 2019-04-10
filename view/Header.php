<?php

class Header{
    private $username;

  public function launch($post){
    $this->username = $post['USERNAME'];

    if(isset($post['USERNAME'])){
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
          <li><a href="#" onclick="$('#Main_Form_TASK').val('Logged'); $('#Main_Form').submit();">Bonjour $this->username</a></li>
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
      <label for="exampleInputUsername1">Email address</label>
      <input type="text" name="USERNAME" class="form-control" id="exampleInputUsername1" placeholder="Username">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="PW" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <input type="submit" value="Se connecter">
      </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="Admin_PW" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <input type="submit" value="Se connecter">
      </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
