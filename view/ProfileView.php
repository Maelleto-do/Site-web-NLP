<?php


class ProfileView{
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
    <form action="index.php" method="POST">
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

VIEW;

    }
}
?>
