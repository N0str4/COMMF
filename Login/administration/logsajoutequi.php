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
$Erreur=1;
$userId = $donnees['user_id'];

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
    $type = $donnees['type'];

    


?>

  <tr>
  <td> <?php if($type=='AJOUT'){ echo '<span class="badge bg-success">Ajout</span>';}elseif($type=='SUPPRESSIONS'){echo '<span class="badge bg-danger">Suppression</span>';}?></td>
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

