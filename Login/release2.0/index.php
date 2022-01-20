<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" href="MiseEnPage.css" />
		<title>OCMF - Gestion des pré-requis</title>

	</head>
	
	<header>
<nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo_img"><img src="bg1.png" style="  margin-left : 2px;
  width: 40px;
  margin-top:10px;
  margin-bottom: -10px;
  height: 65px;"></label>
      <label class="logo">OCMF</label>
      <label class="logo_img"><img src="logoADT.png" style="  margin-left : 1050px;
  width: 70px;
  padding: initial;
  margin-top:10px;
  height: 55px;"></label>
      <ul>
      <li><a class="active" href="index.php">DashBoard</a></li>
    	<li><a href="notice.php">Notice d'utilisation</a></li>
        <li style="float:right"><a href="../administration/index.php">Administration</a></li>
        <li style="float:right"><a href="../php/logout.php?logout_id= <?php echo $_SESSION['unique_id'];?>">Deconnexion</a></li>
  	</ul>
    </nav>
<br>
	</header>
	<body>
        
    <div class="wrapper">
    <section class="form login">
    <img class="image" src="ministere.png" style="  border: none;
  width: 40%;
  margin-left:160px;
  text-align: center;
  height: 34%;">
        <header>DOA | Visualisation des Pré-Requis </header>
		<form method="post">
            
        <div class="field input">
        Entrée le SAP : <input type="text" placeholder="SAP du candidat" name="sap" required/><br>
        </div>
        <div class="field input">
        Selectionner la Formation : <select name="formation" id="pet-select" required>
<?php
        $req190 = $bdd->query("SELECT * FROM `Formationdetails`  GROUP BY `nomformation`");
                      while ($donnees190 = $req190->fetch()){?>
                      
                        <option value="<?php echo $donnees190['nomformation'];?>"><?php echo $donnees190['nomformation'] ?></option>
                        
                      <?php
                      }?>

        </select><br>
        </div>
        <div class="field button">
        <input type="submit" value="Rechercher"/>
        </div>
        </form>
    </section>
        </div>
        <hr>
        <?php 

// SCRIPT PHP BY
// BY AYMERICK 
// DO NOT COPY



$sap = $_POST['sap'];
$formation = $_POST['formation'];
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

  












