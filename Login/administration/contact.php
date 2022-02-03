<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
include 'config/config.php';


$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();
include 'config/menu.php';

?>
            <main id="main" class="main">

<div class="pagetitle">
  <h1>Contact Support</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Support</li>
      <li class="breadcrumb-item active">Contact</li>
    </ol>
  </nav>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                Dans le cas, où vous rencontrez un problème, vous pouvez à tout moment me contacter.<br>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

</div><!-- End Page Title -->
<section class="section">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">     </h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post" action="https://formspree.io/f/xoqrjgjl">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="_replyto" id="floatingName" placeholder="Email" required>
                    <label for="floatingName"> Email </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="objet" id="floatingEmail" placeholder="Objet" >
                    <label for="floatingEmail">Objet</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="message" id="floatingPassword" placeholder="Message" >
                    <label for="floatingPassword">Message</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Envoyer</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>