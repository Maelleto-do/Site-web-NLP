<?php

class LoggedOutView{

  public function launch($post){

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
    <p>Vous vous êtes bien déconnecté.</p>
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
