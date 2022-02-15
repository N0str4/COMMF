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
  <h1>Profil de l'utilisateur</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Utilisateurs</li>
      <li class="breadcrumb-item active">Profil</li>

    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <h2><? echo $donnees['fname'].' '.$donnees['lname']?></h2>
          <h3><? echo $donnees['grade']?></h3>
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
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier Profil</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Changer Mot de Passe</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Informations</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Nom Complet</div>
                <div class="col-lg-9 col-md-8"><? echo $donnees['fname'].' '.$donnees['lname']?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Grade</div>
                <div class="col-lg-9 col-md-8"><? echo $donnees['grade']?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><? echo $donnees['email']?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Fonction:</div>
                <div class="col-lg-9 col-md-8"><?php echo $donnees['Fonction'] ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Cellule:</div>
                <div class="col-lg-9 col-md-8"><? echo $donnees['Cellule']?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Accès à L'OCMF:</div>
                <div class="col-lg-9 col-md-8"><?php if($donnees['admin']==1){ echo 'Administrateur';}elseif($donnees['admin']==0){echo 'Utilisateur';}?></div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form method="post">
              <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Fonction</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="Fonction" type="text" class="form-control" id="Fonction">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Cellule</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="Cellule" type="text" class="form-control" id="Cellule">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
              </form><!-- End Profile Edit Form -->

            </div>


            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form method="post">


                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Entrez à nouveau le mot de passe</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            
                </form><!-- End Change Password Form -->

              </div>

              </div><!-- End Bordered Tabs -->
              </div>
              </div>

</div>
<?php
$mdp = $_POST['newpassword'];
$mdprenew = $_POST['renewpassword'];
$cellule = $_POST['Cellule'];
$id = $donnees['user_id'];
$fonction = $_POST['Fonction'];
if(!empty($fonction)){

    try{
                  
      $req4 = $bdd->prepare("UPDATE users SET `Fonction` = :adm WHERE `user_id` = :id");
      $req4->bindParam(':adm', $fonction);
      $req4->bindParam(':id', $id);
      $req4->execute();
  }
        
  catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
  }?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <h4 class="alert-heading">Succès</h4>
  <p>Votre <b>fonction</b> a correctement été modifié.</p>
  <hr>                
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div><?php
  
  
  
  }




if(!empty($cellule)){

  try{
                
    $req2 = $bdd->prepare("UPDATE users SET `Cellule` = :adm WHERE `user_id` = :id");
    $req2->bindParam(':adm', $cellule);
    $req2->bindParam(':id', $id);
    $req2->execute();
}
      
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<h4 class="alert-heading">Succès</h4>
<p>Votre <b>cellule</b> correctement été modifié.</p>
<hr>                
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div><?php



}
if(!empty($mdp)){
  if($mdp==$mdprenew){
        try{
                
            $req = $bdd->prepare("UPDATE users SET `password` = :adm WHERE `user_id` = :id");
            $req->bindParam(':adm', $mdp);
            $req->bindParam(':id', $id);
            $req->execute();
        }
              
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Succès</h4>
        <p>Votre <b>mot de passe</b> a correctement été modifié.</p>
        <hr>                
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div><?php
  }elseif($mdp!=$mdprenew){
?>
  <div class="row mb-3">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">Erreur</h4>
    <p>Les mots de passe ne correspondent pas.<br>Veuillez entrer deux mots de passe identique.</p>
    <hr>    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  </div>


<?php
  }
}
?>

  </div>
</section>

</main><!-- End #main -->