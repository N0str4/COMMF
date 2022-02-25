<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');


include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();

include 'config/menu.php';
?>

<main id="main" class="main">
<!-- Vendor JS Files -->
<!-- Vendor JS Files -->
<div class="pagetitle">
  <h1>OCMF - Vivier du Personnel de l'Armée de Terre</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Vivier</li>
      <li class="breadcrumb-item active">Pesonnel</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

                    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">OCMF - Vivier du Personnel de l'Armée de Terre</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">SAP / Numéro Alliance</th>
                    <th scope="col">Fonction</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Régiment</th>
                  </tr>
                </thead>
                <tbody>

<?php 

$req2 = $bdd->query("SELECT * FROM `utils`");
while($donnees2 = $req2->fetch()){
    $regiment= $donnees2['regiment'];
    $reqVerifReg = $bdd->query("SELECT *
    FROM regiments WHERE ID_FK LIKE '$regiment'");
    $donneesVerifReg = $reqVerifReg->fetch();

?>    
    <tr>

    <td> <b><?php echo $donnees2['nom']?></b></td>
    <td> <b> <?php echo $donnees2['prenom']?></b></td>
    <? if($donnees2['type']==1){?><td> <?php echo $donnees2['sap']?></td><?}elseif($donnees2['type']==0){ ?><td> <?php echo $donnees2['numalliance']?></td><?}?>
    <td><?php if($donnees2['type']==1){ echo '<h5><span class="badge bg-success">Millitaire</span></h5>';}elseif($donnees2['type']==0){ echo '<h5><span class="badge bg-dark">Civil</span></h5>';}?> </td>
    <td> <?php echo $donnees2['Grade']?></td>
    <td> <b> <?php echo $donnees2['Catégorie']?></b></td>
    <td> <?php echo $donneesVerifReg['NomRegiment']?></td>
   </tr>    
<?
}     
?>
       </div>
    </div>

    </div>
  </div>
</section>

</main><!-- End #main --></main><!-- End #main -->
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
