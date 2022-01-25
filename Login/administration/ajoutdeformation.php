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


<main id="main" class="main">

<div class="pagetitle">
  <h1>Ajout de Formation</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Formation</li>
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
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="nomforma" id="floatingName" placeholder="Nom de la nouvelle Formation" required>
                    <label for="floatingName">Nom de la nouvelle Formation</label>
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
                <div class="col-md-12">
                  <div class="form-floating">
                    <select name="selection"class="form-select" id="floatingName" aria-label="TEST" required>
                      <option value="1">Personnel Millitaire</option>
                      <option value="0">Personnel Civil</option>
                      <option value="2">Les deux</option>
                    </select>
                    <label for="floatingSelect">Formation à destination de :</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select name="prerequis1" class="form-select" id="floatingSelect" aria-label="Choix du Pré-Requis" required>
                      <?php
                      
                      $req4 = $bdd->query("SELECT * FROM `Formation`");
                      $varListDeroulante=1;
                      while ($donnees4 = $req4->fetch()){?>
                      
                        <option value="<?php echo $donnees4['NumPrérequis'];?>"><?php echo $donnees4['Nom_Prerequis'] ?></option>
                        
                      <?php
                      $varListDeroulante=$varListDeroulante+1;
                      }
                    ?>

                    </select>
                    <label for="floatingSelect">Selection du Pré-Requis</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select name="prerequis2" class="form-select" id="floatingSelect" aria-label="Choix du Pré-Requis" required>
                      <?php
                      
                      $req3 = $bdd->query("SELECT * FROM `Formation`");
                      $varListDeroulante=1;
                      while ($donnees3 = $req3->fetch()){?>
                        <option value="<?php echo $donnees3['NumPrérequis']; ?>"><?php echo $donnees3['Nom_Prerequis'] ?></option>
                        
                      <?php
                      $varListDeroulante=$varListDeroulante+1;
                      }
                    ?>
                     <option value="0" selected>Aucune</option>
                    </select>
                    <label for="floatingSelect">Selection du Pré-Requis</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select name="prerequis3" class="form-select" id="floatingSelect" aria-label="Choix du Pré-Requis" required>
                      <?php
                      
                      $req2 = $bdd->query("SELECT * FROM `Formation`");
                      $varListDeroulante=1;
                      while ($donnees2 = $req2->fetch()){?>
                        <option value="<?php echo $donnees2['NumPrérequis']; ?>"><?php echo $donnees2['Nom_Prerequis'] ?></option>
                        
                      <?php
                      $varListDeroulante=$varListDeroulante+1;
                      }
                    ?>
                    <option value="0" selected>Aucune</option>

                    </select>
                    <label for="floatingSelect">Selection du Pré-Requis</label>
                  </div>
                </div>
                <br>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                  <select name="selectionprerequis1" class="form-select" id="floatingSelect" aria-label="Selection CIV or MIL" required>
                      <option value="1">Pré-Requis Millitaire</option>
                      <option value="0">Pré-Requis Civil</option>
                      <option value="3">Pré-Requis Civil et Millitaire</option>
                    </select>
                    <label for="floatingSelect">PréRequis Civ ou Millitaire</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select name="selectionprerequis2" class="form-select" id="floatingSelect" aria-label="Selection CIV or MIL" required>
                      <option value="1">Pré-Requis Millitaire</option>
                      <option value="0">Pré-Requis Civil</option>
                      <option value="3">Pré-Requis Civil et Millitaire</option>
                    </select>
                    <label for="floatingSelect">PréRequis Civ ou Millitaire</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                  <select name="selectionprerequis3" class="form-select" id="floatingSelect" aria-label="Selection CIV or MIL" required>
                      <option value="1">Pré-Requis Millitaire</option>
                      <option value="0">Pré-Requis Civil</option>
                      <option value="3">Pré-Requis Civil et Millitaire</option>
                    </select>
                    <label for="floatingSelect">PréRequis Civ ou Millitaire</label>
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
$nom = $donnees['lname'];
$prenom = $donnees['fname'];
$nomformation = $_POST['nomforma'];
$selection = $_POST['selection'];
$nomprerequis1 = $_POST['prerequis1'];
$nomprerequis2 = $_POST['prerequis2'];
$nomprerequis3 = $_POST['prerequis3'];
$selectionCivMil1 = $_POST['selectionprerequis1'];
$selectionCivMil2 = $_POST['selectionprerequis2'];
$selectionCivMil3 = $_POST['selectionprerequis3'];
$k=1;
$now = date('Y-m-d H:i:s');
$ajout="AJOUT";

