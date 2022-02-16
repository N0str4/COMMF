<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();
include 'config/menu.php';
if($donnees['admin']!=1){
  header("location: login.php");
}
?>
</aside><!-- End Sidebar-->  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Visualisation des formations</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Formations</li>
          <li class="breadcrumb-item active">Informations</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Formations</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom de la Formation</th>
                    <th scope="col">Nom du Prérequis</th>
                    <th scope="col">Type</th>
                    <?php if($donnees['admin']==1){?>
<th scope="col">Options</th><?php }?>
                  </tr>
                </thead>
                <tbody>
                  <?php 


$req2 = $bdd->query("SELECT *
FROM `Formationdetails`");
$k=0;
?>
<?php while ($donnees34 = $req2->fetch()){
    $k=$k+1;
$test=$donnees34['num_prerequis'];
$req3 = $bdd->query("SELECT *
FROM `Formationdetails`
INNER JOIN Formation
ON Formationdetails.num_prerequis = Formation.NumPrérequis WHERE NumPrérequis LIKE '$test'");
$donnees2 = $req3->fetch()
?>

  <tr>
  <th scope="row"><?php echo $k?></th>
  <td> <?php echo $donnees34['nomformation']?></td>
  <td> <?php echo $donnees2['Nom_Prerequis']?></td>
  <td> <?php if($donnees34['type']==0){ echo '<h5><span class="badge bg-dark">Civil</span></h5>'; } elseif($donnees34['type']==1){ echo '<h5><span class="badge bg-dark">Millitaire</span></h5>';} elseif($donnees34['type']==3){ echo '<h5><span class="badge bg-dark">Commun</span></h5>';} elseif($donnees34['type']>3){ echo '<h5><span class="badge bg-danger">Autres</span></h5>';}?></td>
  <?php if($donnees['admin']==1){?>
<td><a class="btn btn-danger" href="fonctions/supprimerformation.php?id=<?php echo $donnees34['ID_PK'];?>&nom=<?php echo $donnees['lname']?>"><i class="bi bi-exclamation-octagon"></i>Supprimer</a></td><?php }?>
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