$req5 = $bdd->query("SELECT Num_Prerequis,dateobtention
FROM formationliaison WHERE id_user LIKE '$id_userSAP'");
$rows= $req5->fetchAll(PDO::FETCH_ASSOC);
/*var_dump($rows);*/
$i=0;

foreach($rows as $row) {
    /* DEBUG MODE */
    /**/ echo '<br />';
    /**/ echo 'i='.$i;
    /**/ echo '<br />';
    /* END DEBUG MODE */
    $tabdate[$i] = $row['dateobtention'];
    $tab[$i] = $row['Num_Prerequis'];
    /* DEBUG MODE */
    /**/ echo 'Tab['.$i.']='.$tab[$i];
    /**/ echo '<br/>';
    /* END DEBUG MODE */
    $i=$i+1;
    /* DEBUG MODE */
    /**/ echo 'i='.$i;
    /**/ echo '<br />';
    
    /* END DEBUG MODE */

}

$req18 = $bdd->query("SELECT num_prerequis
FROM Formationdetails WHERE nomformation LIKE '$formation'");
$sorties = $req18->fetchAll();


$n=0;
foreach($sorties as $sortie) {
    $tabnum[$n] = $sortie['num_prerequis'];
    echo '<br> Résult : '.$sortie['num_prerequis'].'<br>';
    if ($tabnum[$n]==29){ // Formation Civ
        $VerifCivOrMil = 0;
        echo $VerifCivOrMil;
    }elseif($tabnum[$n]==28){ // Formation Millitaire
        $VerifCivOrMil = 1;
        echo $VerifCivOrMil;
    } else {
        $VerifCivOrMil = 3; // Formation ouverte au deux
        echo '<br> VERIF /./ '.$VerifCivOrMil.'<br>';
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


if(is_null($donnees4['nom'])==false){
    
    
    
    
    
    
    
    ?>
<table>
<thead>
<tr>
    <th id="rouge">Nom du Candidat</th>
    <th>Nom de la Formation</th>
    <th>Nom du Pré-Requis</th>
    <th>Validité du Pré-requis</th>
    <th>Recyclage Requis</th>
</tr>
</thead>
<tbody>
<?php }?>
    <?php $k=0;?>
<?php while ($donnees = $req2->fetch()){?>
<?php
$now = date('Y-m-d H:i:s');
    for ($k=0; $k<10; $k++){
        $boucle = 0;
        /* DEBUG MODE */
        /**/ echo '<br/>K= '.$k.'<br/>';
        /**/ echo 'TAB K egal : '.$tab[$k].'///';
        /* END DEBUG MODE */
        $numverif = $donnees['num_prerequis'];
        $test=$tab[$k];
        /**/echo $numverif.'<br.>';
        $req7 = $bdd->query("SELECT liaison_id_prerequis
        FROM Equivalence WHERE id_prerequis LIKE '$test'");
        $colonnes = $req7->fetchAll();
        foreach($colonnes as $colonne) {

            $tabequivalence[$boucle]= $colonne['liaison_id_prerequis'];
            /**/ echo '<br/>Tab['.$boucle.']='.$tabequivalence[$boucle].'<br/>';
            $boucle=$boucle+1;
        }
        /**/ echo '<br/>---<br/>';
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
            /**/ echo '<div class="bold"> <br/>| !!!!!      DEBUG MODE      !!!!! | </div><br/>';
            /**/ echo ' | (FORMATION) =  |  '.$donnees['Nom_Prerequis'];
            /**/ echo '<br/> | (ETATVALIDE)<br/>';
            /* END DEBUG MODE */

            $req6 = $bdd->query("SELECT dateobtention
            FROM formationliaison WHERE Num_Prerequis LIKE '$test'");
            $donnees18 = $req6->fetch();
            $date1 = $donnees18['dateobtention'];    
            $diff  = abs($now - $date1);  
            
            /* DEBUG MODE */
            /**/ echo ' | (Numéro du Prérequis =  |  '.$test.'  |)<br/>';
            /**/ echo ' | (DATE Aujourd hui =  |  '.$now.'  |)<br/>';
            /**/ echo ' | (DATE Obtention =  |  '.$date1.'  |)<br/>';
            /**/ echo ' | (Difference de date entre obtention et aujourdhui =  |  '.$diff.'  |)<br/>';
            /* END DEBUG MODE */
            $TESTOK = verifRecyclage($diff,$test,$donnees);
            if($TESTOK=='RECYCLAGE'){
                $RECYCLAGE='OUI';
                $KALAMOUR="VALIDE";
            }
            elseif($TESTOK=='VALIDE'){
                $RECYCLAGE='NON';
                $KALAMOUR="VALIDE";
            }elseif($TESTOK=='NONVALIDE'){
                $RECYCLAGE='NON';
                $KALAMOUR="NONVALIDE";
            }
         } 
    }    
    if(is_null($donnees4['nom'])==false){   
    if ($VerifCivOrMil==1 && $type_user==1){
                ?> 
                <br/>
                <br/>
                <tr><th> <?php echo $donnees4['nom']?></th><th> <?php echo $donnees['nomformation']?></th><th> <?php echo $donnees['Nom_Prerequis']?></th><?php if ($KALAMOUR=='VALIDE'){?> <th class="val"><?php echo $KALAMOUR; }else {?> <th class="nv"><?php echo 'NONVALIDE';}?></th><?php if ($RECYCLAGE=='OUI'){?> <th class="okrecy"><?php echo $RECYCLAGE; }else {?> <th class="nonrecy"><?php echo 'NON';}?></th></tr>
    
        <?php }
        if ($VerifCivOrMil==1 && $type_user==0){
                ?> 
                <br/>
                <br/>        <?php }
        if ($VerifCivOrMil==0 && $type_user==0){
                ?> 
                <br/>
                <br/>
                <tr><th> <?php echo $donnees4['nom']?></th><th> <?php echo $donnees['nomformation']?></th><th> <?php echo $donnees['Nom_Prerequis']?></th><?php if ($KALAMOUR=='VALIDE'){?> <th class="val"><?php echo $KALAMOUR; }else {?> <th class="nv"><?php echo 'NONVALIDE';}?></th><?php if ($RECYCLAGE=='OUI'){?> <th class="okrecy"><?php echo $RECYCLAGE; }else {?> <th class="nonrecy"><?php echo 'NON';}?></th></tr>
    
        <?php }if ($VerifCivOrMil==0 && $type_user==1){
                ?> 
                <br/>
                <br/>
                        <?php }
        if ($VerifCivOrMil==3){
                ?> 
                <br/>
                <br/>
                <tr><th> <?php echo $donnees4['nom']?></th><th> <?php echo $donnees['nomformation']?></th><th> <?php echo $donnees['Nom_Prerequis']?></th><?php if ($KALAMOUR=='VALIDE'){?> <th class="val"><?php echo $KALAMOUR; }else {?> <th class="nv"><?php echo 'NONVALIDE';}?></th><?php if ($RECYCLAGE=='OUI'){?> <th class="okrecy"><?php echo $RECYCLAGE; }else {?> <th class="nonrecy"><?php echo 'NON';}?></th></tr>
                
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
        for ($k=0; $k<10; $k++){
            $boucle = 0;
            /* DEBUG MODE */
            /**/ echo '<br/>K= '.$k.'<br/>';
            /**/ echo 'TAB K egal : '.$tab[$k].'///';
            /* END DEBUG MODE */
            $numverif = $donnees80['num_prerequis'];
            $test=$tab[$k];
            /**/echo $numverif.'<br.>';
            $req7 = $bdd->query("SELECT liaison_id_prerequis
            FROM Equivalence WHERE id_prerequis LIKE '$test'");
            $colonnes = $req7->fetchAll();
            foreach($colonnes as $colonne) {
    
                $tabequivalence[$boucle]= $colonne['liaison_id_prerequis'];
                /**/ echo '<br/>Tab['.$boucle.']='.$tabequivalence[$boucle].'<br/>';
                $boucle=$boucle+1;
            }
            /**/ echo '<br/>---<br/>';
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
                /**/ echo '<div class="bold"> <br/>| !!!!!      DEBUG MODE      !!!!! | </div><br/>';
                /**/ echo ' | (FORMATION) =  |  '.$donnees80['Nom_Prerequis'];
                /**/ echo '<br/> | (ETATVALIDE)<br/>';
                /* END DEBUG MODE */
    
                $req6 = $bdd->query("SELECT dateobtention
                FROM formationliaison WHERE Num_Prerequis LIKE '$test'");
                $donnees18 = $req6->fetch();
                $date1 = $donnees18['dateobtention'];    
                $diff  = abs($now - $date1);  
                
                /* DEBUG MODE */
                /**/ echo ' | (Numéro du Prérequis =  |  '.$test.'  |)<br/>';
                /**/ echo ' | (DATE Aujourd hui =  |  '.$now.'  |)<br/>';
                /**/ echo ' | (DATE Obtention =  |  '.$date1.'  |)<br/>';
                /**/ echo ' | (Difference de date entre obtention et aujourdhui =  |  '.$diff.'  |)<br/>';
                /* END DEBUG MODE */
                $TESTOK = verifRecyclage($diff,$test,$donnees80);
                if($TESTOK=='RECYCLAGE'){
                    $RECYCLAGE='OUI';
                    $KALAMOUR="VALIDE";
                }
                elseif($TESTOK=='VALIDE'){
                    $RECYCLAGE='NON';
                    $KALAMOUR="VALIDE";
                }elseif($TESTOK=='NONVALIDE'){
                    $RECYCLAGE='NON';
                    $KALAMOUR="NONVALIDE";
                }
             } 
        }    
        if(is_null($donnees4['nom'])==false){   
            if ($VerifCivOrMil==3){
                    ?> 
                    <br/>
                    <br/>
                    <tr><th> <?php echo $donnees4['nom']?></th><th> <?php echo $donnees80['nomformation']?></th><th> <?php echo $donnees80['Nom_Prerequis']?></th><?php if ($KALAMOUR=='VALIDE'){?> <th class="val"><?php echo $KALAMOUR; }else {?> <th class="nv"><?php echo 'NONVALIDE';}?></th><?php if ($RECYCLAGE=='OUI'){?> <th class="okrecy"><?php echo $RECYCLAGE; }else {?> <th class="nonrecy"><?php echo 'NON';}?></th></tr>
                    
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
</table></tbody>
	</body>


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
    echo 'FINI';
}   
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
?>

</html>


<?php
  












function verifRecyclage($diff,$test,$donnees){
    if (($diff>5 and $test==12) or ($diff>5 and $test==13) or ($diff>5 and $test==14) or ($diff>5 and $test==15)) {    
        return $TEST = 'RECYCLAGE';
        /* DEBUG MODE */
        echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' NECESSITE UN RECYCLAGE TOUT LES 5 ANS)<br/>';
        echo ' | (RECYCLAGE NECCESSAIRE :'.$RECYCLAGE.')<br/>';
        /* END DEBUG MODE */

    } elseif ($diff>5 and $test==16){  
        /* DEBUG MODE */
        echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' A UNE VALIDITE DE 5 ANS)<br/>';
        echo ' | (RECYCLAGE : NON<br/>';
        echo ' | (VALIDITER : <k>REVOQUER</k><br/><br/>';
        return $TEST = 'NONVALIDE';
        /* END DEBUG MODE */
        
    } elseif ($diff>4 and $test==17){  
        /* DEBUG MODE */
        echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' A UNE VALIDITE DE 4 ANS)<br/>';
        echo ' | (RECYCLAGE : NON<br/>';
        echo ' | (VALIDITER : <k> REVOQUER</k><br/><br/>';
        return $TEST = 'NONVALIDE';
        /* END DEBUG MODE */
        
    }
    elseif ($diff>5 and $test!=12 || $test=!13 || $test=!14 || $test=!15){  
        /* DEBUG MODE */
        echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' NE NECESSITE PAS DE RECYCLAGE)<br/>';
        echo ' | (RECYCLAGE : NON<br/><br/>';
        return $TEST = 'VALIDE';
        /* END DEBUG MODE */
        
    }
    else {  
        /* DEBUG MODE */
        echo ' | (RECYCLAGE : NON<br/><br/>';
        return $TEST = 'VALIDE';
        /* END DEBUG MODE */   
    } 
}
function verificationEquivalenceOui($test, $tabequivalence,$bouclefor){
    $KALAMOUR = 'VALIDE';
    echo '<br/> Formation équivalente ! Diplome de base :  '.$test.'<br/>';
    echo 'Diplome equivalent : '.$tabequivalence[$bouclefor].'<br/>';
    return $KALAMOUR;
}