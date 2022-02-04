<?php
include 'config/config.php';
$id = (!empty($_GET['id']))? intval($_GET['id']) : 0;
if(isset ($_GET["nom"])) { 
    $nom = $_GET["nom"]; 
    } else { 
    $nom = "ERROR"; // ou toute valeur par défaut... 
    }
    $admintype=1;
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
include 'config/menu.php';
$req = $bdd->query("SELECT * FROM `logsconnexion` WHERE `ID_PK` LIKE '$id'");
$donnees = $req->fetch();

// CONTENUE PAGE : 
?>
<main id="main" class="main">


<div class="pagetitle">
  <h1>Information de Connexion OMCF/P.A</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Connexion</li>
      <li class="breadcrumb-item active">Information</li>
    </ol>
  </nav>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                <b>Information à titre indicatif.<br></b>
                La Géocalisation d'Adresse IP, n'est pas une <b>solution viable.</b><br>
                Le mieux à faire est de <b>contacter un FAI,</b> et de lui demandé les informations de l'IP ci dessous. 
                <br>Les informations ci dessous, concerne un <b>rayon de +-40km. </b><br>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

</div><!-- End Page Title -->
<section class="section">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">     </h5>
<?php 
$Latitude = $donnees['Latitude'];
$Longitude = $donnees['Longitude'];

?>
              <!-- Floating Labels Form -->
              <form class="row g-3" method="post">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="IP" id="floatingName" placeholder="IP de Connexion" disabled="disabled">
                    <label for="floatingEmail"><b><?php  echo '<k style="text-align: center;">IP: '.$donnees['IP'].'</k>'?></b></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="prenom" id="floatingEmail" placeholder="Ville" disabled="disabled">
                    <label for="floatingEmail"><?php  echo 'Ville: '.$donnees['Localisation']?></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="nom" id="floatingPassword" placeholder="Pays" disabled="disabled">
                    <label for="floatingPassword"><?php echo 'Pays: '.$donnees['Pays']?></label>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control" name="nom" id="floatingPassword" placeholder="Latitude" disabled="disabled">
                    <label for="floatingPassword"><?php echo 'Latitude: '.$donnees['Latitude']?></label>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-floating">
                    <input type="password" class="form-control" name="nom" id="floatingPassword" placeholder="Longitude" disabled="disabled">
                    <label for="floatingPassword"><?php echo 'Longitude: '.$donnees['Longitude']?></label>
                  </div>
                </div>
              </form><!-- End floating Labels Form -->
              <div class="text-center">
                <button type="COUCOU" onclick="window.location.href='https://www.google.com/maps/search/?api=1&query=<?php echo $Latitude?> ,<?php echo $Longitude?>'" class="btn btn-primary">Localiser sur Google Map</button>
                <button type="COUCOU" onclick="window.location.href='http://intradef.vikatchev.com/Login/administration/logsconnexionpanel.php'" class="btn btn-secondary">Retour</button>
               </div>
            </div>
          </div>
