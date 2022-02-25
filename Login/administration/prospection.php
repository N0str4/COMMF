<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');


include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();
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
while ($donnees19 = $req19->fetch()){
    $id_userSAP = $donnees19['id'];
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
                        $tab[$i] = $row['Num_Prerequis'];
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
              //  echo '<br>UTILISATION : '.$utilisateurnum;
              //  echo '<br>'.$count180['total'];
                $checked=0;
                for ($k=0;$k<20;$k++){// FORMA
                    for($p=0;$p<20;$p++){// UTIL
                        
                    ///    echo '<br>PREREQUIS FORMA'.$tabnum[$k];
                    ///    echo '<br> PREREQUIS UTIL'.$tab[$p];
                        if($tabnum[$k]!=NULL){// SI PLUS DE PREREQUIS DE FORMA A CHECK
                            if($tabnum[$k]==$tab[$p]){
                                $tableaucheck[$checked]=1;
                                $checked++;
                               // echo '<br>YES<br>';

                            }
                            // RECUPERATION DES LIAISONS LIEE AU PREREQUIS UTIL
                            $numPrerequis=$tab[$p];
                            $req70 = $bdd->query("SELECT liaison_id_prerequis
                            FROM Equivalence WHERE id_prerequis LIKE '$numPrerequis'");
                            $colonnes = $req70->fetchAll();
                            $boucle=0;
                            foreach($colonnes as $colonne) {
                    
                                $tabequivalence[$boucle]= $colonne['liaison_id_prerequis'];
                                 ///**/ echo '<br/>Tab['.$boucle.']='.$tabequivalence[$boucle].'<br/>';
                                $boucle=$boucle+1;
                            }
                            /*for ($bouclefor=0;$bouclefor<$boucle;$bouclefor++){
                                if ($tabequivalence[$bouclefor]==$tabnum[$k]){
                                    $tableaucheck[$checked]=1;
                                    $checked++;
                                   // echo '<br>YES<br>';
                                }
                            }*/
                            for ($bouclefor=0;$bouclefor<3;$bouclefor++){
                              if ($tabequivalence[$bouclefor]==$tabnum[$k]){
                                $tableaucheck[$checked]=1;
                                $checked++;;
                              }else {/*CCCCCC*/
                                  $test2=$tabequivalence[$bouclefor];
                                  $req78 = $bdd->query("SELECT liaison_id_prerequis
                                  FROM Equivalence WHERE id_prerequis LIKE '$test2'");
                                  $rows = $req78->fetchAll();
                                  $boucle2=0;
                               //   echo $bouclefor.' = '.$test2.'<br>';
                                  foreach($rows as $row) {
                    
                                    $equivalence[$boucle2]= $row['liaison_id_prerequis'];
                                   //  /**/ echo '<br/>Tab['.$boucle2.']='.$equivalence[$boucle2].'<br/>';
                                    $boucle2=$boucle2+1;
                                  }
                                  for ($bouclefor2=0;$bouclefor2<3;$bouclefor2++){
                                    if ($equivalence[$bouclefor2]==$tabnum[$k]){
                                      $tableaucheck[$checked]=1;
                                      $checked++;                                    }
                                  }
                              }
                          }

                        }

                    }

                }
                for ($test=0;$test<$count180RESULT;$test++){
                    //echo '['.$test.']'.$tableaucheck[$test].'<br>';
 
                }
               for( $i = 1; $i < $count180RESULT; $i++ )
                {
                    // Si différent.
                    if($tableaucheck[ 0 ]!=NULL){

                        if($tableaucheck[0] != $tableaucheck[$i] )
                        {
                        // On dit que c'est faux et on sort,
                        // pas besoin de vérifier la suite.
                        $isEqual = 'false2';
                         }elseif($tableaucheck[0] == $tableaucheck[$i] ){
                            $isEqual = 'true2'; 
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
        
                        <?php }
                    }elseif($tableaucheck[ 0 ]==NULL){
                        $isEqual = 'false1';
                    }
                }
                if ($count180RESULT==1){
                    if($tableaucheck[0]==1){
                        $isEqual = 'true4'; 
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
                            <td> <?php echo '<h5><span class="badge bg-success">Oui</span></h5>'?></td>
                           </tr>    
        
                        <?php
                    }elseif($tableaucheck[0]==NULL){
                        $isEqual = 'false4'; 
                    }
                }   

                for($i=1;$i<$count180RESULT;$i++){
                    unset($tableaucheck[$i]);
                }
                for($i=1;$i<40;$i++){
                    unset($tab[$i]);
                    unset($tabnum[$i]);
                }
                //echo $isEqual;
                $utilisateurnum ++;     
                $tableaucheck[ 0 ]=NULL;   
 }
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
