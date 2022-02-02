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


<main id="main" class="main">

<div class="pagetitle">
  <h1>Ajout du Personnel</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Personnel</li>
      <li class="breadcrumb-item active">Ajout</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">     </h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="prenom" id="floatingEmail" placeholder="Prénom" required>
                    <label for="floatingEmail">Prénom</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="nom" id="floatingPassword" placeholder="Nom" required>
                    <label for="floatingPassword">Nom</label>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="mdp" id="floatingName" placeholder="Password" required>
                    <label for="floatingName">Mot de Passe</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="email" id="floatingName" placeholder="EMAIL" required>
                    <label for="floatingName">E-mail</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                  <select name="grade" class="form-select" id="floatingSelect" aria-label="Grade" required>
                      <option value="CNE">CNE</option>
                      <option value="LTN">LTN</option>
                      <option value="LTN">SLT</option>
                      <option value="MAJ">MAJ</option>
                      <option value="ADC">ADC</option>
                      <option selected value="ADJ">ADJ</option>
                      <option value="Civil">Civil</option>
                    </select>
                    <label for="floatingSelect">Grade du Personnel</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                  <select name="admin" class="form-select" id="floatingSelect" aria-label="Admin" required>
                      <option value="1">Oui</option>
                      <option selected value="0">Non</option>
                    </select>
                    <label for="floatingSelect">Administrateur</label>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Envoyer</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
<?php




$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$grade = $_POST['grade'];
$admin = $_POST['admin'];


// Vérifié que l'utilisateur existe pas déjà
$emailverif = $bdd->query("SELECT * FROM `users` WHERE email LIKE '$email'");
$donnees = $emailverif->fetchAll();
// VIDE SI AUCUNE PERSONNE TROUVER
// PAS VIDE SI PERSONNE TROUVER



echo $nom.' '.$prenom.' '.$email.' '.$mdp.' ' .$grade.' '.$admin;
if(isset($nom)&&isset($prenom)&&isset($email)){
if(empty($donnees)){ // SI VIDE
?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <h4 class="alert-heading">SUCCESS</h4>
  <p>Le Personnel <b><?php echo $prenom.'CC'.$nom ?> </b> à bien était intégré à la base de donné. </p>
  <hr>                
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

<?php
}else { // SI PAS VIDE?> 
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <h4 class="alert-heading">ERROR</h4>
  <p> L'Email <b><?php echo $email?> </b>existe déjà.</p>
  <hr>
  <p class="mb-0">Veuillez vérifié les utilisateurs existant.</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<?php
}

try{
  //On insère les données reçues
  $sth = $bdd->prepare("
      INSERT INTO users(fname, lname, email, password, admin, grade)
      VALUES(:fname, :lname, :email, :password, :adminnumber, :gradeform)");

      
  $sth->bindParam(':fname',$prenom);
  $sth->bindParam(':lname',$nom);
  $sth->bindParam(':email',$email);
  $sth->bindParam(':password',$mdp);
  $sth->bindParam(':adminnumber',$admin);
  $sth->bindParam(':gradeform',$grade);



  $sth->execute();

  
}
catch(PDOException $e){
  echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}




}

?>