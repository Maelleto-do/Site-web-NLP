<?php


class MultipleSubjectsDisplay{
  private $username;
  private $nameSubject;
  private $subjectMessage;
  private $nbMessages;
  private $isResolved;
  private $creationDate;
  private $subject_list;

  public function launch(){
    $this->username = $_SESSION['USERNAME'];
    /*$this->nameSubject = $_SESSION['NAMESUBJECT'];
    $this->subjectMessage = $_SESSION['SUBJECTMESSAGE'];
    $this->nbMessages = $_SESSION['NBMESSAGES'];
    $this->isResolved = $_SESSION['ISRESOLVED'];
    $this->creationDate = $_SESSION['CREATIONDATE'];*/
    $this->subject_list = $_SESSION['SUBJECT_LIST'];

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
       <p><a href="#">My Profile</a></p>
       <img src="img/bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">
     </div>
     <div class="well">
       <p><a href="#">Interests</a></p>
       <p>
       <span class="label label-default">Aya Nakamura</span> <br><br>
       <span class="label label-primary">Norman fait des vidéos</span> <br><br>
       <span class="label label-success">Mentir</span>
       </p>
     </div>
   <p><a href="#"></a></p>
   </div>
   <div class="col-sm-8 text-left">

    $this->subject_list

   </div>
   <div class="col-sm-2 sidenav">

   </div>
   </div>
   </div>

   <form id="Main_Form" action="index.php" method="POST">
    <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
    <input id="Main_Form_IDSUBJECT" type="hidden" name="IDSUBJECT" value="">
   </form>

   </body>
VIEW;

 }
}
?>
