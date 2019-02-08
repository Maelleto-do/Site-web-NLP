<?php

class WelcomeMessage{

  private $messageNumberLogin;
  private $MESSAGE_LOGIN;
  private $messagetoprint;

  public function setmessageNumberLogin($nb){
    $this -> messageNumberLogin = $nb;
  }


  public function launch(){
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


    <div class="container-fluid text-center">
    <div class="row content">
    <div class="col-sm-2 sidenav">
    <p><a href="#"></a></p>
    </div>

    <div class="col-sm-8 text-left">
    <p>Veuillez vous connecter pour continuer.</p>
    $this->messagetoprint

    <p id="test"></p>

    <script>
    var text = "";
    for(var i = 0; i < 10; i++){
        text += '<div class="panel panel-default"> <div class="panel-body"> <div class="row"> <div class="col-sm-3"> <div class="well"> <p>John</p> <img src="img/bird.jpg" class="img-circle" height="55" width="55" alt="Avatar"> </div> </div> <div class="col-sm-9"> <div class="well"> <p>Message randomMessage randomMessage randomMessage randomMessage randomMessage randomMessage randomMessage randomMessage randomMessage randomMessage random</p> </div> </div> </div> </div> </div>';
    }
    document.getElementById("test").innerHTML = text;
    </script>

    <div class="row">
        <div class="col-sm-4  text-center">
        <form action = "/cgi-bin/hello_get.cgi" method = "get">
             <textarea rows = "5" cols = "124" name = "description"> Enter text here... </textarea>

             <input type = "submit" value = "submit" />
          </form>
        </div>
    </div>


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
