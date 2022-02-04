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
$admintype=1;
$email = $donnees['email'];
$etat = "Erreur : L'utilisateur a tenté d'accédé à une page dont il n'avais pas les droits";
$now = date('Y-m-d H:i:s');
$Erreur=1;
if($donnees['admin']!=$admintype){
  try{
        
    $req = $bdd->prepare("
    INSERT INTO logsconnexionocmf(Email, Date, Etat, IP)
    VALUES(:email, :date, :etat, :ip)");
    $req->bindParam(':email', $email);
    $req->bindParam(':date', $now);
    $req->bindParam(':etat', $etat);
    $req->bindParam(':ip', $Erreur);
    $req->execute();
    header("location: paslesacces.html");
    }
      
    catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
    }

}
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
              <td><a class="btn btn-success" href="ajouteruser.php?"><i class="bi bi-check-circle"></i>Ajouter un Personnel</a></td>
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
                    <th scope="col">Email</th>
                    <th scope="col">MDP</th>
                    <th scope="col">Bloquage</th>
                    <th scope="col">Administrateur</th>
                    <th scope="col">Options</th>


                  </tr>
                </thead>
                <tbody>
                  <?php 
$req2 = $bdd->query("SELECT *
FROM `users`");

?>
<?php while ($donnees2 = $req2->fetch()){
?>
  <td> <?php echo $donnees2['email']?></td>
  <td> <?php echo $donnees2['password']?></td>
  <td> <?php if($donnees2['blocage']<6){ echo 'Non'; }else{ echo '<b style=color:red;>Oui</b>';}?></td>
  <td> <?php if($donnees2['admin']==1){ echo '<b><k style="color:orange">Oui</k></b>'; }else{ echo 'Non';}?></td>
  <td><a class="btn btn-success" href="fonctionuser/ajouteruseradmin.php?id=<?php echo $donnees2['user_id'];?>"><i class="bi bi-check-circle"></i>Promouvoir</a></td>
  <?php if($donnees2['admin']==1){?> <td><a class="btn btn-warning" href="fonctionuser/supprimeruseradmin.php?id=<?php echo $donnees2['user_id'];?>"><i class="bi bi-exclamation-triangle"></i>Rétrogradé</a></td><?php }?>
  <?php if($donnees2['blocage']>5){?> <td><a class="btn btn-warning" href="fonctionuser/deblocageutilisateur.php?id=<?php echo $donnees2['user_id'];?>"><i class="bi bi-exclamation-triangle"></i>Débloqué</a></td><?php }?>
  <td><a class="btn btn-danger" href="fonctionuser/supprimerutilisateur.php?id=<?php echo $donnees2['user_id'];?>"><i class="bi bi-exclamation-octagon"></i>Supprimé</a></td>
</tr>

<?php }
?>


<script>

function myFunction(){

    window.location.replace("http://intradef.vikatchev.com/Login/administration/ajouteruseradmin.php?variable=" + LET);

};
</script>
