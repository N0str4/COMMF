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
      <h1>Suivis des Formations</h1>
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
    <td><a class="btn btn-danger" href="fonctions/supprimerlogsajout.php"><i class="bi bi-exclamation-octagon"></i>Supprimer les logs</a></td>
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
                    <th scope="col">Formation</th>
                    <th scope="col">Pré-requis</th>

                  </tr>
                </thead>
                <tbody>
                  <?php 
$req2 = $bdd->query("SELECT *
FROM `logsajout`");
$k=0;
?>
<?php while ($donnees = $req2->fetch()){
    $k=$k+1;
    $test=$donnees['Prerequis'];
    $req4 = $bdd->query("SELECT * FROM `Formation` WHERE NumPrérequis LIKE '$test'");
    $donnees2 = $req4->fetch()
    
?>

  <tr>
  <td> <?php echo '<b>'.$donnees['type'].'</b>'?></td>
  <td> <?php echo $donnees['Date']?></td>
  <td> <?php echo $donnees['Nom']?></td>
  <td> <?php echo $donnees['Formation']?></td>
  <td> <?php echo $donnees2['Nom_Prerequis']?></td>


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