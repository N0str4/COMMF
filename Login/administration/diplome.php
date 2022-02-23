<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');


include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();
$now = date('Y-m-d H:i:s');

include 'config/menu.php';
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
$sap = $_POST['sap'];
$req = $bdd->query("SELECT *
FROM utils WHERE sap LIKE '$sap'");
$donnees2 = $req->fetch();
$id_userSAP = $donnees2['id'];
$nom = $donnees2['nom'];
$prenom = $donnees2['prenom'];
$type = $donnees2['type'];

if ($type == 1){

    $typeverif='Millitaire';
}elseif($type == 0){
    $typeverif="Civil";
}else{
    $typeverif="Error";
}
try{
  //On insère les données reçues
  $requeteLOG = $bdd->prepare("
      INSERT INTO logsdiplome(nom, date, sap)
      VALUES(:nom, :date, :sap)");
  $requeteLOG->bindParam(':nom',$donnees['lname']);
  $requeteLOG->bindParam(':date',$now); 
  $requeteLOG->bindParam(':sap',$sap); 


  $requeteLOG->execute();
}   
catch(PDOException $e){
  echo "Erreur : " . $e->getMessage();
}
?>
<main id="main" class="main">
<!-- Vendor JS Files -->
<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
<div class="pagetitle">
  <h1>OCMF - Recherche Candidats</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Recherche</li>
      <li class="breadcrumb-item active">Candidats</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<? if(empty($sap)){?>
<section class="section">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">     </h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="sap" id="floatingName" placeholder="SAP" required>
                    <label for="floatingName">SAP</label>
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
 <?php }?>
          <section class="section profile">

<? if(!empty($sap) && !empty($prenom)){?>

  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <img src="ArmeeDeTerre.png" alt="Profile" >

          <h2><? echo $donnees2['nom'].' '.$donnees2['prenom']?></h2>
          <h3><? echo $donnees2['Grade']?></h3>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Informations</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#diplome">Diplomes</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Informations</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Nom Complet</div>
                <div class="col-lg-9 col-md-8"><? echo $donnees2['nom'].' '.$donnees2['prenom'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Matricule SAP:</div>
                <div class="col-lg-9 col-md-8"><?php echo $sap ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Fonction:</div>
                <div class="col-lg-9 col-md-8"><?php echo $typeverif ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Catégorie</div>
                <div class="col-lg-9 col-md-8"><? echo $donnees2['Catégorie'];?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Grade</div>
                <div class="col-lg-9 col-md-8"><? echo $donnees2['Grade'];?></div>
              </div>





            </div>

            <div class="tab-pane fade profile-edit pt-3" id="diplome">

            <div class="row">
              <div class="col-lg-12">

                <div class="card">
                   <div class="card-body">
                   <td><a class="btn btn-success" href="export_excel.php?id=<?echo $id_userSAP?>"><i class="bi bi-check-circle"></i>Extraire les diplomes</a></td>
                     <h5 class="card-title">OCMF - Diplomes</h5>

                      <!-- Table with stripped rows -->
                       <table class="table datatable">
                        <thead>
                         <tr>
                            <th scope="col">#</th>
                            <th scope="col">Diplome</th>
                            <th scope="col">Obtenu en</th>
                        </tr>
                      </thead>
                <tbody>
                <?php
$req2 = $bdd->query("SELECT *
FROM `formationliaison`
INNER JOIN Formation
ON formationliaison.Num_Prerequis = Formation.NumPrérequis WHERE id_user LIKE '$id_userSAP'");



while ($donnees = $req2->fetch()){
  
  $k=$k+1;
  ?>

<tr>
  <th scope="row"><?php echo $k?></th>
  <td> <?php echo $donnees['Nom_Prerequis']?></td>
  <td> <?php echo $donnees['dateobtention']?></td>

</tr>
<?php }?>
<?php }elseif(!empty($sap) && empty($prenom)){?>
<div class="card">
  <div class="card-body pt-3">

  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Erreur</h4>
                <p> Le Matricule SAP <b><?php echo $sap?> </b> n'existe pas.</p>
                <hr>
              </div>
  </div>
</div>
  <?php }?>
</tbody>
              </table>
              <!-- End Table with stripped rows -->
              </div>
          </div>

        </div>
      </div>










            </div><!--FIN -->
              </div><!-- End Bordered Tabs -->
              </div>
              </div>
    </section>

  </main><!-- End #main -->

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
