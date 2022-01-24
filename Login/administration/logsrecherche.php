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
      <h1>Suivis des Recherches</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Logs</a></li>
          <li class="breadcrumb-item">Recherches</li>
          <li class="breadcrumb-item active">Suivie</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
    <td><a class="btn btn-danger" href="fonctions/supprimerlogsrecherche.php"><i class="bi bi-exclamation-octagon"></i>Supprimer les logs</a></td>
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
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Nom du Personnel</th>
                    <th scope="col">SAP</th>
                    <th scope="col">Formation</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
$req2 = $bdd->query("SELECT *
FROM `logsrecherche`");
$k=0;
?>
<?php while ($donnees = $req2->fetch()){
    $k=$k+1;
$test=$donnees['num_prerequis'];
?>

  <tr><th scope="row"><?php echo $k?></th>
  <td> <?php echo $donnees['date']?></td>
  <td> <?php echo $donnees['nom']?></td>
  <td> <?php echo $donnees['sap']?></td>
  <td> <?php echo $donnees['formation']?></td></tr>




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

  </main><!-- End #main --><?php include 'footer.php';