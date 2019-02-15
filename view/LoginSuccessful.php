<?php


class LoginSuccessful{
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
   <li><a data-toggle="modal">Bonjour $this->username </a></li>
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
   <div class="well">
       <p>$this->username</p>
       <p><a href="#">My Profile</a></p>
       <img src="img/bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
     </div>
     <div class="well">
       <p><a href="#">Interests</a></p>
       <p>
         <span class="label label-default">Aya Nakamura</span>
         <span class="label label-primary">Norman fait des vidéos</span>
         <span class="label label-success">Mentir</span>
       </p>
     </div>
   <p><a href="#"></a></p>
   </div>
   <div class="col-sm-8 text-left">
   <h1>Bienvenue sur le forum</h1>
   Connexion réussie.

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
      <form id="Main_Form" action="index.php" method="POST">
      <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
      </form>
   </body>
VIEW;

 }
}
?>
<!-- input type="hidden" name="TASK" value="Deconnexion" //input type="hidden" name="TASK" value="Info" //input type="hidden" name="TASK" value="Contact" -->
