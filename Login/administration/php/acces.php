<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php
include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE unique_id LIKE '{$_SESSION['unique_id']}'");
$donnees = $req->fetch();
include 'config/menu.php';
?>

</aside><!-- End Sidebar-->  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Visualisation des accès OCMF</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Accès</li>
          <li class="breadcrumb-item active">Informations</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <button name="AddUtils"type="button" class="btn btn-success"><i class="bi bi-check-circle"></i>Ajouter un Utilisateur</button>
              <button name="AddUtilAdmin"type="button" class="btn btn-success"><i class="bi bi-check-circle"></i>Promouvoir une Utilisateur en Administrateur</button><br>
            <br>

            <button value="envoyer "name="DelUtil" type="button" class="btn btn-danger" onclick="myFunction();"><i class="bi bi-exclamation-octagon"></i>Supprimer un Utilisateur</button>
            <button name="DelUtilAdmin"type="button" class="btn btn-danger"><i class="bi bi-exclamation-octagon"></i>Retrogradé un Utilisateur</button><br>

            </div>
          </div>


    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Utilisateurs</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">ID </th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Administrateur</th>
                    <th scope="col">Grade</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
$req2 = $bdd->query("SELECT *
FROM `users`");

?>
<?php while ($donnees = $req2->fetch()){
?>

  <tr><th scope="row"><?php echo $donnees['user_id']?></th><td> <?php echo $donnees['lname']?></td><td> <?php echo $donnees['fname']?></td><td> <?php echo $donnees['email']?></td><td> <?php if($donnees['admin']==1){ echo 'Oui'; }else{ echo 'Non';}?></td><td> <?php echo $donnees['grade']?></td></tr>




<?php }



?>


<script>

function myFunction(){

    window.location.replace("http://intradef.vikatchev.com/Login/administration/ajouteruser.php");

};
</script>
