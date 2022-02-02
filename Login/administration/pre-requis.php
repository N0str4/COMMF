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
  <h1>OCMF - Conditions Pré-Requis</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Recherche</li>
      <li class="breadcrumb-item active">Conditions Pré-Requis</li>
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
                    <input type="text" class="form-control" name="sap" id="floatingName" placeholder="SAP" required>
                    <label for="floatingName">SAP</label>
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
                  <div class="form-floating mb-3">
                    <select name="formation" class="form-select" id="floatingSelect" aria-label="Selection de la Formation" required>
                      <?php
                      
                      $req190 = $bdd->query("SELECT * FROM `Formationdetails`  GROUP BY `nomformation`");                      $varListDeroulante=1;
                      while ($donnees190 = $req190->fetch()){?>
                      
                        <option value="<?php echo $donnees190['nomformation'];?>"><?php echo $donnees190['nomformation'] ?></option>
                        
                      <?php
                      }?>

                    </select>
                    <label for="floatingSelect">Selection de la Formation</label>
                  </div>
                </div>               
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
              <h5 class="card-title">OCMF - Résultats</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Nom de la Formation</th>
                    <th scope="col">PréRequis</th>
                    <th scope="col">Validité</th>
                    <th scope="col">Recyclage</th>
                  </tr>
                </thead>
                <tbody>

<?php 




    

// SCRIPT PHP BY
// BY AYMERICK 
// DO NOT COPY



$sap = $_POST['sap'];
$formation = $_POST['formation'];

