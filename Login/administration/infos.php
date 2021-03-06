<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php

include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();
$admintype=1;
$userId = $donnees['user_id'];
$email = $donnees['email'];
$etat = "Erreur : L'utilisateur a tenté d'accédé à une page dont il n'avais pas les droits";
$now = date('Y-m-d H:i:s');
$Erreur=1;
if($donnees['admin']!=$admintype){
  try{
        
    $req = $bdd->prepare("
    INSERT INTO logsconnexionocmf(Email, Date, Etat, IP)
    VALUES(:email, :date, :etat, :ip)");
    $req->bindParam(':email', $email);
    $req->bindParam(':date', $now);
    $req->bindParam(':etat', $etat);
    $req->bindParam(':ip', $Erreur);
    $req->execute();
    header("location: paslesacces.html");
    }
      
    catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
    }

}
// VERIFICATION SI AFFICHAGE DE L'INFO INDEX OU PAS
$reqMessageInfoIndex = $bdd->prepare("SELECT COUNT(*) AS total FROM infoIndex");
$reqMessageInfoIndex->execute();
$donneesMessageInfoIndex= $reqMessageInfoIndex->fetch();
$messageexiste = $donneesMessageInfoIndex['total'];
// END
// SI OUI, CONTENUE DE L'INFO
$reqMessageContenue = $bdd->prepare("SELECT * FROM infoIndex");
$reqMessageContenue->execute();
$donneesMessageContenue= $reqMessageContenue->fetch();
$messageError = $donneesMessageContenue['Information'];
//END

include 'config/menu.php';

?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Changement du message d'accueil</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Message d'Accueil</li>
      <li class="breadcrumb-item active">Modification</li>
    </ol>
  </nav>
  <?php if($messageexiste >0){?>
    
  <h1>Message d'accueil actuel : </h1>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                <? echo $messageError ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <td><a class="btn btn-danger" href="fonctions/supprimermessage.php?id=<? echo $userId ?>"><i class="bi bi-check-circle"></i> Supprimer le message</a></td>

              <?     }?>
</div><!-- End Page Title -->
<section class="section">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">     </h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post" action="https://intradef.vikatchev.com/Login/administration/infos.php">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="message" id="floatingName" placeholder="Contenue du Message" required>
                    <label for="floatingName">Contenue du Message</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="prenom" id="floatingEmail" placeholder="Votre Nom" disabled="disabled">
                    <label for="floatingEmail"><?php  echo 'Prenom: '.$donnees['fname']?></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="nom" id="floatingPassword" placeholder="Votre Prénom" disabled="disabled">
                    <label for="floatingPassword"><?php echo 'Nom: '.$donnees['lname']?></label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Envoyer</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

<?php
$nom = $donnees['lname'];
$prenom = $donnees['fname'];
$message = $_POST['message'];
$now = date('Y-m-d H:i:s');
$Succes=0;
$Erreur=1;

if(!empty($message)){
    try{
        //On insère les données reçues
    
    
        $delete = $bdd->prepare("
        DELETE FROM infoIndex");
        $delete->execute();
    
      }
      catch(PDOException $e){
        $etat2 = "Erreur : ".$e->getMessage();
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
        $req = $bdd->prepare("
        INSERT INTO logsconnexionocmf(Email, Date, Etat, IP)
        VALUES(:email, :date, :etat, :ip)");
        $req->bindParam(':email', $email);
        $req->bindParam(':date', $now);
        $req->bindParam(':etat', $etat2);
        $req->bindParam(':ip', $Erreur);

        $req->execute();
      }

      try{
          $etat2 = "Succès : Message d'accueil mis à jour";
        //On insère les données reçues
        $reqAjoutMess = $bdd->prepare("
            INSERT INTO infoIndex(Information)
            VALUES(:info)");
        $reqAjoutMess->bindParam(':info',$message);
        $reqAjoutMess->execute();

        $req = $bdd->prepare("
        INSERT INTO logsconnexionocmf(Email, Date, Etat, IP)
        VALUES(:email, :date, :etat, :ip)");
        $req->bindParam(':email', $email);
        $req->bindParam(':date', $now);
        $req->bindParam(':etat', $etat2);
        $req->bindParam(':ip', $Succes);

        $req->execute();
    }   
    catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
}
