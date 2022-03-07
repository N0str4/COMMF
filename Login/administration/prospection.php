<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');


include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();
$email = $donnees['email'];
// DECLARATION VARIABLE
$regiment = $_POST['regiment'];
$formation = $_POST['formation'];
include 'config/menu.php';
?>

<main id="main" class="main">
<!-- Vendor JS Files -->
<!-- Vendor JS Files -->
<div class="pagetitle">
  <h1>OCMF - Prospections de candidats</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Prospection</li>
      <li class="breadcrumb-item active">candidats</li>
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
                  <button type="submit" class="btn btn-primary">Envoyer</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
                    </section>

<? if(!empty($formation)){?>
                    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">OCMF - Prospection</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">SAP / Numéro Alliance</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Régiment</th>
                    <th scope="col">Prospection Possible</th>
                  </tr>
                </thead>
                <tbody>

<?php }


// COUNT DU NOMBRE DE PREREQUIS DE LA FORMATION
$req180 = $bdd->query("SELECT COUNT(*) AS total
FROM Formationdetails WHERE (nomformation LIKE '$formation' AND `type` LIKE '1') OR (nomformation LIKE '$formation' AND `type` LIKE '3') ");
$count180 = $req180->fetch();
$count180RESULT = $count180['total'];


// RECUPERATION DES NUMERO DE PREREQUIS POUR LA FORMATION

$req18 = $bdd->query("SELECT *
FROM Formationdetails WHERE (nomformation LIKE '$formation' AND `type` LIKE '1') OR (nomformation LIKE '$formation' AND `type` LIKE '3') ");
$sorties = $req18->fetchAll();

$n=0; 
foreach($sorties as $sortie) {
    $tabnum[$n] = $sortie['num_prerequis'];
    //echo '<br> Résult : '.$sortie['num_prerequis'].'<br>';
    //echo $tabnum[$n]; 
    $n++;
    //echo $n;
}




$req19 = $bdd->query("SELECT *
FROM utils");
$utilisateurnum = 0;
if (!empty($formation)){
  try{
    $etat = "Succès : Prospection réaliser pour  ".$formation;
    $now = date('Y-m-d H:i:s');
    $Erreur =0;

    $req = $bdd->prepare("
    INSERT INTO logsconnexionocmf(Email, Date, Etat, IP)
    VALUES(:email, :date, :etat, :ip)");
    $req->bindParam(':email', $email);
    $req->bindParam(':date', $now);
    $req->bindParam(':etat', $etat);
    $req->bindParam(':ip', $Erreur);
    $req->execute();
    }
      
    catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
    }

  }
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


    
while ($donnees19 = $req19->fetch()){
  $checked=0;
  $valeurPourVerifierSiDiplomeOKEtEquiOk=0;
  $possedeDejaLaFormation=0;
    $id_userSAP = $donnees19['id'];
    echo $donnees19['prenom'];
    //echo '<br>'.$id_userSAP.'<br>';
                $req5 = $bdd->query("SELECT *
                FROM formationliaison WHERE id_user LIKE '$id_userSAP'");
                $rows= $req5->fetchAll(PDO::FETCH_ASSOC);
                /*var_dump($rows);*/
                $i=0;
                // ON RECUPERE LES PREREQUIS DE LA PERSONNE
                foreach($rows as $row) {
                        /* DEBUG MODE */
                         // /**/ echo '<br />';
                         // /**/ echo 'i='.$i;
                         // /**/ echo '<br />';
                        /* END DEBUG MODE */
                        $tabdate[$i] = $row['dateobtention'];
                        $tab[$i] = $row['Num_Prerequis']; // ON STOCKE DANS UN TABLEAU LA VALEUR DU PREREQUIS
                        $numprerequisboucle=$tab[$i]; // ON LE MET DANS UNE VAR POUR LA REQ SQL
                        $req50 = $bdd->query("SELECT *
                        FROM Formation WHERE NumPrérequis LIKE '$numprerequisboucle'");
                        $output2 = $req50->fetch(); // ON RECUPERE LE NOM DU PREREQUIS
                        $stockageNomVar = $output2['Nom_Prerequis']; // ON STOCKE LE NOM DU PREREQUIS DANS UNE VAR
                        $date1 = $tabdate[$i];
                        $diff  = abs($now - $date1);
                        $isValid =  $output2['validité'];
                        $VALIDITECHECK = verifValidite5($diff, $testValidite5,$numprerequisboucle);
                        $VALIDITECHECK4 = verifValidite4($diff, $testValidite4,$numprerequisboucle);  

  
                        if($stockageNomVar==$formation){
                          if($isValid!=NULL){
                              if($VALIDITECHECK=='NONVALIDE' || $VALIDITECHECK4=='NONVALIDE'){
                                $possedeDejaLaFormation=0;
                              }else{
                                $possedeDejaLaFormation=1;

                              }

                          }else{
                          $possedeDejaLaFormation=1;
                        }
                      }
                        /* DEBUG MODE */
                          ///**/ echo 'Tab['.$i.']='.$tab[$i];
                          // /**/ echo '<br/>';
                        /* END DEBUG MODE */
                        $i=$i+1;
                        /* DEBUG MODE */
                         // /**/ echo 'i='.$i;
                         // /**/ echo '<br />';
                        
                        /* END DEBUG MODE */

                }
              if($possedeDejaLaFormation==0){
               echo '<br>UTILISATION : '.$utilisateurnum;
              echo '<br>'.$count180['total'];
                              $valide=0;
                for ($k=0;$k<20;$k++){// FORMA
                    for($p=0;$p<20;$p++){// UTIL
                        
                        echo '<br>PREREQUIS FORMA'.$tabnum[$k];
                        echo '<br> PREREQUIS UTIL'.$tab[$p];
                      

                        if($tabnum[$k]!=NULL){// SI PLUS DE PREREQUIS DE FORMA A CHECK
                            if($tabnum[$k]==$tab[$p]){
                                echo '<br>YES1<br>';
                                $date1 = $tabdate[$p];
                                $diff  = abs($now - $date1);
                                echo '<br>DIFFERENCE : '.$diff;  
                                $prerequis=$tab[$p];
                                $TESTOK = verifRecyclageV2($diff,$testRecyclage,$prerequis);
                                $VALIDITECHECK = verifValidite5($diff, $testValidite5,$prerequis);
                                $VALIDITECHECK4 = verifValidite4($diff, $testValidite4,$prerequis);

                                 if($TESTOK=='RECYCLAGE'){
                                     $RECYCLAGE='OUI';
                                     echo 'RECYKLAGE';
                                     echo '<br>CHEKED = '.$checked;
                                     $tableaucheck[$checked]=0;
                                     echo '<br>TAB : '.$checked.' : '.$tableaucheck[$checked].'<br>';
                                          $checked++;
                                    }elseif ($TESTOK=='N/R'){

                                      if($VALIDITECHECK=='NONVALIDE' || $VALIDITECHECK4=='NONVALIDE'){
                                        $KALAMOUR="NONVALIDE";
                                        echo '<b><br>'.$KALAMOUR.'</b>';
                                        echo '<br>CHEKED = '.$checked;
                                        $tableaucheck[$checked]=0;
                                        echo '<br>TAB : '.$checked.' : '.$tableaucheck[$checked].'<br>';
                                             $checked++;
                                        }else{
                                        echo $KALAMOUR="VALIDE";
                                        echo '<br>CHEKED = '.$checked;
                                        $tableaucheck[$checked]=1;
                                        echo '<br>TAB : '.$checked.' : '.$tableaucheck[$checked].'<br>';
                                        $valide=1;
                                        $checked++;
                                        $tableauVerif[$valeurPourVerifierSiDiplomeOKEtEquiOk] = $prerequis;
                                        $i = $i++;
                                    }


                                      
                                    }

                            }
    





                            // RECUPERATION DES LIAISONS LIEE AU PREREQUIS UTIL
                            $numPrerequis=$tab[$p];
                            $req70 = $bdd->query("SELECT liaison_id_prerequis
                            FROM Equivalence WHERE id_prerequis LIKE '$numPrerequis'");
                            $colonnes = $req70->fetchAll();
                            $boucle=0;
                            foreach($colonnes as $colonne) {
                    
                                $tabequivalence[$boucle]= $colonne['liaison_id_prerequis'];
                                 /**/ echo '<br/>Tab1['.$boucle.']='.$tabequivalence[$boucle].'<br/>';
                                $boucle=$boucle+1;
                            }
                            /*for ($bouclefor=0;$bouclefor<$boucle;$bouclefor++){
                                if ($tabequivalence[$bouclefor]==$tabnum[$k]){
                                    $tableaucheck[$checked]=1;
                                    $checked++;
                                   echo '<br>YES<br>';
                                }
                            }*/
                            for ($bouclefor=0;$bouclefor<3;$bouclefor++){
                              echo '<br>$tabequivalence[$bouclefor]: '.$tabequivalence[$bouclefor];
                              echo '<br> $tabnum[$k] : '.$tabnum[$k];
                              if ($tabequivalence[$bouclefor]==$tabnum[$k]){
                                  echo '<br>-------<br>';
                                for ($zzz=0;$zzz<20;$zzz++){
                                  echo '<br> TABLEAU '.$tableauVerif[$zzz];
                                  if($tabequivalence[$bouclefor]==$tableauVerif[$zzz]){
                                    echo '<br>EQUIVALENCE DEJA VERIFIER POUR LE PREREQUIS';
                                    $oups=1;
                                    $zzz=22;

                                  }elseif($tabequivalence[$bouclefor]!=$tableauVerif[$k]){
                                      $oups = 0;
 
                                  }
                                }
                                if($oups==0){
                                  echo '<br>YES2';
                                
                                  $date1 = $tabdate[$p];
                                  $diff  = abs($now - $date1);
                                  echo '<br>DIFFERENCE : '.$diff; 
                                  echo '<br>DATE : '.$date1; 
                                  $prerequis=$tab[$p];
                                  echo '<br>CHEKED = '.$checked;
                                  $TESTOK = verifRecyclageV2($diff,$testRecyclage,$prerequis);
                                  $VALIDITECHECK = verifValidite5($diff, $testValidite5,$prerequis);
                                  $VALIDITECHECK4 = verifValidite4($diff, $testValidite4,$prerequis);  
                                  if($TESTOK=='RECYCLAGE'){
                                      $RECYCLAGE='OUI';
                                      echo 'RECYKLAGE';
                                      echo '<br>CHEKED = '.$checked;
                                      $tableaucheck[$checked]=0;
                                      echo '<br>TAB : '.$checked.' : '.$tableaucheck[$checked].'<br>';
                                           $checked++;
                                     }elseif ($TESTOK=='N/R'){

                                      if($VALIDITECHECK=='NONVALIDE' || $VALIDITECHECK4=='NONVALIDE'){
                                        $KALAMOUR="NONVALIDE";
                                        echo '<b><br>'.$KALAMOUR.'</b>';
                                        echo '<br>CHEKED = '.$checked;
                                        $tableaucheck[$checked]=0;
                                        echo '<br>TAB : '.$checked.' : '.$tableaucheck[$checked].'<br>';
                                             $checked++;
                                        }else{
                                        echo $KALAMOUR="VALIDE";
                                        echo '<br>CHEKED = '.$checked;
                                        $tableaucheck[$checked]=1;
                                        echo '<br>TAB : '.$checked.' : '.$tableaucheck[$checked].'<br>';
                                        $valide=1;
                                        $checked++;
                                        $tableauVerif[$valeurPourVerifierSiDiplomeOKEtEquiOk] = $prerequis;
                                        $i = $i++;
                                    }


                                      
                                    }
                                }
                                

                              }else {/*CCCCCC*/
                                  $test2=$tabequivalence[$bouclefor];
                                  $req78 = $bdd->query("SELECT liaison_id_prerequis
                                  FROM Equivalence WHERE id_prerequis LIKE '$test2'");
                                  $rows = $req78->fetchAll();
                                  $boucle2=0;
                                 echo '<br> Equivalence: '.$bouclefor.' = '.$test2.'<br>';
                                  foreach($rows as $row) {
                    
                                    $equivalence[$boucle2]= $row['liaison_id_prerequis'];
                                     /**/ echo '<br/>Tab2['.$boucle2.']='.$equivalence[$boucle2].'<br/>';
                                    $boucle2=$boucle2+1;
                                  }
                                  for ($bouclefor2=0;$bouclefor2<3;$bouclefor2++){
                                    echo '<br>$equivalence[$bouclefor2] = '.$equivalence[$bouclefor2];
                                    echo '<br>$tabnum[$k] = '.$tabnum[$k];



                                    if ($equivalence[$bouclefor2]==$tabnum[$k]){
                                     
                                            for ($zzz=0;$zzz<20;$zzz++){
  
                                              if($tabequivalence[$bouclefor]==$tableaucheck[$zzz]){
                                                echo '<br>EQUIVALENCE DEJA VERIFIER POUR LE PREREQUIS';
                                                $oups=1;
                                                $k=22;
  
                                              }elseif($tabequivalence[$bouclefor]!=$tableaucheck[$zzz]){
                                            $RECYCLAGE='NON';
                                            $oups = 0;
                                              }
                                            }
                                            if($oups==0){
                                              echo '<br>YES3';
                                            
                                              $date1 = $tabdate[$p];
                                              $diff  = abs($now - $date1);
                                              echo '<br>DIFFERENCE : '.$diff; 
                                              echo '<br>DATE : '.$date1; 
                                              $prerequis=$tab[$p];
                                              echo '<br>CHEKED = '.$checked;
                                              $TESTOK = verifRecyclageV2($diff,$testRecyclage,$prerequis);
                                              $VALIDITECHECK = verifValidite5($diff, $testValidite5,$prerequis);
                                              $VALIDITECHECK4 = verifValidite4($diff, $testValidite4,$prerequis);              
                                              if($TESTOK=='RECYCLAGE'){
                                                  $RECYCLAGE='OUI';
                                                  echo 'RECYKLAGE';
                                                  echo '<br>CHEKED = '.$checked;
                                                  $tableaucheck[$checked]=0;
                                                  echo '<br>TAB : '.$checked.' : '.$tableaucheck[$checked].'<br>';
                                                       $checked++;
                                                 }elseif ($TESTOK=='N/R'){

                                                  if($VALIDITECHECK=='NONVALIDE' || $VALIDITECHECK4=='NONVALIDE'){
                                                    $KALAMOUR="NONVALIDE";
                                                    echo '<b><br>'.$KALAMOUR.'</b>';
                                                    echo '<br>CHEKED = '.$checked;
                                                    $tableaucheck[$checked]=0;
                                                    echo '<br>TAB : '.$checked.' : '.$tableaucheck[$checked].'<br>';
                                                         $checked++;
                                                    }else{
                                                    echo $KALAMOUR="VALIDE";
                                                    echo '<br>CHEKED = '.$checked;
                                                    $tableaucheck[$checked]=1;
                                                    echo '<br>TAB : '.$checked.' : '.$tableaucheck[$checked].'<br>';
                                                    $valide=1;
                                                    $checked++;
                                                    $tableauVerif[$valeurPourVerifierSiDiplomeOKEtEquiOk] = $prerequis;
                                                    $i = $i++;
                                                }
            
            
                                                  
                                                }
                                            }
                                                  
  
                                      }elseif($equivalence[$bouclefor2]!=$tabnum[$k]) {
                                      echo '<br>NOP';
                                    }
                                  }


                              }
                              
                          }

                        }
                        for($i=0;$i<40;$i++){
                          unset($equivalence[$i]);
                          unset($tabequivalence[$i]);
                          
                      }

                    }
                    if($valide!=1) {
                      echo '<br><b>NON VALIDE</b>';
                      $tableaucheck[$checked]=0;
                      $checked++;  
    
                    }


                }
                
                for ($test=0;$test<10;$test++){
                    echo '['.$test.']'.$tableaucheck[$test].'<br>';
 
                }
                $boucleexit=true;
                $boucleverif = 3;
                $verifI=1;
                for( $i = 0; $i < $count180RESULT; $i++ )
                {
                  if ($tableaucheck[$i]!=$verifI){
                    $isEqual = 'false2';
                    $boucleverif=0;
                    $i = 100;
                  }elseif ($tableaucheck[$i]==$verifI){
                    /**/ $isEqual = 'true2';  // VERIF
                    $boucleverif=1;
                  }
                }
  
               echo '<br> BOUCLE VERIF '.$boucleverif;

               if($boucleverif==1){
                            $regiment=$donnees19['regiment'];
                            $reqVerifReg = $bdd->query("SELECT *
                            FROM regiments WHERE ID_FK LIKE '$regiment'");
                            $donneesVerifReg = $reqVerifReg->fetch();

                            
                            
                            ?> 
                            <tr>

                            <td> <b><?php echo $donnees19['nom']?></b></td>
                            <td> <b> <?php echo $donnees19['prenom']?></b></td>
                            <?if($donnees19['sap']!=0){?><td> <b> <?php echo $donnees19['sap']?></b></td><?}elseif($donnees19['sap']==0){?><td> <b> <?php echo $donnees19['numalliance']?></b></td><?}?>
                            <td> <?php echo $donnees19['Grade']?></td>
                            <td> <?php echo $donneesVerifReg['NomRegiment']?></td>
                            <td> <?php echo '</h5><span class="badge bg-success">Oui</span></h5>'?></td>
                           </tr>    
        
                         <?php 
            }





   

                for($i=1;$i<$count180RESULT;$i++){
                    unset($tableaucheck[$i]);
                    
                }
                for($i=0;$i<40;$i++){
                    unset($tab[$i]);
                    unset($equivalence[$i]);
                    unset($tabequivalence[$i]);
                    
                }
                
                $utilisateurnum ++;     
                $tableaucheck[ 0 ]=NULL;   
 }
 echo $donnees19['prenom'].' : OK ';
}?>                </tbody>
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


<?
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