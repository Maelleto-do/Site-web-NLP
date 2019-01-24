<?php


class LoginSuccessful{
  private $username;

  public function launch(){
    $this->username = $_POST['ID'];

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
   </button>
   </div>
   <div class="collapse navbar-collapse" id="myNavbar">
   <ul class="nav navbar-nav">
   <li><a data-target="#inscriptionModal" href="#inscriptionModal" data-toggle="modal">Bonjour $this->username </a></li>
   <li>
   <a href="index.php">Se déconnecter</a>
   </li>
   </ul>
   </div>
   </div>
   </nav>


   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-2 sidenav">
   <p><a href="#"></a></p>
   </div>
   <div class="col-sm-8 text-left">
   <h1>Bienvenue sur le forum</h1>
   Connexion réussie.
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
