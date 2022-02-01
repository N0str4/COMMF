<?php 
session_start();
use GeoIp2\Database\Reader;
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

if($donnees['admin']!=1){
  header("location: login.php");
}



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
for ($k=0;$k<13;$k++){
  $tab[$k]=$k;
  
}

// CHECK CB DE FORMATION EXISTE 
$reqNbFormation = $bdd->prepare("SELECT COUNT(*) AS total FROM Formationdetails");
$reqNbFormation->execute();
$donneesNbFormation = $reqNbFormation->fetch();
//



// MOIS DIAGRAMM 
$reqVerifJanviers = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Janviers");
$reqVerifJanviers->bindParam(':Janviers', $tab[1]);
$reqVerifJanviers->execute();
$donneesJanviers = $reqVerifJanviers->fetch();
//
$reqVerifFevrier = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Fevrier");
$reqVerifFevrier->bindParam(':Fevrier', $tab[2]);
$reqVerifFevrier->execute();
$donneesFevrier = $reqVerifFevrier->fetch();
// 
$reqVerifMars = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Mars");
$reqVerifMars->bindParam(':Mars', $tab[3]);
$reqVerifMars->execute();
$donneesMars = $reqVerifMars->fetch();
//
$reqVerifAvril = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Avril");
$reqVerifAvril->bindParam(':Avril', $tab[4]);
$reqVerifAvril->execute();
$donneesAvril = $reqVerifAvril->fetch();
//
$reqVerifMai = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Mai");
$reqVerifMai->bindParam(':Mai', $tab[5]);
$reqVerifMai->execute();
$donneesMai= $reqVerifMai->fetch();
//
$reqVerifJuin = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Juin");
$reqVerifJuin->bindParam(':Juin', $tab[6]);
$reqVerifJuin->execute();
$donneesJuin= $reqVerifJuin->fetch();
//
$reqVerifJuillet= $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Juillet");
$reqVerifJuillet->bindParam(':Juillet', $tab[7]);
$reqVerifJuillet->execute();
$donneesJuillet= $reqVerifJuillet->fetch();
//
$reqVerifAout = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Aout");
$reqVerifAout->bindParam(':Aout', $tab[8]);
$reqVerifAout->execute();
$donneesAout= $reqVerifAout->fetch();
//
$reqVerifSeptembre = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Septembre");
$reqVerifSeptembre->bindParam(':Septembre', $tab[9]);
$reqVerifSeptembre->execute();
$donneesSeptembre= $reqVerifSeptembre->fetch();
//
$reqVerifOctobre = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Octobre");
$reqVerifOctobre->bindParam(':Octobre', $tab[10]);
$reqVerifOctobre->execute();
$donneesOctobre =  $reqVerifOctobre->fetch();
//
$reqVerifNobembre = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Novembre");
$reqVerifNobembre->bindParam(':Novembre', $tab[11]);
$reqVerifNobembre->execute();
$donneesNovembre= $reqVerifNobembre->fetch();
//
$reqVerifDecembre = $bdd->prepare("SELECT COUNT(*) AS total FROM logsrecherche WHERE MONTH(date) = :Decembre");
$reqVerifDecembre->bindParam(':Decembre', $tab[12]);
$reqVerifDecembre->execute();
$donneesDecembre= $reqVerifDecembre->fetch();
// END OF DIAGRAMM MONTH / 

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
                  <h5 class="card-title">Recherches <span>| Ce mois</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-search"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $donnees10['total'];?></h6>

                    </div>
                  </div>

                </div>
              </div>
              <?php 
              
              ?>
            </div><!-- End Customers Card -->
            <div class="col-xxl-4 col-xl-12">
              

              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Formations <span> | Total</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $donneesNbFormation['total'];?></h6>

                    </div>
                  </div>

                </div>
              </div>
              <?php 
              
              ?>
            </div><!-- End Customers Card -->
            </div><!-- End Customers Card -->
            <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Récapitulatif des Recherches sur l'Année</h5>

              <!-- Bar Chart -->
              <canvas id="barChart" style="max-height: 400px;"></canvas>
              <script>
                var Janvier = <?php echo json_encode($donneesJanviers['total']); ?>;
                var Fevrier = <?php echo json_encode($donneesFevrier['total']); ?>;
                var Mars = <?php echo json_encode($donneesMars['total']); ?>;
                var Avril = <?php echo json_encode($donneesAvril['total']); ?>;
                var Mai = <?php echo json_encode($donneesMai['total']); ?>;
                var Juin = <?php echo json_encode($donneesJuin['total']); ?>;
                var Juillet = <?php echo json_encode($donneesJuillet['total']); ?>;
                var Aout = <?php echo json_encode($donneesAout['total']); ?>;
                var Septembre = <?php echo json_encode($donneesSeptembre['total']); ?>;
                var Octobre = <?php echo json_encode($donneesOctobre['total']); ?>;
                var Novembre = <?php echo json_encode($donneesNovembre['total']); ?>;
                var Decembre = <?php echo json_encode($donneesDecembre['total']); ?>;
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                      labels: ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout','Septembre','Octobre','Novembre','Decembre'],
                      datasets: [{
                        label: 'Recherche effectué',
                        data: [Janvier, Fevrier, Mars, Avril, Mai, Juin, Juillet,Aout,Septembre,Octobre,Novembre,Decembre],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Bar CHart -->

            </div>
          </div>
          
        </div>


            </div><!-- End Left side columns -->

            <?php include 'footer.php';  