<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" href="MiseEnPage.css" />
		<title>Gestion des pré-requis</title>

	</head>
	
	<header>
		<?php include("header.php"); ?>
	</header>
	<body>
        <formulaire>
		<form method="post">
        Entrée le SAP : <input type="text" name="sap" required/>
        <br>
        <select name="formation" id="pet-select" required>
            <option value="">Selectionnez une formation</option>
            <option value="PPLD">PPLD</option>
            <option value="PPLOG">PPLOG</option>
            <option value="HK">HK</option>
            <option value="FS">Force Spécial</option>
            <option value="OKL">OKL</option>
            <option value="JDLOP">JDLOP</option>
        </select>
        <input type="submit" value="Rechercher"/>
        </form>
        </formulaire> 
        <?php 

// SCRIPT PHP BY
// BY AYMERICK 
// DO NOT COPY
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
$sap = $_POST['sap'];
$formation = $_POST['formation'];



// CHECK
$req = $bdd->query("SELECT * FROM `Formationdetails` WHERE nomformation LIKE '$formation' ORDER BY num_prerequis");
$req2 = $bdd->query("SELECT *
FROM `Formationdetails`
INNER JOIN Formation
ON Formationdetails.num_prerequis = Formation.NumPrérequis WHERE nomformation LIKE '$formation'");


/*$req3 = $bdd->query("SELECT *
FROM formationliaison
INNER JOIN utils ON formationliaison.id = utils.id WHERE Num_Prerequis LIKE '$coucou'")*/

$req4 = $bdd->query("SELECT *
FROM utils WHERE sap LIKE '$sap'");
$donnees4 = $req4->fetch();
$id_userSAP = $donnees4['id'];
$req5 = $bdd->query("SELECT Num_Prerequis,dateobtention
FROM formationliaison WHERE id_user LIKE '$id_userSAP'");
$rows= $req5->fetchAll(PDO::FETCH_ASSOC);
/*var_dump($rows);*/
$i=0;

foreach($rows as $row) {
    /* DEBUG MODE */
    echo '<br />';
    echo 'i='.$i;
    echo '<br />';
    /* END DEBUG MODE */
    $tabdate[$i] = $row['dateobtention'];
    $tab[$i] = $row['Num_Prerequis'];
    /* DEBUG MODE */
    echo 'Tab['.$i.']='.$tab[$i];
    echo 'Date['.$i.']='.$tabdate[$i];
    echo '<br/>';
    /* END DEBUG MODE */
    $i=$i+1;
    /* DEBUG MODE */
    echo 'i='.$i;
    echo '<br />';
    /* END DEBUG MODE */
    


}
?>   
<table>
<thead>
<tr>
    <th>Nom du Candidat</th>
    <th>Nom de la Formation</th>
    <th>Nom du Pré-Requis</th>
    <th>Validité du Pré-requis</th>
    <th>Recyclage Requis</th>
</tr>
</thead>
<tbody>
    <?php $k=0;?>
<?php while ($donnees = $req2->fetch()){?>
<?php
$now = date('Y-m-d H:i:s');
    for ($k=0; $k<10; $k++){
        /* DEBUG MODE */
        echo '<br/>';
        echo 'TAB K egal : '.$tab[$k].'///';
        /* END DEBUG MODE */
        $numverif = $donnees['num_prerequis'];
        $test=$tab[$k];
        echo $numverif;
        $diff = 0;
        if ($test== $numverif){
            $KALAMOUR = 'VALIDE';
            /* DEBUG MODE */
            echo '<br/> <br/>| !!!!!      DEBUG MODE      !!!!! | <br/>';
            echo ' | (ETATVALIDE)<br/>';
            /* END DEBUG MODE */
            $req6 = $bdd->query("SELECT dateobtention
            FROM formationliaison WHERE Num_Prerequis LIKE '$test'");
            $donnees18 = $req6->fetch();
            $date1 = $donnees18['dateobtention'];    
            $diff  = abs($now - $date1);  
            
            /* DEBUG MODE */
            echo ' | (DATE NOW='.$now.')<br/>';
            echo ' | (Numéro du Prérequis '.$test.')<br/>';
            echo ' | (DATE DB ='.$date1.')<br/>';
            echo ' | (Difference de date entre la BD et Mtn='.$diff.')<br/>';
            /* END DEBUG MODE */
            if (($diff>5 and $test==12) or ($diff>5 and $test==13) or ($diff>5 and $test==14) or ($diff>5 and $test==15)) {    
                $RECYCLAGE = 'OUI';
                /* DEBUG MODE */
                echo 'CC';
                echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' NECCESSITE UN RECYCLAGE TOUT LES 5 ANS)<br/>';
                echo ' | (RECYCLAGE NECCESSAIRE :'.$RECYCLAGE.')<br/>';
                /* END DEBUG MODE */

            } elseif ($diff>5 and $test!=12 || $test=!13 || $test=!14 || $test=!15){  
                /* DEBUG MODE */
                echo ' | (INFORMATION : CETTE FORMATION '.$donnees['Nom_Prerequis'].' NE NECCESSITE PAS DE RECYCLAGE)<br/>';
                echo ' | (RECYCLAGE : NON<br/><br/>';
                /* END DEBUG MODE */
                
            }else {  
                /* DEBUG MODE */
                echo ' | (RECYCLAGE : NON<br/><br/>';
                /* END DEBUG MODE */   
            } 
         } 
    }    
    if(is_null($donnees4['nom'])==false){?>     
    
                <br/>
                <br/>
                <tr><th> <?php echo $donnees4['nom']?></th><th> <?php echo $donnees['nomformation']?></th><th> <?php echo $donnees['Nom_Prerequis']?></th><?php if ($KALAMOUR=='VALIDE'){?> <th class="val"><?php echo $KALAMOUR; }else {?> <th class="nv"><?php echo 'NONVALIDE';}?></th><?php if ($RECYCLAGE=='OUI'){?> <th class="okrecy"><?php echo $RECYCLAGE; }else {?> <th class="nonrecy"><?php echo 'NON';}?></th></tr>
    
        <?php }else{?> 
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

</html>
