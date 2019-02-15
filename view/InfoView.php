<?php


class InfoView{
  private $username;

  public function launch($post){
    $this->username = $post['USERNAME'];

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
   <li><a data-target="#inscriptionModal" href="#inscriptionModal" data-toggle="modal">Bonjour $this->username </a></li>
   <li><a href="#" onclick="$('#Main_Form_TASK').val('Info'); $('#Main_Form').submit();">Informations</a></li>
   <li><a href="#" onclick="$('#Main_Form_TASK').val('Contact'); $('#Main_Form').submit();">Contacter un administrateur</a></li>
   <li><a href="#" onclick="$('#Main_Form_TASK').val('Deconnexion'); $('#Main_Form').submit();">Se déconnecter</a></li>
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
   <h1>Informations</h1>
   Vous êtes sur le forum dédié au enfant de l'école.
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
