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
$email = $donnees['email'];
$now = date('Y-m-d H:i:s');
$Erreur=1;

include 'config/menu.php';
?>

</aside><!-- End Sidebar-->  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Recherches sur les utilisateurs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Vivier</li>
          <li class="breadcrumb-item active">Utilisateurs</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

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
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Grade</th>
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
<tr>
  <td> <?php echo '<b>'.$donnees2['lname'].'</b>'?></td>
  <td> <?php echo $donnees2['fname']?></td>
  <td> <?php echo $donnees2['email']?></td>
  <td> <?php echo $donnees2['grade']?></td>
  <td><a class="btn btn-primary" href="changeprofiluser.php?id=<?php echo $donnees2['user_id'];?>" title="Informations"><i class="bi bi-info-circle"></i></a></td>

</tr>

<?php }
?>


<script>

function myFunction(){

    window.location.replace("http://intradef.vikatchev.com/Login/administration/ajouteruseradmin.php?variable=" + LET);

};
</script>
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