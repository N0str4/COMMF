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
$nom = $donnees['lname'];
$prenom = $donnees['fname'];
$recyclage = $_POST['Recyclage'];
$validite = $_POST['Validite'];
$nomprerequis = $_POST['nomPrere'];
$now = date('Y-m-d H:i:s');
// CONTENUE PAGE : 
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Ajout de Pré-Requis</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Pré-Requis</li>
      <li class="breadcrumb-item active">Ajout</li>
    </ol>
  </nav>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                Une Formation peut etre un Pré-Requis et vice versa.<br>
                Il est possible que vous soyez amené à crée un Pré-Requis, qui est en meme temps une formation.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

</div><!-- End Page Title -->
<? if(empty($nomprerequis)){?>
<section class="section">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">     </h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="nomPrere" id="floatingName" placeholder="Nom de la nouvelle Formation" required>
                    <label for="floatingName">Nom du nouveau Pré-Requis</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="prenom" id="floatingEmail" placeholder="Votre Nom" disabled="disabled">
                    <label for="floatingEmail"><?php  echo 'Prenom: '.$donnees['fname']?></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="nom" id="floatingPassword" placeholder="Votre Prénom" disabled="disabled">
                    <label for="floatingPassword"><?php echo 'Nom: '.$donnees['lname']?></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                  <select name="Recyclage" class="form-select" id="floatingSelect" aria-label="Recyclage" required>
                      <option selected value="0">NON</option>
                      <option value="1">OUI</option>
                    </select>
                    <label for="floatingSelect">Formation comprenant un recyclage</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                  <select name="Validite" class="form-select" id="floatingSelect" aria-label="Validité" required>
                      <option selected value="1">A vie</option>
                      <option value="4">4 ans</option>
                      <option value="5">5 ans</option>
                    </select>
                    <label for="floatingSelect">Temps de Validité</label>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Envoyer</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
<?php }
$ajout = "AJOUT";
include 'config.php';



// Vérifie que le pré-requis existe pas encore.
$req = $bdd->query("SELECT * FROM `Formation` WHERE Nom_Prerequis LIKE '$nomprerequis'");
$donnees = $req->fetch();
echo $donnees;




if(isset($nomprerequis)){
if(!empty($donnees)){
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">ERROR</h4>
                <p> Le Pré-Requis du nom de <b><?php echo $nomprerequis?> </b>existe déjà.</p>
                <hr>
                <p class="mb-0">Dans le cas, ou vous avez un doute sur la présence ou non d'un pré-requis, il est préconiser de vous rendre dans la Visualisation des Pré-Requis.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

<?php }else{ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">SUCCESS</h4>
                <p>Pré-Requis du nom de <b><?php echo $nomprerequis?> </b> à bien était intégré à la base de donné. </p>
                <hr>                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php 

if ($validite!=1){
try{

    //On insère les données reçues
    $sth = $bdd->prepare("
        INSERT INTO Formation(Nom_Prerequis, recyclage, validité)
        VALUES(:nom, :recyclage, :validite)");
    $sth->bindParam(':nom',$nomprerequis);
    $sth->bindParam(':recyclage',$recyclage);
    $sth->bindParam(':validite',$validite);
    $sth->execute();

}
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}
}else {
  try{
  $sth = $bdd->prepare("
      INSERT INTO Formation(Nom_Prerequis, recyclage)
      VALUES(:nom, :recyclage)");
  $sth->bindParam(':nom',$nomprerequis);
  $sth->bindParam(':recyclage',$recyclage);
  $sth->execute();
}
catch(PDOException $e){
  echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}
}
  try{
    //On insère les données reçues
    $requeteLog1 = $bdd->prepare("
        INSERT INTO logajoutpre(Nom, Prerequis, Date, type)
        VALUES(:nom, :prerequis, :date, :type)");
    $requeteLog1->bindParam(':nom',$nom);
    $requeteLog1->bindParam(':prerequis',$nomprerequis); 
    $requeteLog1->bindParam(':date',$now); 
    $requeteLog1->bindParam(':type',$ajout); 


    $requeteLog1->execute();
  }   
  catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
  }
  

}
}


