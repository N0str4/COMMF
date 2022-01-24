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
<main id="main" class="main">

<div class="pagetitle">
  <h1>Ajout d'équivalence</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Equivalence</li>
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
                    <select name="Equi-Prerequis1" class="form-select" id="floatingSelect" aria-label="Choix du Pré-Requis" required>
                      <?php
                      
                      $req4 = $bdd->query("SELECT * FROM `Formation`");
                      while ($donnees4 = $req4->fetch()){?>
                      
                        <option value="<?php echo $donnees4['NumPrérequis'];?>"><?php echo $donnees4['Nom_Prerequis'] ?></option>
                        
                      <?php
                      }
                    ?>

                    </select>
                    <label for="floatingSelect">Equivalence Prérequis</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-3">
                    <select name="Equi-Prerequis2" class="form-select" id="floatingSelect" aria-label="Choix du Pré-Requis" required>
                      <?php
                      
                      $req3 = $bdd->query("SELECT * FROM `Formation`");

                      while ($donnees3 = $req3->fetch()){?>
                        <option value="<?php echo $donnees3['NumPrérequis']; ?>"><?php echo $donnees3['Nom_Prerequis'] ?></option>
                        
                      <?php
                      }
                    ?>

                    </select>
                    <label for="floatingSelect">Equivalence Prérequis</label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

<?php
$numprerequis1 = $_POST['Equi-Prerequis1'];
$numprerequis2 = $_POST['Equi-Prerequis2'];
$now = date('Y-m-d H:i:s');

$req2 = $bdd->query("SELECT * FROM `Equivalence` WHERE id_prerequis LIKE '$numprerequis1' AND liaison_id_prerequis LIKE '$numprerequis2'");
$donnees2 = $req2->fetch();

$req6 = $bdd->query("SELECT * FROM `Formation` WHERE NumPrérequis LIKE '$numprerequis1'");
$donnees6 = $req6->fetch();
$req7 = $bdd->query("SELECT * FROM `Formation` WHERE NumPrérequis LIKE '$numprerequis2'");
$donnees7 = $req7->fetch();

$ajout="AJOUT";


if (empty($donnees2)){
if((!empty($numprerequis1) && !empty($numprerequis2))){
try{
    //On insère les données reçues
    $sth = $bdd->prepare("
        INSERT INTO Equivalence(id_prerequis, liaison_id_prerequis)
        VALUES(:id, :idpre)");
    $sth->bindParam(':id',$numprerequis1);
    $sth->bindParam(':idpre',$numprerequis2);
    $sth->execute();
    
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">SUCCESS</h4>
                <p>L'équivalence du pré-requis <b><?php echo $donnees6['Nom_Prerequis']. "<b/> avec l'équivalence </b>".$donnees7['Nom_Prerequis'] ?> </b> à bien était intégré à la base de donné. </p>
                <hr>                
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>



<?php  try{
    //On insère les données reçues
    $requeteLog1 = $bdd->prepare("
        INSERT INTO logsequivalence(Nom, Equivalence, Equivalence2, Date, type)
        VALUES(:nom, :Equivalence, :Equivalence2 , :date, :type)");
    $requeteLog1->bindParam(':nom',$donnees['lname']);
    $requeteLog1->bindParam(':Equivalence',$numprerequis1); 
    $requeteLog1->bindParam(':Equivalence2',$numprerequis2); 
    $requeteLog1->bindParam(':date',$now); 
    $requeteLog1->bindParam(':type',$ajout); 


    $requeteLog1->execute();
  }   
  catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
  }






}}elseif (!empty($donnees2)){  
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">ERROR</h4>
    <p> Le Pré-Requis du nom de <b><?php echo $donnees6['Nom_Prerequis']?> </b> possède déjà une équivalence avec <b><?php echo $donnees7['Nom_Prerequis']?> </b>.</p>
    <hr>
    <p class="mb-0">Dans le cas, ou vous avez un doute sur la présence ou non d'une équivalence, il est préconiser de vous rendre dans la Visualisation des Equivalences.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

<?php


}