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
$req = $bdd->query("SELECT * FROM `users` WHERE unique_id LIKE '{$_SESSION['unique_id']}'");
$donnees = $req->fetch(); // PERMET D'AVOIR NOM/PRENOM SITUER DANS LE MENU, AU TOP DU SITE

$req2 = $bdd->prepare("
SELECT COUNT(*) AS total FROM users");
$req2->execute();
$donnees2 = $req2->fetch(); // PERMET D'AVOIR NOM/PRENOM SITUER DANS LE MENU, AU TOP DU SITE
include 'config/menu.php'; 

echo $donnees2['total'];
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
  <div class="row">

<div class="col-xxl-4 col-xl-12">

<div class="card info-card customers-card">

  <div class="card-body">
    <h5 class="card-title">Personnel</h5>

    <div class="d-flex align-items-center">
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
        <i class="bi bi-people"></i>
      </div>
      <div class="ps-3">
        <h6><?php echo $donnees2['total']?></h6>
        <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

      </div>
    </div>

  </div>
</div>

</div>
</div>
        </div><!-- End Left side columns -->
<?php 


