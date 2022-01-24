<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php
include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();

include 'config/menu.php';
?>
</aside><!-- End Sidebar-->  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Suivis des Equivalences</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Logs</a></li>
          <li class="breadcrumb-item">Ajout</li>
          <li class="breadcrumb-item active">Suivie</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
    <td><a class="btn btn-danger" href="fonctions/supprimelogequivalence.php"><i class="bi bi-exclamation-octagon"></i>Supprimer les logs</a></td>
</div>
</div>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Logs</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>

                    <th scope="col">Type</th>
                    <th scope="col">Date</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Nom de la Formation</th>
                    <th scope="col">Nom de l'Equivalence</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
$req2 = $bdd->query("SELECT *
FROM `logsequivalence`");
$k=0;
?>
<?php while ($donnees = $req2->fetch()){
    $k=$k+1;    
    $equi1=$donnees['Equivalence'];
    $equi2=$donnees['Equivalence2'];
    $req23 = $bdd->query("SELECT * FROM `Formation` WHERE NumPrérequis LIKE '$equi1'");
    $donnees23 = $req23->fetch();
    $req24 = $bdd->query("SELECT * FROM `Formation` WHERE NumPrérequis LIKE '$equi2'");
    $donnees24 = $req24->fetch();

    


?>

  <tr>
  <td> <?php echo '<b>'.$donnees['type'].'</b>'?></td>
  <td> <?php echo $donnees['Date']?></td>
  <td> <?php echo $donnees['Nom']?></td>
  <td> <?php echo $donnees23['Nom_Prerequis']?></td>
  <td> <?php echo $donnees24['Nom_Prerequis']?></td>






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
  <?php include 'footer.php';