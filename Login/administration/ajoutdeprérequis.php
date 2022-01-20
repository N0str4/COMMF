<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php
include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE unique_id LIKE '{$_SESSION['unique_id']}'");
$donnees = $req->fetch();

include 'config/menu.php';

// CONTENUE PAGE : 
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Ajout de Pré-Requis</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Pré-Requis</li>
      <li class="breadcrumb-item active">Ajout</li>
    </ol>
  </nav>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                Une Formation peut etre un Pré-Requis et vice versa.<br>
                Il est possible que vous soyez amené à crée un Pré-Requis, qui est en meme temps une formation.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

</div><!-- End Page Title -->
<section class="section">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">     </h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="nomPrere" id="floatingName" placeholder="Nom de la nouvelle Formation" required>
                    <label for="floatingName">Nom du nouveau Pré-Requis</label>
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
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
<?php
$nom = $donnees['lname'];
$prenom = $donnees['fname'];
$nomprerequis = $_POST['nomPrere'];

include 'config.php';



// Vérifie que le pré-requis existe pas encore.
$req = $bdd->query("SELECT * FROM `Formation` WHERE Nom_Prerequis LIKE '$nomprerequis'");
$donnees = $req->fetch();
echo $donnees;




if(isset($nomprerequis)){
if(isset($donnees)){
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">ERROR</h4>
                <p> Le Pré-Requis du nom de <b><?php echo $nomprerequis?> </b>existe déjà.</p>
                <hr>
                <p class="mb-0">Dans le cas, ou vous avez un doute sur la présence ou non d'un pré-requis, il est préconiser de vous rendre dans la Visualisation des Pré-Requis.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

<?php }else{ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">SUCCESS</h4>
                <p>Pré-Requis du nom de <b><?php echo $nomprerequis?> </b> à bien était intégré à la base de donné. </p>
                <hr>                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php 
try{
    //On insère les données reçues
    $sth = $bdd->prepare("
        INSERT INTO Formation(Nom_Prerequis)
        VALUES(:nom)");
    $sth->bindParam(':nom',$nomprerequis);
    $sth->execute();
  
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }


}
}



