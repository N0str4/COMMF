<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
?>
<?php
include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();
include 'config/menu.php';
$now = date('Y-m-d H:i:s');

?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Changement mot de passe</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Mot de Passe</li>
      <li class="breadcrumb-item active">Changement</li>
    </ol>
  </nav>
<section class="section">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">     </h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="prenom" id="floatingEmail" placeholder="Prénom" disabled="disabled">
                    <label for="floatingEmail"><?php  echo 'Prenom: '.$donnees['fname']?></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="nom" id="floatingPassword" placeholder="Date" disabled="disabled">
                    <label for="floatingPassword"><?php echo 'Date: '.$now?></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="lastmdp" id="floatingEmail" placeholder="Prénom" disabled="disabled">
                    <label for="floatingEmail"><? echo 'Ancien Mot de Passe: '.$donnees['password']?></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="motdepasse" id="floatingPassword" placeholder="Nouveau Mot de Passe" required>
                    <label for="floatingPassword">Nouveau Mot de Passe</label>
                  </div>
                </div>

                <div class="text-center">
                  <button type="Envoyer" class="btn btn-primary">Envoyer</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
<?php
$mdp = $_POST['motdepasse'];
$id = $donnees['user_id'];
if(!empty($mdp)){
try{
        
    $req = $bdd->prepare("UPDATE users SET `password` = :adm WHERE `user_id` = :id");
    $req->bindParam(':adm', $mdp);
    $req->bindParam(':id', $id);
    $req->execute();
}
      
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
}
