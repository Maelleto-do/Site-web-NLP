<?php
include_once 'Header.php';

class BasicView{
  private $switch;
  private $messageNumberLogin;
  private $MESSAGE_LOGIN;
  private $messagetoprint;
  private $MESSAGE;
  private $messageNumber;
  private $subject_list;

  public function setmessageNumber($value){
      $this->messageNumber = $value;
  }

  public function setSubjectList($subject_list){
    $this->subject_list = $subject_list;
  }

  public function setmessageNumberLogin($value){
    $this->messageNumberLogin = $value;
  }

  public function setValueToSwitch($value){
    $this->switch = $value;
  }

  public function launch($post){

    $header = new Header();
    $header->launch($post);

    switch($this->switch){
      case 'CreateSubject':
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
         </body>
VIEW;
          break;
      case 'SendSubject':
      case 'DisplayMultipleSubjects':
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
      </body>
VIEW;
          break;

      case 'Deconnexion':
          echo <<<VIEW
          <body>
          <div class="container-fluid text-center">
          <div class="row content">
          <div class="col-sm-2 sidenav">
          <p><a href="#"></a></p>
          </div>
          <div class="col-sm-8 text-left">
          <p>Vous vous êtes bien déconnecté.</p>
          </div>
          <div class="col-sm-2 sidenav">
          </div>
          </div>
          </div>
          </body>
VIEW;
      break;

      case 'Info':
          echo <<<VIEW
          <body>
          <div class="container-fluid text-center">
          <div class="row content">
          <div class="col-sm-8 text-left">
            <h1>Charte du forum</h1>
                <h2>Généralités</h2>
                    <p>Nous rappelons que l'auteur d'un message est responsable des propos qu'il publie. En cas de violation de la charte, ce dernier s'expose à une suppression de ses messages, voire de son compte.<br><br>

                    Nous ne sommes pas responsable de l'agissement des membres sur le forum. Si vous trouvez des messages hors-charte, vous pouvez nous les signaler via un mail à l'administrateur, ou à votre vie scolaire.<br><br>

                    En participant à ce forum, vous autorisez l'administrateur du site à supprimer n'importe quel message pour n'importe quelles raisons notamment exposées dans cette charte, sans autorisation préalable de votre part.<br><br>
                    </p>
                <h2>Contenus non autorisés</h2>
                    <ul>
                        <li>Les messages à caractères pornographique ou sexuels.</li>

                        <li>Les messages racistes, xénophobes ou incitant à la haine qu’elle soit à l'encontre d'une personne ou d'un groupe de personnes.</li>

                        <li>Les messages à caractère insultants, violents, menaçants, au contenu choquant.</li>

                        <li>Les messages diffamatoires.</li>

                        <li>Les messages bafouant le droit d'auteur, le droit à l'image et le respect à la vie privée.</li>

                        <li>Les messages dans le but de nuire au forum tel que le spam ou bien ceux générant une mauvaise ambiance ou un mauvais esprit.</li>

                        <li>Les liens de parrainages et les publicités, qu'elles soient commerciales ou non.</li>

                        <li>Les démarchages, de manière générale, sont interdits et peuvent conduire à la suppression du compte.</li>

                        <li>Et de manière plus générale, tous les messages contraires aux lois en vigueur en France.</li>
                    </ul>
                <h2>Bonnes pratiques</h2>

                    Afin que les forums restent un endroit agréable à consulter, merci de suivre les bonnes pratiques ci-dessous.
                    <ul>
                        <li><h4>Evitez les majuscules</h4></li>
                        Les majuscules sur les forums sont considérées comme un cri ou un signe d'énervement. Cela ne rends pas votre sujet plus visible, évitez donc les majuscules.<br><br>

                        <li><h4>Evitez le langage SMS</h4></li>
                        Vous êtes sur un forum, vous n'êtes pas limité en nombre de caractères. Essayez de formuler vos posts en français correct de manière à vous faire comprendre.<br><br>

                        <li><h4>Bien choisir le titre du sujet</li></h4>
                        Un bon titre aidera les gens à comprendre votre problème et à vous aider : dans le titre, mettez tous les détails utiles pour situer le problème. Evitez les messages du type : "aide", "besoin d'aide"... Précisez ce que vous demandez.<br><br>

                        <li><h4>Bien décrire le problème</li></h4>
                        Lors de la rédaction du sujet, pensez à donner tous les détails pour que l'on puisse vous aider. Une description détaillé et une bonne mise en forme facilitera la lecture par d’autres membres et donc les réponses.<br><br>

                        <li><h4>Un peu de politesse</li></h4>
                        Si vous voulez encourager les autres à vous répondre, ne négligez pas les formules de politesse. Ce n'est pas parce que vous êtes sur un forum qu'il faut oublier que vous parlez à des gens que vous ne connaissez pas. Un simple "bonjour", "s'il vous plaît et "Merci" ne coûte rien et bien au contraire encouragera les autres à répondre!<br><br>

                        <li><h4>Informations personnelles</li></h4>
                        Hormis les informations de votre profil, ne donnez jamais d'informations pouvant vous causer préjudice (numéros de CB, numéro de carte d’identité, numéro de telephone, …). Si quelqu'un divulguait ces informations sans votre accord, vous êtes en droit de demander la suppression immédiate du message en contactant l'administrateur ou votre vie scolaire.<br><br>
          </div>
          </div>
          </div>
          <form id="Main_Form" action="index.php" method="POST">
          <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
          </form>
          </body>
VIEW;
      break;

      case 'AlreadLogged':
      case 'Logged':


          echo <<<VIEW
          <div class="container-fluid text-center">
          <div class="row content">
          <div class="col-sm-8 text-left">
          <h1>Bienvenue sur le forum</h1>
VIEW;

        if($this->switch == 'Logged'){

          echo  'Connexion réussie.';

        }
          echo <<<VIEW
          </div>
          </div>
          <form id="Main_Form" action="index.php" method="POST">
          <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
          </form>
          </body>
VIEW;
      break;

      case 'ExpiredSession':
          echo <<<VIEW
          <body>
          <div class="container-fluid text-center">
          <div class="row content">
          <div class="col-sm-2 sidenav">
          <p><a href="#"></a></p>
          </div>
          <div class="col-sm-8 text-left">
          <p>Votre session a expiré, veuillez vous reconnecter !</p>
          </div>
          <div class="col-sm-2 sidenav">
          </div>
          </div>
          </div>
          </body>
VIEW;
      break;

      case 'Contact':
          echo <<<VIEW
          <body>
          <div class="container-fluid text-center">
          <div class="row content">
          <div class="col-sm-8 text-left">
          <h1>Contact</h1>
          <p>Pour contacter un administrateur, veuillez envoyer un mail à l'adresse admin@admin.fr.</p>
          </div>
          </div>
          </div>
          </body>
VIEW;
      break;

      case 'Welcome':
          //Array message d'erreur
          $this->MESSAGE_LOGIN = array(
            'Veuillez saisir des données',
            'Le mot de passe que vous avez tapé est incorrect',
            'L\'identifiant demandé n\'existe pas dans notre base de données'
          );
          //Dans le cas où il y a une erreur, affiche un message
          if ($this -> messageNumberLogin > 0){
            $this->messagetoprint = $this->MESSAGE_LOGIN[$this -> messageNumberLogin - 1];
          }

          echo <<<VIEW
          <div class="container-fluid text-center">
          <div class="row content">
          <div class="col-sm-2 sidenav">
          </div>
          <div class="col-sm-8 text-left">
          <p>Veuillez vous connecter pour continuer.</p>
          $this->messagetoprint
          </div>
          <div class="col-sm-2 sidenav">
          </div>
          </div>
          </div>
          </body>
VIEW;
      break;

      case 'ChangePseudo':
      case 'ChangePwd':
      case 'Profile':
          //Array message d'erreur
          $this->MESSAGE = array(
              'Le pseudo que vous avez tenté d\'ajouter fais déjà parti de la base de données !',
              'Veuillez saisir un pseudo',
              'Veuillez saisir un pseudo conforme',
              'Veuillez saisir un pseudo de longueur inférieure à 20 caractères',
              'Veuillez saisir un pseudo de longueur supérieure à 2 caractères',
              'Erreur de connexion à la base de données !',
              'Veuillez saisir un mot de passe',
              'Veuillez saisir un mot de passe de longueur inférieure à 20 caractères',
              'Veuillez saisir un mot de passe de longueur supérieure à 2 caractères',
              'Veuillez saisir un mot de passe contenant au moins : une majuscule, un chiffre, un caractère spécial'

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
          <input type="submit" value="Enregistrer">
          </form>
          <form action="index.php" method="POST">
          <input type="hidden" name="TASK" value="ChangePwd">
          <div class="form-group">
          <label for="username">Nouveau mot de passe</label>
          <input type="password" name="NEW_PWD" class="form-control" id="new_pwd" placeholder="Saisir le nouveau mot de passe">
          </div>
          <input type="submit" value="Enregistrer">
          </form>
          </div>
VIEW;
    }


    echo <<<FORM

    <form id="Main_Form" action="index.php" method="POST">
    <input id="Main_Form_TASK" type="hidden" name="TASK" value="">
    <input id="Main_Form_IDSUBJECT" type="hidden" name="IDSUBJECT" value="">
    </form>

FORM;

  }
}
?>
