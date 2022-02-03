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
          <section class="section">

<? if(!empty($sap)){?>
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">OCMF - Diplomes</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Fonction</th>
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



while ($donnees = $req2->fetch()){?>
<tr>
  <th scope="row"><?php echo $k?></th>
  <td> <?php echo $nom?></td>
  <td> <?php echo $prenom?></td>
  <td> <?php echo $typeverif?></td>
  <td> <?php echo $donnees['Nom_Prerequis']?></td>
  <td> <?php echo $donnees['dateobtention']?></td>

</tr>
<?php }?>
<?php }?>




                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

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
