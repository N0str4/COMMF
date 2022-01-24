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
$donnees = $req->fetch();
include 'config/menu.php';
?>
</aside><!-- End Sidebar-->  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Visualisation des Pré-Requis</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pré-Requis</li>
          <li class="breadcrumb-item active">Informations</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                <b>Supprimer un pré-requis</b>, reviens à supprimé également la <b>Formation</b> dans lequel le pre-requis est <b>affilié.</b><br>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pré-Requis</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">ID Pré-Requis</th>
                    <th scope="col">Nom du PréRequis</th>
                    <th scope="col">Options</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
$req2 = $bdd->query("SELECT *
FROM `Formation`");

?>
<?php while ($donnees34 = $req2->fetch()){
?>
 <tr>
  <th scope="row"><?php echo $donnees34['NumPrérequis']?></th>
  <td> <?php echo $donnees34['Nom_Prerequis']?></td>
  <td><a class="btn btn-danger" href="fonctions/supprimerprerequis.php?id=<?php echo $donnees34['NumPrérequis'];?>&nom=<?php echo $donnees['lname']?>"><i class="bi bi-exclamation-octagon"></i>Supprimer</a></td>

</tr>




<?php }?>
                  <?php /*<tr>
                    <th scope="row"><?php echo $k?></th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                  </tr>*/?>
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
  <?php include 'footer.php';
  