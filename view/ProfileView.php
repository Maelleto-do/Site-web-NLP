<?php
include_once 'Header.php';

class ProfileView{
    private $username;
    private $MESSAGE;
    private $messagetoprint;
    private $messageNumber;

    public function setmessageNumber($nb){
        $this -> messageNumber = $nb;
    }

    public function launch($post){

      $header = new Header();
      $header->launch($post);
        $this->username = $post['TEMP_SUBJECT_INFO']['USERNAME'];

        $this->MESSAGE = array(
            'Le prénom.nom que vous avez tenté d\'ajouter fais déjà parti de la base de données !',
            'Erreur de connexion à la base de données !',
            ' '
        );

        if ($this -> messageNumber > 0){
            $this->messagetoprint = $this->MESSAGE[$this -> messageNumber - 1];
        }

        echo <<<VIEW
    <div class="container-fluid text-center">
    <div class="row content">
    <div class="col-sm-8 text-left">

    <form action="index.php" method="POST">
    <p> $this->messagetoprint</p>
    <input type="hidden" name="TASK" value="ChangePseudo">
    <div class="form-group">
        <label for="username">Nouveau pseudo</label>
        <input type="text" name="NEW_PSEUDO" class="form-control" id="new_pseudo" placeholder="Saisir le nouveau pseudo">
    </div>
    <input type="submit" value="enregistrer le nouveau pseudo">
    </form>
    <form action="index.php" method="POST">
    <input type="hidden" name="TASK" value="ChangePwd">
    <div class="form-group">
    <label for="username">Nouveau mot de passe</label>
        <input type="text" name="NEW_PWD" class="form-control" id="new_pwd" placeholder="Saisir le nouveau mot de passe">
    </div>
    <input type="submit" value="enregistrer le nouveau mot de passe ">
    </form>
    </div>
    
    <form id="Main_Form" action="index.php" method="POST">
    <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
    </form>

VIEW;

    }
}