if (!empty($sap)) {
$req4 = $bdd->query("SELECT *
FROM utils WHERE sap LIKE '$sap'");
$donnees4 = $req4->fetch();
$id_userSAP = $donnees4['id'];
$type_user = $donnees4['type'];
$now = date('Y-m-d H:i:s');

// INTRODUCTION LOG
$requete = $bdd->query("SELECT * FROM `users` WHERE unique_id LIKE '{$_SESSION['unique_id']}'");
$donneesrecup = $requete->fetch(); // PERMET D'AVOIR NOM/PRENOM SITUER DANS LE MENU, AU TOP DU SITE
// END INTRODUCTION LOG
// REQ LOG


//////////    RECYCLAGE  VERIFICATION SI LES STAGES ONT BESOIN D'UN RECYCLAGE ////// 
$valeurrecyclage=1;
$req67 = $bdd->query("SELECT *
FROM Formation WHERE recyclage LIKE '$valeurrecyclage'");
$entites= $req67->fetchAll(PDO::FETCH_ASSOC);
/*var_dump($rows);*/
$i=0;
foreach($entites as $entite) {
    /* DEBUG MODE */
   // /**/ echo '<br />';
   // /**/ echo 'i='.$i;
   // /**/ echo '<br />';
    /* END DEBUG MODE */
    $testRecyclage[$i] = $entite['NumPrérequis'];
    /* DEBUG MODE */
    //echo 'testRecyclage['.$i.']='.$testRecyclage[$i];
   // /**/ echo '<br/>';
    /* END DEBUG MODE */
    $i=$i+1;
    /* DEBUG MODE */
   // /**/ echo 'i='.$i;
   // /**/ echo '<br />';
    
    /* END DEBUG MODE */

}

///////////

//////////    VALIDITE  VERIFICATION SI LES STAGES ONT BESOIN D'UN VALIDITE >5 ////// 
$valeurValidite5=5;
$req68 = $bdd->query("SELECT *
FROM Formation WHERE validité LIKE '$valeurValidite5'");
$valeurs= $req68->fetchAll(PDO::FETCH_ASSOC);
/*var_dump($rows);*/
$i=0;
foreach($valeurs as $valeur) {
    /* DEBUG MODE */
   // /**/ echo '<br />';
   // /**/ echo 'i='.$i;
   // /**/ echo '<br />';
    /* END DEBUG MODE */
    $testValidite5[$i] = $valeur['NumPrérequis'];
    /* DEBUG MODE */
   //echo '<br> testValidite5['.$i.']='.$testValidite5[$i];
   // /**/ echo '<br/>';
    /* END DEBUG MODE */
    $i=$i+1;
    /* DEBUG MODE */
   // /**/ echo 'i='.$i;
   // /**/ echo '<br />';
    
    /* END DEBUG MODE */

}

///////////

//////////    VALIDITE  VERIFICATION SI LES STAGES ONT BESOIN D'UN VALIDITE >4 ////// 
$valeurValidite4=4;
$req69 = $bdd->query("SELECT *
FROM Formation WHERE validité LIKE '$valeurValidite4'");
$infos= $req69->fetchAll(PDO::FETCH_ASSOC);
/*var_dump($rows);*/
$i=0;
foreach($infos as $info) {
    /* DEBUG MODE */
   // /**/ echo '<br />';
   // /**/ echo 'i='.$i;
   // /**/ echo '<br />';
    /* END DEBUG MODE */
    $testValidite4[$i] = $info['NumPrérequis'];
    /* DEBUG MODE */
    //echo '<br> testValidite4['.$i.']='.$testValidite4[$i];
   // /**/ echo '<br/>';
    /* END DEBUG MODE */
    $i=$i+1;
    /* DEBUG MODE */
   // /**/ echo 'i='.$i;
   // /**/ echo '<br />';
    
    /* END DEBUG MODE */

}

///////////




$req5 = $bdd->query("SELECT Num_Prerequis,dateobtention
FROM formationliaison WHERE id_user LIKE '$id_userSAP'");
$rows= $req5->fetchAll(PDO::FETCH_ASSOC);
/*var_dump($rows);*/
$i=0;

foreach($rows as $row) {
    /* DEBUG MODE */
   // /**/ echo '<br />';
   // /**/ echo 'i='.$i;
   // /**/ echo '<br />';
    /* END DEBUG MODE */
    $tabdate[$i] = $row['dateobtention'];
    $tab[$i] = $row['Num_Prerequis'];
    /* DEBUG MODE */
   // /**/ echo 'Tab['.$i.']='.$tab[$i];
   // /**/ echo '<br/>';
    /* END DEBUG MODE */
    $i=$i+1;
    /* DEBUG MODE */
   // /**/ echo 'i='.$i;
   // /**/ echo '<br />';
    
    /* END DEBUG MODE */

}

$req18 = $bdd->query("SELECT num_prerequis
FROM Formationdetails WHERE nomformation LIKE '$formation'");
$sorties = $req18->fetchAll();


$n=0;
foreach($sorties as $sortie) {
    $tabnum[$n] = $sortie['num_prerequis'];
    //echo '<br> Résult : '.$sortie['num_prerequis'].'<br>';
    if ($tabnum[$n]==29){ // Formation Civ
        $VerifCivOrMil = 0;
       // echo $VerifCivOrMil;
    }elseif($tabnum[$n]==28){ // Formation Millitaire
        $VerifCivOrMil = 1;
        //echo $VerifCivOrMil;
    } else {
        $VerifCivOrMil = 3; // Formation ouverte au deux
       // echo '<br> VERIF /./ '.$VerifCivOrMil.'<br>';
    }
    $civOuMillitaire=$civOuMillitaire+1;
}

// CHECK
$req = $bdd->query("SELECT * FROM `Formationdetails` WHERE nomformation LIKE '$formation' ORDER BY num_prerequis");
$req2 = $bdd->query("SELECT *
FROM `Formationdetails`
INNER JOIN Formation
ON Formationdetails.num_prerequis = Formation.NumPrérequis WHERE nomformation LIKE '$formation' AND `type` LIKE '$type_user' ");
$type_user2=3;
$req80 = $bdd->query("SELECT *
FROM `Formationdetails`
INNER JOIN Formation
ON Formationdetails.num_prerequis = Formation.NumPrérequis WHERE nomformation LIKE '$formation' AND `type` LIKE '$type_user2' ");

}
if(is_null($donnees4['nom'])==false && !empty($sap)){
    
    
    
    
    
    
    
    ?>

<?php }?>
    <?php $k=0;?>
<?php while ($donnees = $req2->fetch()){?>
<?php
$now = date('Y-m-d H:i:s');
    for ($k=0; $k<20; $k++){
        $boucle = 0;
        /* DEBUG MODE */
        /////**/ echo '<br/>K= '.$k.'<br/>';
        ///**/ echo 'TAB K egal : '.$tab[$k].'///';
        /* END DEBUG MODE */
        $numverif = $donnees['num_prerequis'];
        $test=$tab[$k];
        ///**/echo $numverif.'<br.>';
        $req7 = $bdd->query("SELECT liaison_id_prerequis
        FROM Equivalence WHERE id_prerequis LIKE '$test'");
        $colonnes = $req7->fetchAll();
        foreach($colonnes as $colonne) {

            $tabequivalence[$boucle]= $colonne['liaison_id_prerequis'];
             ///**/ echo '<br/>Tab['.$boucle.']='.$tabequivalence[$boucle].'<br/>';
            $boucle=$boucle+1;
        }
         ///**/ echo '<br/>---<br/>';
        for ($bouclefor=0;$bouclefor<$boucle;$bouclefor++){
            if ($tabequivalence[$bouclefor]==$numverif){
              $KALAMOUR= verificationEquivalenceOui($test, $tabequivalence,$bouclefor);
              $RECYCLAGE = 'NON';
            }
        }



        $diff = 0;
        if ($test== $numverif){

            $KALAMOUR = 'VALIDE';
            /* DEBUG MODE */
           // /**/ echo '<div class="bold"> <br/>| !!!!!      DEBUG MODE      !!!!! | </div><br/>';
          ///**/ echo ' | (FORMATION) =  |  '.$donnees['Nom_Prerequis'];
          //   /**/ echo '<br/> | (ETATVALIDE)<br/>';
            /* END DEBUG MODE */

            $req6 = $bdd->query("SELECT dateobtention
            FROM formationliaison WHERE Num_Prerequis LIKE '$test' AND id_user LIKE '$id_userSAP'");
            $donnees18 = $req6->fetch();
            $date1 = $donnees18['dateobtention'];    
            $diff  = abs($now - $date1);  
            
            /* DEBUG MODE */
           // /**/  echo ' | (Numéro du Prérequis =  |  '.$test.'  |)<br/>';
           // /**/ echo ' | (DATE Aujourd hui =  |  '.$now.'  |)<br/>';
           // /**/ echo ' | (DATE Obtention =  |  '.$date1.'  |)<br/>';
           ///**/ echo ' | (Difference de date entre obtention et aujourdhui =  |  '.$diff.'  |)<br/>';
            ///**/ echo ' | (FORMATION =  |  '.$test.'  |)<br/>';

           // /* END DEBUG MODE */
           $TESTOK = verifRecyclageV2($diff,$testRecyclage,$test);
           if($TESTOK=='RECYCLAGE'){
               $RECYCLAGE='OUI';
           }elseif ($TESTOK=='N/R'){
               $RECYCLAGE='NON';
           }
           $VALIDITECHECK = verifValidite5($diff, $testValidite5,$test);
           $VALIDITECHECK4=verifValidite4($diff, $testValidite4,$test);
           //echo '<br>RECY'.$TESTOK;
           //echo '<br>VALI 4 '.$VALIDITECHECK4;
           //echo '<br>VALI 5 '.$VALIDITECHECK;
           if($VALIDITECHECK=='NONVALIDE' || $VALIDITECHECK4=='NONVALIDE'){
            $KALAMOUR="NONVALIDE";
            }else{
            $KALAMOUR="VALIDE";
            }
           //echo '<br>'.$KALAMOUR;
        } 
    }    
    if(is_null($donnees4['nom'])==false && !empty($sap)){   
    if ($VerifCivOrMil==1 && $type_user==1){
                ?> 

                <tr>

                    <td> <?php echo $donnees4['nom']?></td>
                    <td> <?php echo $donnees['nomformation']?></td>
                    <td> <?php echo $donnees['Nom_Prerequis']?></td>
                    <?php if ($KALAMOUR=='VALIDE'){?> 
                        <td class="val"><?php echo '<b><k style="color:green">'.$KALAMOUR.'</k></b>'; 
                    }else {?> 
                        <td class="nv"><?php echo '<k style="color:red"> <b>NON VALIDE</b></k>';}?>
                    </td>
                    <?php if ($RECYCLAGE=='OUI'){?> <td class="okrecy"><?php echo '<k style="color:red"> <b>OUI</b></k>'; }else {?> <td class="nonrecy"><?php echo '<b>NON</b>';}?></td></tr>    
        <?php }
        if ($VerifCivOrMil==1 && $type_user==0){
                ?> 
     <?php }
        if ($VerifCivOrMil==0 && $type_user==0){
                ?> 

                <tr><td> <?php echo $donnees4['nom']?></td>
                <td> <?php echo $donnees['nomformation']?></td>
                <td> <?php echo $donnees['Nom_Prerequis']?></td>
                <?php if ($KALAMOUR=='VALIDE'){?> <td class="val">
                    <?php echo '<b><k style="color:green">'.$KALAMOUR.'</k></b>';  }else {?> <td class="nv"><?php echo '<k style="color:red"> <b>NON VALIDE</b></k>';}?>
                </td>
                <?php if ($RECYCLAGE=='OUI'){?> <td class="okrecy"><?php echo '<k style="color:red"> <b>OUI</b></k>'; }else {?> <td class="nonrecy"><?php echo '<b>NON</b>';}?></td></tr>    
        <?php }if ($VerifCivOrMil==0 && $type_user==1){
                ?> 

                        <?php }
        if ($VerifCivOrMil==3){
                ?> 

<tr><td> <?php echo $donnees4['nom']?></td>
                <td> <?php echo $donnees['nomformation']?></td>
                <td> <?php echo $donnees['Nom_Prerequis']?></td>
                <?php if ($KALAMOUR=='VALIDE'){?> <td class="val">
                    <?php echo '<b><k style="color:green">'.$KALAMOUR.'</k></b>';  }else {?> <td class="nv"><?php echo '<k style="color:red"> <b>NON VALIDE</b></k>';}?>
                </td>
                <?php if ($RECYCLAGE=='OUI'){?> <td class="okrecy"><?php echo '<k style="color:red"> <b>OUI</b></k>'; }else {?> <td class="nonrecy"><?php echo '<b>NON</b>';}?></td></tr>    
            <?php }
        }else{?> 
            <script type="text/javascript">
                alert('SAP INVALIDE !');
                window.location.replace("http://intradef.vikatchev.com");
            </script>
            
        <?php }?> 
<?php 
$RECYCLAGE = 'NON';
$KALAMOUR = 'NONVALIDE';
}?><?php while ($donnees80 = $req80->fetch()){?>
    <?php
    $now = date('Y-m-d H:i:s');
        for ($k=0; $k<20; $k++){
            $boucle = 0;
            /* DEBUG MODE */
            ///**/ echo 'K= '.$k.'';
            // echo 'TAB K egal : '.$tab[$k].'///';
            /* END DEBUG MODE */
            $numverif = $donnees80['num_prerequis'];
            $test=$tab[$k];
            ///**/echo $numverif.'<br.>';
            $req7 = $bdd->query("SELECT liaison_id_prerequis
            FROM Equivalence WHERE id_prerequis LIKE '$test'");
            $colonnes = $req7->fetchAll();
            foreach($colonnes as $colonne) {
    
                $tabequivalence[$boucle]= $colonne['liaison_id_prerequis'];
                ///**/ echo '<br/>Tab['.$boucle.']='.$tabequivalence[$boucle].'<br/>';
                $boucle=$boucle+1;
            }
           ///**/ echo '<br/>---<br/>';
            for ($bouclefor=0;$bouclefor<$boucle;$bouclefor++){
                if ($tabequivalence[$bouclefor]==$numverif){
                  $KALAMOUR= verificationEquivalenceOui($test, $tabequivalence,$bouclefor);
                  $RECYCLAGE = 'NON';
                }
            }
    
    
    
            $diff = 0;
            if ($test== $numverif){
    
                $KALAMOUR = 'VALIDE';
                /* DEBUG MODE */
                ///**/ echo '<div class="bold"> <br/>| !!!!!      DEBUG MODE      !!!!! | </div><br/>';
                ///**/ echo ' | (FORMATION) =  |  '.$donnees80['Nom_Prerequis'];
                ///**/ echo '<br/> | (ETATVALIDE)<br/>';
                /* END DEBUG MODE */
    
                $req6 = $bdd->query("SELECT dateobtention
                FROM formationliaison WHERE Num_Prerequis LIKE '$test' AND id_user LIKE '$id_userSAP'");
                $donnees18 = $req6->fetch();
                $date1 = $donnees18['dateobtention'];    
                $diff  = abs($now - $date1);  
                
                /* DEBUG MODE */
               //  echo ' | (Numéro du Prérequis =  |  '.$test.'  |)<br/>';
               // /**/ echo ' | (DATE Aujourd hui =  |  '.$now.'  |)<br/>';
               // /**/ echo ' | (DATE Obtention =  |  '.$date1.'  |)<br/>';
               ///**/ echo ' | (Difference de date entre obtention et aujourdhui =  |  '.$diff.'  |)<br/>';
                /* END DEBUG MODE */
                $TESTOK = verifRecyclageV2($diff,$testRecyclage,$test);
                if($TESTOK=='RECYCLAGE'){
                    $RECYCLAGE='OUI';
                }elseif ($TESTOK=='N/R'){
                    $RECYCLAGE='NON';
                }
                $VALIDITECHECK = verifValidite5($diff, $testValidite5,$test);
                $VALIDITECHECK4 = verifValidite4($diff, $testValidite4,$test);
                if($VALIDITECHECK=='NONVALIDE' || $VALIDITECHECK4=='NONVALIDE'){
                 $KALAMOUR="NONVALIDE";
                 }else{
                 $KALAMOUR="VALIDE";
             }
               // echo '<br>VALIDITER 1 :'.$VALIDITECHECK;
               // echo ' <br> TESTOK'.$TESTOK.' <br>VALIDITE4'.$VALIDITECHECK4;
            } 
        }    
        if(is_null($donnees4['nom'])==false && !empty($sap)){   
            if ($VerifCivOrMil==3){
                    ?> 

<tr>
    <td> <?php echo $donnees4['nom']?></td>
    <td> <?php echo $donnees80['nomformation']?></td>
    <td> <?php echo $donnees80['Nom_Prerequis']?></td>
    <?php if ($KALAMOUR=='VALIDE'){?> <td class="val">
                    <?php echo '<b><k style="color:green">'.$KALAMOUR.'</k></b>';  }else {?> <td class="nv"><?php echo '<k style="color:red"> <b>NON VALIDE</b></k>';}?>
                </td>
                <?php if ($RECYCLAGE=='OUI'){?> <td class="okrecy"><?php echo '<k style="color:red"><b> OUI</b></k>'; }else {?> <th class="nonrecy"><?php echo '<b>NON</b>';}?></td></tr>    

                <?php }
            }else{?> 
                <script type="text/javascript">
                    alert('SAP INVALIDE !');
                    window.location.replace("http://intradef.vikatchev.com");
                </script>
                
            <?php }?> 
    <?php 
    $RECYCLAGE = 'NON';
    $KALAMOUR = 'NONVALIDE';
    }?>  

                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

    </main><!-- End #main -->
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


<?php 
try{
    //On insère les données reçues
    $requeteLOG = $bdd->prepare("
        INSERT INTO logsrecherche(nom, prenom, date, sap, formation)
        VALUES(:nom, :prenom, :date, :sap, :formation)");
    $requeteLOG->bindParam(':nom',$donneesrecup['lname']);
    $requeteLOG->bindParam(':prenom',$donneesrecup['fname']); 
    $requeteLOG->bindParam(':date',$now); 
    $requeteLOG->bindParam(':sap',$sap); 
    $requeteLOG->bindParam(':formation',$formation); 


    $requeteLOG->execute();
}   
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
  



/// VERIF RECYCLAGE
function verifRecyclageV2($diff, $testRecyclage,$test){
    for ($bouclefor2=0;$bouclefor2<10;$bouclefor2++){
        // echo '<br>DIFF :'.$diff;
        // echo '<br>TEST RECY : '.$testRecyclage[$bouclefor2];
        // echo '<br>TEST  : '.$test.'<br>';

        if ($diff>5 and ($testRecyclage[$bouclefor2]==$test)) {   
            return $TEST = 'RECYCLAGE';
            $bouclefor2=11;

            /* DEBUG MODE */
            // echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' NECESSITE UN RECYCLAGE TOUT LES 5 ANS)<br/>';
            // echo ' | (RECYCLAGE NECCESSAIRE :'.$RECYCLAGE.')<br/>';
            /* END DEBUG MODE */
    
        }else {
            
        } 
    } 
    return $TEST= 'N/R';
} 


/// VERIF VALIDITER >5
function verifValidite5($diff, $testValidite5,$test){
    for ($bouclefor2=0;$bouclefor2<20;$bouclefor2++){

        if ($diff>5 and ($testValidite5[$bouclefor2]==$test)) {    
            return $TEST = 'NONVALIDE';
            $bouclefor2=11;

            /* DEBUG MODE */
           //  echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' NECESSITE UN RECYCLAGE TOUT LES 5 ANS)<br/>';
           //  echo ' | (RECYCLAGE NECCESSAIRE :'.$RECYCLAGE.')<br/>';
            /* END DEBUG MODE */
    
        }else {
            
        } 
        
    } 
    return $TEST= 'VALIDE';
} 
///   VERIF VALIDITER >4
function verifValidite4($diff, $testValidite4,$test){
    for ($bouclefor2=0;$bouclefor2<20;$bouclefor2++){
        // echo $testValidite4[$bouclefor2].'='.$test;
        if ($diff>4 and ($testValidite4[$bouclefor2]==$test)) { 
            $TEST2 = 'NONVALIDE';
            return $TEST2;
            $bouclefor2=22;

            /* DEBUG MODE */
           //  echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' NECESSITE UN RECYCLAGE TOUT LES 5 ANS)<br/>';
           //  echo ' | (RECYCLAGE NECCESSAIRE :'.$RECYCLAGE.')<br/>';
            /* END DEBUG MODE */
    
        }

    } 
    $TEST2= 'VALIDE';
    return $TEST2;
} 



function verifRecyclage($diff,$test,$donnees){
    if (($diff>5 and $test==12) or ($diff>5 and $test==13) or ($diff>5 and $test==14) or ($diff>5 and $test==15)) {    
        return $TEST = 'RECYCLAGE';
        /* DEBUG MODE */
        //echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' NECESSITE UN RECYCLAGE TOUT LES 5 ANS)<br/>';
        //echo ' | (RECYCLAGE NECCESSAIRE :'.$RECYCLAGE.')<br/>';
        /* END DEBUG MODE */

    } elseif ($diff>5 and $test==16){  
        /* DEBUG MODE */
        //echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' A UNE VALIDITE DE 5 ANS)<br/>';
        //echo ' | (RECYCLAGE : NON<br/>';
        //echo ' | (VALIDITER : <k>REVOQUER</k><br/><br/>';
        return $TEST = 'NONVALIDE';
        /* END DEBUG MODE */
        
    } elseif ($diff>4 and $test==17){  
        /* DEBUG MODE */
        //echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' A UNE VALIDITE DE 4 ANS)<br/>';
        //echo ' | (RECYCLAGE : NON<br/>';
       // echo ' | (VALIDITER : <k> REVOQUER</k><br/><br/>';
        return $TEST = 'NONVALIDE';
        /* END DEBUG MODE */
        
    }
    elseif ($diff>5 and $test!=12 || $test=!13 || $test=!14 || $test=!15){  
        /* DEBUG MODE */
       // echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' NE NECESSITE PAS DE RECYCLAGE)<br/>';
        //echo ' | (RECYCLAGE : NON<br/><br/>';
        return $TEST = 'VALIDE';
        /* END DEBUG MODE */
        
    }
    else {  
        /* DEBUG MODE */
       // echo ' | (RECYCLAGE : NON<br/><br/>';
        return $TEST = 'VALIDE';
        /* END DEBUG MODE */   
    } 
}
function verificationEquivalenceOui($test, $tabequivalence,$bouclefor){
    $KALAMOUR = 'VALIDE';
  // echo '<br/> Formation équivalente ! Diplome de base :  '.$test.'<br/>';
   // echo 'Diplome equivalent : '.$tabequivalence[$bouclefor].'<br/>';
    return $KALAMOUR;
}