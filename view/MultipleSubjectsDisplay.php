<?php
include_once 'Header.php';

class MultipleSubjectsDisplay{
  private $username;
  private $subject_list;

  public function launch($post){

    $header = new Header();
    $header->launch($post);
      $this->username = $post['TEMP_SUBJECT_INFO']['USERNAME'];
    $this->subject_list = $post['TEMP_SUBJECT_INFO']['SUBJECT_LIST'];

    echo <<<VIEW
   <body>


   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-8 text-left">
VIEW;
   foreach ($this->subject_list as $row => $link) {
   echo <<<FE
       <div class="panel panel-default">
           <div class="panel-body">
               <div class="row">
                   <div class="col-6">
                       <div class="well">
                          <a href="#" onclick="$('#Main_Form_IDSUBJECT').val($link[subjectID]); $('#Main_Form_TASK').val('MessageSujet'); $('#Main_Form').submit();">$link[nameSubject]</a>
                       </div>
                   </div>
               </div>
           </div>
       </div>
FE;
   }
   echo <<<VIEW
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
