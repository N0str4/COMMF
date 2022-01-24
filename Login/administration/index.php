<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OCMF - Administration</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <?php
include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch(); // PERMET D'AVOIR NOM/PRENOM SITUER DANS LE MENU, AU TOP DU SITE

$req2 = $bdd->prepare("
SELECT COUNT(*) AS total FROM users");
$req2->execute();
$donnees2 = $req2->fetch(); // PERMET D'AVOIR NOM/PRENOM SITUER DANS LE MENU, AU TOP DU SITE

$now = date('m');

$req10 = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :monthnow");
$req10->bindParam(':monthnow', $now);
$req10->execute();
$donnees10 = $req10->fetch(); // PERMET D'AVOIR NOM/PRENOM SITUER DANS LE MENU, AU TOP DU SITE

$now = date('m');
$lastmonth = $now-1;
if($lastmonth==0)
{
  $lastmonth=12; // MOIS DE DECEMBRE

}
$req11 = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :lastmonth");
$req11->bindParam(':lastmonth', $lastmonth);
$req11->execute();
$donnees11 = $req11->fetch(); // PERMET D'AVOIR NOM/PRENOM SITUER DANS LE MENU, AU TOP DU SITE

$moisauj=$donnees10['total'];
$moisavant=$donnees11['total'];
$totalbis = ($moisauj * 100)/ $moisavant;
$totalfinal=$totalbis-100;

if ($totalfinal<0){ // NEGATIF
  $augmentationOuBaisse = "Baisse";
  $VoR=0;

}elseif($totalfinal>0){
  $augmentationOuBaisse = "Augmentation";
  $VoR=1;

}
include 'config/menu.php'; 

?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Tableau de bord</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title"> Personnel <span>| Aujourd'hui</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $donnees2['total']?></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card 
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Recherches <span>| Ce mois</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-search"></i>
                    </div>
                    <div class="ps-3">
                      <h6>$3,264</h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>--><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Recherche <span>| Ce mois</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-search"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $donnees10['total'];?></h6>
                      <?php if($VoR==1){ ?>
                      <span class="text-success small pt-1 fw-bold"><?php echo $totalfinal?>%</span>
                      <?php }else{  ?>
                        <span class="text-danger small pt-1 fw-bold"><?php echo $totalfinal?>%</span>
                      <?php }?>

                    </div>
                  </div>

                </div>
              </div>
              <?php 
              
              ?>
            </div><!-- End Customers Card -->

            </div><!-- End Left side columns -->

            <?php include 'footer.php';