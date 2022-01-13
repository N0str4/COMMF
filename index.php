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


$req3 = $bdd->query("SELECT *
FROM formationliaison
INNER JOIN utils ON formationliaison.id = utils.id WHERE Num_Prerequis LIKE '$coucou'");

$req4 = $bdd->query("SELECT *
FROM utils WHERE sap LIKE '$sap'");
$donnees4 = $req4->fetch();
$id_userSAP = $donnees4['id'];
$req5 = $bdd->query("SELECT Num_Prerequis
FROM formationliaison WHERE id_user LIKE '$id_userSAP'");
$rows= $req5->fetchAll(PDO::FETCH_ASSOC);
/*var_dump($rows);*/
$i=0;

foreach($rows as $row) {

    echo '<br />';
    echo 'i='.$i;
    echo '<br />';

    $tab[$i] = $row['Num_Prerequis'];

    echo 'Tab['.$i.']='.$tab[$i];
    echo '<br/>';
    $i=$i+1;
    echo 'i='.$i;
    echo '<br />';
    


}
echo '<br/>';
echo 'Après la boucle vérif des valeurs : <br/>';
echo 'Tab[2]='.$tab[2].'<br/>';
echo 'Tab[1]='.$tab[1].'<br/>';
echo 'Tab[0]='.$tab[0].'<br/>';

?>   
<table>
<thead>
<tr>
    <th>Nom</th>
    <th>NomFormation</th>
    <th>Prérequis</th>
    <th>Prérequis Validé ?</th>
    <th>NumPrérequis</th>
</tr>
</thead>
<tbody>
    <?php $k=0;$verif=1;?>
<?php while ($donnees = $req2->fetch()){?>
<?php
$verif=1;
    for ($k=0; $k<10; $k++){
        echo '<br/>';
        echo 'TAB K egal : '.$tab[$k].'///';
        $numverif = $donnees['num_prerequis'];
        $test=$tab[$k];
        echo $numverif;
        if ($test== $numverif){
            $KALAMOUR = 'VALIDE';
            echo 'VALIDE';
         } 
    }    
    if(is_null($donnees4['nom'])==false){?>     
    
                <br/>
                <br/>
                <tr><th> <?php echo $donnees4['nom']?></th><th> <?php echo $donnees['nomformation']?></th><th> <?php echo $donnees['Nom_Prerequis']?></th><?php if ($KALAMOUR=='VALIDE'){?> <th class="val"><?php echo $KALAMOUR; }else {?> <th class="nv"><?php echo 'NONVALIDE';}?></th><th> <?php echo $donnees['num_prerequis']?></th></tr>
    
        <?php }else{?> 
            <script type="text/javascript">
                alert('SAP INVALIDE !');
                window.location.replace("http://intradef.vikatchev.com");
            </script>
            
        <?php }?> 
<?php $KALAMOUR = 'NONVALIDE'; }?>   
</table></tbody>
	</body>

</html>
