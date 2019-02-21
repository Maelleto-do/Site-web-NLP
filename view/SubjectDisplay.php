<?php


class SubjectDisplay{
  private $username;
  private $nameSubject;
  private $subjectMessage;
  private $nbMessages;
  private $isResolved;
  private $creationDate;
  private $message_list;

  public function launch(){
    $this->username = $_SESSION['USERNAME'];
    $this->nameSubject = $_SESSION['NAMESUBJECT'];
    $this->subjectMessage = $_SESSION['SUBJECTMESSAGE'];
    $this->nbMessages = $_SESSION['NBMESSAGES'];
    $this->isResolved = $_SESSION['ISRESOLVED'];
    $this->creationDate = $_SESSION['CREATIONDATE'];
    $this->message_list = $_SESSION['MESSAGE_LIST'];

    echo <<<VIEW
   <body>

   <form id="Main_Form" action="index.php" method="POST">
    <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
   </form>

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

   <p id="test"></p>

   <div class="panel panel-default">
    <center><h2>$this->nameSubject</h2></center>
        <div class="panel-body">
            <div class="row">
                <div class="col-6">
                    <div class="well">
                        <p>$this->subjectMessage</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        $this->message_list
    </div>

   <div class="row">
       <div class="col-sm-4  text-center">
            <form action = "index.php" method = "POST">
                <textarea rows = "5" cols = "124" name = "MESSAGE"></textarea>
                <input type="submit" name="TASK" value="SendMessage">
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
<!-- input type="hidden" name="TASK" value="Deconnexion" //input type="hidden" name="TASK" value="Info" //input type="hidden" name="TASK" value="Contact" -->
