<?php


class SubjectDisplay{
  private $username;
  private $nameSubject;
  private $subjectMessage;
  private $nbMessages;
  private $isResolved;
  private $creationDate;
  private $message_list;

  public function launch($post){
    $this->username = $post['USERNAME'];
    $this->nameSubject = $post['TEMP_SUBJECT_INFO']['NAMESUBJECT'];
    $this->subjectMessage = $post['TEMP_SUBJECT_INFO']['SUBJECTMESSAGE'];
    $this->nbMessages = $post['TEMP_SUBJECT_INFO']['NBMESSAGES'];
    $this->isResolved = $post['TEMP_SUBJECT_INFO']['ISRESOLVED'];
    $this->creationDate = $post['TEMP_SUBJECT_INFO']['CREATIONDATE'];
    $this->message_list = $post['MESSAGE_LIST'];

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
       <span class="label label-default">Aya Nakamura</span><br><br>
       <span class="label label-primary">Norman fait des vidéos</span><br><br>
       <span class="label label-success">Mentir</span>
       </p>
     </div>
   <p><a href="#"></a></p>
   </div>
   <div class="col-sm-8 text-left">

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
VIEW;
       foreach ($this->message_list as $row => $link) {
       echo <<<FE
       <div class="panel-body">
           <div class="row">
               <div class="col-6">
                   <div class="well">
                       <p>$link[messageContent]</p>
                   </div>
               </div>
           </div>
       </div>
FE;
       }
       echo <<<VIEW
    </div>

   <div class="row">
       <div class="col-sm-4  text-center">
            <form action = "index.php" method = "POST">
                <textarea rows = "5" cols = "124" name = "MESSAGE"></textarea>
                <input type="submit" name="TASK" value="SendMessage" required>
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
