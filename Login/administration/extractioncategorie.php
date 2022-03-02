<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }


include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();

$sap = $_POST['sap'];
$formation = $_POST['formation'];
include 'config/menu.php';
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
  <h1>OCMF - Extraction Groupée</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Extraction</li>
      <li class="breadcrumb-item active">Groupée</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

          <section class="section">
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <h4 class="alert-heading"><b> Information Extraction </b></h4>
                <p>Une extraction vous permet d'extraire un ensemble de données critique sur un personnel de l'armée de Terre.
<br>Une extraction Groupée est une ensembles d'extraction, rassemblé en un. 
<br>Celle-ci comprend, leurs diplômes, leurs dates d'obtentions, leurs divers matricules (SAP, Alliance, Defense...), leurs grades, régiments et dates d'affectation.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Extraction de Personnel</h5>
              <p>Extraction réalisée en fonction de la fonction du personnel de l'armée de terre.<b>(Civil/Millitaire)</b></p>

              <!-- Vertically centered Modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Extraction Personnel
              </button>
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Choix de la Fonction</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Attention</h4>
                <p> Le fichier Excel ne doit être sous <b>aucun prétexte</b> communiqué aux personnes externes de l'armée de terre.</p>
                <hr>
              </div>
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-primary" href="export_excel_personnel.php?id=2"><i class="bi bi-person-x"></i><b>| Civil</b></a>
                      <a class="btn btn-success" href="export_excel_personnel.php?id=1"><i class="bi bi-person-plus"></i><b>| Millitaire</b></a>
                      <hr>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->

            </div>
          </div>
        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Extraction de Catégorie</h5>
            <p>Extraction réalisée en fonction de la catégorie du personnel militaire. </b></p>

              <!-- Vertically centered Modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cc">
                Extraction Catégorie
              </button>
              <div class="modal fade" id="cc" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Choix de la Catégorie</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Attention</h4>
                <p> Le fichier Excel ne doit être sous <b>aucun prétexte</b> communiqué aux personnes externes de l'armée de terre.</p>
                <hr>
              </div>
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-warning" href="export_excel_categorie.php?id=1"><i class="bi bi-binoculars"></i><b>| MDR</b></a>
                      <a class="btn btn-primary" href="export_excel_categorie.php?id=2"><i class="bi bi-bookmarks"></i><b>| SOFF</b></a>
                      <a class="btn btn-success" href="export_excel_categorie.php?id=3"><i class="bi bi-star"></i><b>| OFF</b></a>
                      <hr>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

                    </div>
                  </div>
                </div>
              </div><!-- End Vertically centered Modal-->

            </div>
          </div>


        </div>
      </div>
    </section>

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