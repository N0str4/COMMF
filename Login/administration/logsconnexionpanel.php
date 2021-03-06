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
      <h1>Suivis des Tentative de Connexion Panel</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Logs</a></li>
          <li class="breadcrumb-item">Suivie Connexion</li>
          <li class="breadcrumb-item active">Panel Admin</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
    <td><a class="btn btn-danger" href="fonctions/supprimerlogsconnexionpanel.php?id=<?echo $userId?>"><i class="bi bi-exclamation-octagon"></i>Supprimer les logs</a></td>
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
                    <th scope="col">IP</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Options</th>

                  </tr>
                </thead>
                <tbody>
                  <?php 
$req2 = $bdd->query("SELECT *
FROM `logsconnexion`");
$k=0;
?>
<?php while ($donnees2 = $req2->fetch()){
    $k=$k+1;
    $type=$donnees2['Etat'];
?>

  <tr>
  <td> <?php echo $donnees2['Date']?></td>
  <td> <?php echo $donnees2['Email']?></td>
  <td> <?php if($type=='Erreur : Email inconnu'){ echo '<k style=color:red> <b>Erreur : Email inconnu</b> </k>';}elseif($type=='Erreur : Email ou mot de passe incorrect'){echo '<k style=color:red><b> Erreur : mot de passe incorrect </b></k>';}elseif($type=="Erreur : Vous n'avez pas les accès requis"){echo "<k style=color:orange><b>Erreur : Vous n'avez pas les accès requis</b></k>";}elseif($type=="Succès : Connexion reussite"){echo "<k style=color:green><b>Succès : Connexion reussite</b></k>";}elseif($type=="Erreur : Compte Bloqué"){echo "<k style=color:blue><b>Erreur : Compte Bloqué</b></k>";}?></td>
  <td> <?php echo $donnees2['IP']?></td>
  <td> <?php echo $donnees2['Localisation']?></td>
  <td><a class="btn btn-info"" href="infosip.php?id=<?php echo $donnees2['ID_PK'];?>&nom=<?php echo $donnees['lname']?>"><i class="bi bi-info-circle"></i></a></td>



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


  