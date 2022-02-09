<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');


include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();

include 'config/menu.php';
?>

<main id="main" class="main">
<!-- Vendor JS Files -->
<!-- Vendor JS Files -->
<div class="pagetitle">
  <h1>OCMF - Vivier de Candidats possédant la Formation</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Vivier</li>
      <li class="breadcrumb-item active">Candidats/Formation</li>
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
                <div class="col-md-12">
                  <div class="form-floating mb-3">
                    <select name="formation" class="form-select" id="floatingSelect" aria-label="Selection de la Formation" required>
                      <?php
                      
                      $req190 = $bdd->query("SELECT * FROM `Formation`  GROUP BY `Nom_Prerequis`");                      $varListDeroulante=1;
                      while ($donnees190 = $req190->fetch()){?>
                      
                        <option value="<?php echo $donnees190['Nom_Prerequis'];?>"><?php echo $donnees190['Nom_Prerequis'] ?></option>
                        
                      <?php
                      }?>

                    </select>
                    <label for="floatingSelect">Selection de la Formation</label>
                  </div>
                </div>               
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Envoyer</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
                    </section>
                    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">OCMF - Viviers de candidats</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">SAP</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Régiment</th>
                  </tr>
                </thead>
                <tbody>

<?php 

$formation = $_POST['formation'];

// RECUPERATION DU NUMERO DE PREREQUIS
$req2 = $bdd->query("SELECT *
FROM Formation WHERE Nom_Prerequis LIKE '$formation'");
$donnees2 = $req2->fetch();
$numPrerequisFormation = $donnees2['NumPrérequis'];
// RECUPERATION DU PERSONNEL QUI A LE PREREQUIS
$req3 = $bdd->query("SELECT *
FROM formationliaison WHERE Num_Prerequis LIKE '$numPrerequisFormation'");
if (!empty($formation)){?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i>
                <b>Formation selectionné : <? echo $formation?></b><br>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
<?php 
$k =1;
while ($donnees3 = $req3->fetch()){
    $iduser = $donnees3['id_user'];
    //echo $numPrerequisFormation;
    $req4 = $bdd->query("SELECT *
    FROM utils WHERE id LIKE '$iduser'");
    $donnees4 = $req4->fetch();
    $regiment= $donnees4['regiment'];
    $reqVerifReg = $bdd->query("SELECT *
    FROM regiments WHERE ID_FK LIKE '$regiment'");
    $donneesVerifReg = $reqVerifReg->fetch();

    //AFFICHAGE TABLEAU
    ?>
    
    <tr>

    <td> <b><?php echo $donnees4['nom']?></b></td>
    <td> <b> <?php echo $donnees4['prenom']?></b></td>
    <td> <b> <?php echo $donnees4['sap']?></b></td>
    <td> <?php echo $donnees4['Grade']?></td>
    <td> <?php echo $donneesVerifReg['NomRegiment']?></td>
   </tr>    


<?php 
$k = 2;

}

$numPrerequis=$numPrerequisFormation;
//echo $numPrerequisFormation;
    $req70 = $bdd->query("SELECT *
    FROM Equivalence WHERE liaison_id_prerequis LIKE '$numPrerequis'");
    
    while ($colonnes = $req70->fetch()){
        $idequivalence = $colonnes['id_prerequis'];
  //      echo $idequivalence;
        $req17 = $bdd->query("SELECT *
        FROM formationliaison WHERE Num_Prerequis LIKE '$idequivalence'");
        while($colonnes2 = $req17->fetch()){
            $iduser = $colonnes2['id_user'];
            $req45 = $bdd->query("SELECT *
            FROM utils WHERE id LIKE '$iduser'");
            $donnees45 = $req45->fetch();
            $regiment= $donnees45['regiment'];
            $reqVerifReg = $bdd->query("SELECT *
            FROM regiments WHERE ID_FK LIKE '$regiment'");
            $donneesVerifReg = $reqVerifReg->fetch();
            ?>
    
            <tr>

            <td> <b><?php echo $donnees45['nom']?></b></td>
            <td> <b> <?php echo $donnees45['prenom']?></b></td>
            <td> <b> <?php echo $donnees45['sap']?></b></td>
            <td> <?php echo $donnees45['Grade']?></td>
            <td> <?php echo $donneesVerifReg['NomRegiment']?></td>
            </tr>    



<?php 
        


        }
    }

}
   /* $boucle=0;
    foreach($colonnes as $colonne) {

        $tabequivalence[$boucle]= $colonne['liaison_id_prerequis'];
         //// echo '<br/>Tab['.$boucle.']='.$tabequivalence[$boucle].'<br/>';
        $boucle=$boucle+1;
    }
    for ($bouclefor=0;$bouclefor<$boucle;$bouclefor++){
        if ($tabequivalence[$bouclefor]==$tabnum[$k]){
            $tableaucheck[$checked]=1;
            $checked++;
           // echo '<br>YES<br>';
        }
    }*/