<?php
include_once 'Header.php';

class SubjectDisplay{
<<<<<<< HEAD

=======
>>>>>>> 541701c0db2780ffc1068789b506038ea14e8408
  private $userID;
  private $nameSubject;
  private $subjectMessage;
  private $nbMessages;
  private $isResolved;
  private $creationDate;
  private $message_list;
  private $adminID;
  private $message_erreur;

  public function setMessageisGood($msg){

    $this->message_erreur = $msg;

  }

  public function setCheckSubject($tab){

    $this->nameSubject = $tab['NAMESUBJECT'];
    $this->subjectMessage = $tab['SUBJECTMESSAGE'];
    $this->nbMessages = $tab['NBMESSAGES'];
    $this->isResolved = $tab['ISRESOLVED'];
    $this->authorUsername = $tab['AUTHORUSERNAME'];
    $this->creationDate = $tab['CREATIONDATE'];

  }

  public function setGetMessages($tab){

    $this->message_list = $tab['MESSAGE_LIST'];

  }

  public function setCheckLoginAdmin($tab){


    $this->adminID = $tab['ADMINID'];

  }

  public function setCheckLogin($tab){

    $this->userId = $tab['USERID'];

  }

  public function launch($post){

    /*
      $this->userID = $post['TEMP_SUBJECT_INFO']['USERID'];

    $this->username = $post['TEMP_SUBJECT_INFO']['USERNAME'];
    if(isset($post['TEMP_SUBJECT_INFO']['ADMINID'])){
        $this->adminID = $post['TEMP_SUBJECT_INFO']['ADMINID'];
    }

    $this->nameSubject = $post['TEMP_SUBJECT_INFO']['NAMESUBJECT'];
    $this->subjectMessage = $post['TEMP_SUBJECT_INFO']['SUBJECTMESSAGE'];
    $this->nbMessages = $post['TEMP_SUBJECT_INFO']['NBMESSAGES'];
    $this->isResolved = $post['TEMP_SUBJECT_INFO']['ISRESOLVED'];
    $this->authorUsername = $post['TEMP_SUBJECT_INFO']['AUTHORUSERNAME'];
    $this->creationDate = $post['TEMP_SUBJECT_INFO']['CREATIONDATE'];



    $this->message_list = $post['TEMP_SUBJECT_INFO']['MESSAGE_LIST'];
    */

    $header = new Header();
    $header->launch($post);

    echo <<<VIEW
   <body>

   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-8 text-left">
   <div class="panel panel-default">

    <center><h2>$this->nameSubject</h2></center>
        <div class="panel-body">
            <div class="row">
                <div class="col-6">
                    <p><i> Topic posté par : <strong>$this->authorUsername</strong> </i></p>
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
       <p><i><strong>$link[author]</strong> a répondu :</i></p>
       <div class="panel-body">
           <div class="row">
               <div class="col-6">
                   <div class="well">
                       <p>$link[messageContent]</p>
                   </div>
                   <div class="text-right">
                   <form action = "index.php" method = "POST">
                   <p><a href="#" onclick="$('#Main_Form_MESSAGEID').val($link[messageID]); $('#Main_Form_TASK').val('DeleteMessage'); $('#Main_Form').submit();">Supprimer le message</a></p>
                   <script>
                   var authorID= '<?php echo $link[authorID]; ?>' ;
                   var userID = '<?php echo $this->userID; ?>' ;
                   var adminID = '<?php echo $this->adminID; ?>' ;
                   if (authorID != userID && userID != adminID) $('input').hide();
                   </script>
                   </form>
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
       <p>$this->message_erreur</p>
       <form action = "index.php" method = "POST">
       <textarea rows = "5" cols = "90" name = "MESSAGE" placeholder="Tapez ici votre message" required></textarea>
       <input type="submit" name="TASK" value="SendMessage">
       </form>
       </div>
       </div>

       </div>
       </div>
       </div>
       </body>

       <form id="Main_Form" action="index.php" method="POST">
       <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
       <input id="Main_Form_MESSAGEID" type="hidden" name="MESSAGEID" value="">
       </form>

VIEW;

 }
}
?>
