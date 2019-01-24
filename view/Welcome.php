<?php

//Tableau de messages d'erreurs en cas de mauvaise identification (de la part de l'administrateur ou d'un élève)
// define('MESSAGE_LOGIN', array(
//   'Veuillez saisir des données',
//   'Le mot de passe que vous avez tapé est incorrect',
//   'L\'identifiant demandé n\'existe pas dans notre base de données'
// ));

class Welcome{

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
    <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
    </style>
    </head>
    <body>

    <nav class="navbar navbar-inverse">
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
    <input type="text" name="ID" class="form-control" id="exampleInputUsername1" placeholder="Username">
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
