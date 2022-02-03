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
$admintype=1;
$email = $donnees['email'];
$etat = "Erreur : L'utilisateur a tenté d'accédé à une page dont il n'avais pas les droits";
$now = date('Y-m-d H:i:s');
if($donnees['admin']!=$admintype){
  try{
        
    $req = $bdd->prepare("
    INSERT INTO logsconnexionocmf(Email, Date, Etat)
    VALUES(:email, :date, :etat)");
    $req->bindParam(':email', $email);
    $req->bindParam(':date', $now);
    $req->bindParam(':etat', $etat);
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
      <h1>Suivis des erreurs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Logs</a></li>
          <li class="breadcrumb-item">Suivie</li>
          <li class="breadcrumb-item active">Erreurs</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
    <td><a class="btn btn-danger" href="fonctions/supprimerlogsconnexionocmf.php"><i class="bi bi-exclamation-octagon"></i>Supprimer les logs</a></td>
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

                    <th scope="col">Date</th>
                    <th scope="col">Email</th>
                    <th scope="col">Etat</th>

                    

                  </tr>
                </thead>
                <tbody>
                  <?php 
$req2 = $bdd->query("SELECT *
FROM `logsconnexionocmf`");
$k=0;
?>
<?php while ($donnees = $req2->fetch()){
    $k=$k+1;
    $type=$donnees['Etat'];
?>

  <tr>
  <td> <?php echo $donnees['Date']?></td>
  <td> <?php echo $donnees['Email']?></td>
  <td> <?php if($type=="Erreur : L'utilisateur a tenté d'accédé à une page dont il n'avais pas les droits"){ echo '<k style=color:red> <b>'.$type.'</b> </k>';}?></td>


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

  </main>

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

  