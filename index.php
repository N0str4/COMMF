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
		<form method="post">
        Entrée le SAP : <input type="text" name="sap"/>
        <br>
        Entrée la formation : <input type="text" name="form"/>
        <select name="formation" id="pet-select">
            <option value="">Selectionnez une formation</option>
            <option value="dog">PPLD</option>
            <option value="cat">HK</option>
            <option value="hamster">CAT</option>
            <option value="parrot">PLO</option>
            <option value="spider">OKL</option>
            <option value="goldfish">JDLOP</option>
        </select>
        <input type="submit" value="Rechercher"/>
        </form>
        <?php 
// SCRIPT PHP BY
// BY AYMERICK 
// DO NOT COPY
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
$sap = $_POST['sap'];
$formation = $_POST['form'];



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
$rows= $req5->fetchAll();
$i=0;
foreach($rows as $row) {

    echo '<br />';
    echo 'i='.$i;
    echo '<br />';
    echo 'Valeur de la premiere case='.$$rows[$i];
    $i=$i+1;
    echo 'i='.$i;
    echo '<br />';


}

$req6 = $bdd->query("SELECT COUNT(*) FROM formationliaison WHERE id_user = $id_userSAP"); // PAS FINI
$donnees6 = $req4->fetch();
echo $donnees6;
/*while ($donnees5 = $req5->fetch()){
    
    for ($i; $i< $donnees6; $i++){
    $NumFormation = array(
        i => $donnees5['Num_Prerequis'],
    );
    }   
    var_dump($NumFormation);
*/?>   
<table>
<thead>
<tr>
    <th>NomFormation</th>
    <th>NumPrérequis</th>
    <th>Prérequis Validé ?</th>
</tr>
</thead>
<tbody>
<?php while ($donnees = $req2->fetch()){?>



                <tr><th> <?php echo $donnees['nomformation']?></th><th> <?php echo $donnees['Nom_Prerequis']?></th></tr>

<?php }?>   
</table></tbody>
	</body>

</html>


