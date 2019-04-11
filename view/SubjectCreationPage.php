<?php
include_once 'Header.php';

class SubjectCreationPage{
  private $username;

  public function launch($post){

    $header = new Header();
    $header->launch($post);

    echo <<<VIEW
   <body>
   <div class="container-fluid text-center">
   <div class="row content">
   <div class="col-sm-8 text-left">

   <form action = "index.php" method = "POST">
    Nom du sujet:<br>
    <input type="text" name="subjectname" required>
    <br>
    Sujet:<br>
    <textarea rows = "5" cols = "124" name = "MESSAGE" required></textarea>
    <br><br>
    <input type="submit" name="TASK" value="SendSubject">
   </form>

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