include 'config.php';



if(isset($nomformation)){
  $type=5;

if ($selection==0){
  // CIVIL
  try{
  $idFormaCivil=29;
  $envoieCivil = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $envoieCivil->bindParam(':id',$k);
    $envoieCivil->bindParam(':nomforma',$nomformation);
    $envoieCivil->bindParam(':numpre',$idFormaCivil);
    $envoieCivil->bindParam(':type',$type);
    $envoieCivil->execute();
  }catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
}elseif($selection==1){
  // MILI
  try{
  $idFormaMil=28;
  $envoieMil = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $envoieMil->bindParam(':id',$k);
    $envoieMil->bindParam(':nomforma',$nomformation);
    $envoieMil->bindParam(':numpre',$idFormaMil);
    $envoieMil->bindParam(':type',$type);
    $envoieMil->execute();

  }catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
}elseif($selection==2){
  //LES DEUX
  
}
}




if (isset($nomformation) && $nomprerequis2==0 && $nomprerequis3==0){

try{
  //On insère les données reçues
  $sth = $bdd->prepare("
      INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
      VALUES(:id, :nomforma, :numpre, :type)");
  $sth->bindParam(':id',$k);
  $sth->bindParam(':nomforma',$nomformation);
  $sth->bindParam(':numpre',$nomprerequis1);
  $sth->bindParam(':type',$selectionCivMil1);

  $sth->execute();
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <h4 class="alert-heading"> SUCCES !</h4>
    <p>La Formation à bien été ajouté avec 1 pré-requis.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div><?php

  
}
catch(PDOException $e){
  echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}
try{
  //On insère les données reçues
  $requeteLog1 = $bdd->prepare("
      INSERT INTO logsajout(Nom, Formation, Prerequis, Date, type)
      VALUES(:nom, :formation, :prerequis, :date, :type)");
  $requeteLog1->bindParam(':date',$now); 
  $requeteLog1->bindParam(':nom',$donnees['lname']);
  $requeteLog1->bindParam(':formation',$nomformation);
  $requeteLog1->bindParam(':prerequis',$nomprerequis1); 
  $requeteLog1->bindParam(':type',$ajout); 
  $requeteLog1->execute();
}   
catch(PDOException $e){
  echo "Erreur : " . $e->getMessage();
}
}elseif (isset($nomformation) && $nomprerequis2!=0 && $nomprerequis3==0){
  try{
 
    //On insère les données reçues
    $sth1 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth1->bindParam(':id',$k);
    $sth1->bindParam(':nomforma',$nomformation);
    $sth1->bindParam(':numpre',$nomprerequis1);
    $sth1->bindParam(':type',$selectionCivMil1);
    $sth1->execute();
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
  try{
 
    //On insère les données reçues
    $sth2 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth2->bindParam(':id',$k);
    $sth2->bindParam(':nomforma',$nomformation);
    $sth2->bindParam(':numpre',$nomprerequis2);
    $sth2->bindParam(':type',$selectionCivMil2);
    $sth2->execute();
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <h4 class="alert-heading"> SUCCES !</h4>
    <p>La Formation à bien été ajouté avec 2 pré-requis.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div><?php
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
  try{
    //On insère les données reçues
    $requeteLog1 = $bdd->prepare("
        INSERT INTO logsajout(Date, Nom, Formation, Prerequis, type)
        VALUES(:date, :nom, :formation, :prerequis, :type)");
    $requeteLog1->bindParam(':date',$now); 
    $requeteLog1->bindParam(':nom',$donnees['lname']);
    $requeteLog1->bindParam(':formation',$nomformation);
    $requeteLog1->bindParam(':type',$ajout); 
    $requeteLog1->bindParam(':prerequis',$nomprerequis1); 
  
  
    $requeteLog1->execute();
  }   
  catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
  }
  try{
    //On insère les données reçues
    $requeteLog2 = $bdd->prepare("
        INSERT INTO logsajout(Date, Nom, Formation, Prerequis, type)
        VALUES(:date, :nom, :formation, :prerequis, :type)");
    $requeteLog2->bindParam(':date',$now); 
    $requeteLog2->bindParam(':nom',$donnees['lname']);
    $requeteLog2->bindParam(':formation',$nomformation);
    $requeteLog2->bindParam(':type',$ajout); 
    $requeteLog2->bindParam(':prerequis',$nomprerequis2); 
    $requeteLog2->execute();
  }   
  catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
  }

}elseif (isset($nomformation) && $nomprerequis2!=0 && $nomprerequis3!=0){
  try{
 
    //On insère les données reçues
    $sth1 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth1->bindParam(':id',$k);
    $sth1->bindParam(':nomforma',$nomformation);
    $sth1->bindParam(':numpre',$nomprerequis1);
    $sth1->bindParam(':type',$selectionCivMil1);

    $sth1->execute();
  
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
  try{
 
    //On insère les données reçues
    $sth2 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth2->bindParam(':id',$k);
    $sth2->bindParam(':nomforma',$nomformation);
    $sth2->bindParam(':numpre',$nomprerequis2);
    $sth2->bindParam(':type',$selectionCivMil2);
    $sth2->execute();
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }try{
 
    //On insère les données reçues
    $sth3 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth3->bindParam(':id',$k);
    $sth3->bindParam(':nomforma',$nomformation);
    $sth3->bindParam(':numpre',$nomprerequis3);
    $sth3->bindParam(':type',$selectionCivMil3);
    $sth3->execute();
    // ** // 
    try{
      //On insère les données reçues
      $requeteLog1 = $bdd->prepare("
          INSERT INTO logsajout(Date, Nom, Formation, Prerequis, type)
          VALUES(:date, :nom, :formation, :prerequis, :type)");
      $requeteLog1->bindParam(':date',$now); 
      $requeteLog1->bindParam(':nom',$donnees['lname']);
      $requeteLog1->bindParam(':formation',$nomformation);
      $requeteLog1->bindParam(':type',$ajout); 
      $requeteLog1->bindParam(':prerequis',$nomprerequis1); 
    
    
      $requeteLog1->execute();
    }   
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }
    //** **/
    try{
      //On insère les données reçues
      $requeteLog2 = $bdd->prepare("
          INSERT INTO logsajout(Date, Nom, Formation, Prerequis, type)
          VALUES(:date, :nom, :formation, :prerequis, :type)");
      $requeteLog2->bindParam(':date',$now); 
      $requeteLog2->bindParam(':nom',$donnees['lname']);
      $requeteLog2->bindParam(':formation',$nomformation);
      $requeteLog2->bindParam(':type',$ajout); 
      $requeteLog2->bindParam(':prerequis',$nomprerequis2); 
    
    
      $requeteLog2->execute();
    }   
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }//** */
    try{
      //On insère les données reçues
      $requeteLog3 = $bdd->prepare("
          INSERT INTO logsajout(Date, Nom, Formation, Prerequis, type)
          VALUES(:date, :nom, :formation, :prerequis, :type)");
      $requeteLog3->bindParam(':date',$now); 
      $requeteLog3->bindParam(':nom',$donnees['lname']);
      $requeteLog3->bindParam(':formation',$nomformation);
      $requeteLog3->bindParam(':type',$ajout); 
      $requeteLog3->bindParam(':prerequis',$nomprerequis3); 
    
    
      $requeteLog3->execute();
    }   
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }
    
    
    
    
    
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <h4 class="alert-heading"> SUCCES !</h4>
    <p>La Formation à bien été ajouté avec 3 pré-requis.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div><?php
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

}


