<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
$sap = $_POST['sap'];
$req = $bdd->query("SELECT *
FROM utils WHERE sap LIKE '$sap'");
$donnees = $req->fetch();
$id_userSAP = $donnees['id'];
$nom = $donnees['nom'];
$prenom = $donnees['prenom'];
$type = $donnees['type'];

if ($type == 1){

    $typeverif='Millitaire';
}elseif($type == 0){
    $typeverif="Civil";
}else{
    $typeverif="Error";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" href="MiseEnPage.css" />
        <link href="../administration/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

		<title>OCMF - Gestion des pré-requis</title>

	</head>
	
	<header>
<nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo_img"><img src="bg1.png" style="  margin-left : 2px!important;
  width: 40px!important;
  margin-top:10px!important;
  margin-bottom: -10px!important;
  height: 65px!important;"></label>
      <label class="logo">OCMF</label>
      <label class="logo_img"><img src="logoADT.png" style="  margin-left : 1050px!important;
  width: 70px!important;
  padding: initial!important;
  margin-top:10px!important;
  height: 55px!important;"></label>
      <ul>
      <li><a href="index.php">DashBoard</a></li>
      <li><a class="active" href="personnel.php">Recherche</a></li>
    	<li><a href="notice.php">Notice d'utilisation</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li style="float:right!important"><a href="../administration/index.php">Administration</a></li>
        <li style="float:right!important"><a href="../php/logout.php?logout_id= <?php echo $_SESSION['unique_id'];?>">Deconnexion</a></li>
  	</ul>
    </nav>
<br>
	</header>
	<body>
    <script>


        </script>
    <div class="wrapper">
    <section class="form login">
    <img class="image" src="ministere.png" style="  border: none;
  width: 40%;
  margin-left:160px;
  text-align: center;
  height: 34%;">
        <?php if(empty($nom)){?>
        <header>DOA | Recherche d'un personnel </header>
		<form method="post">
        
        <div class="field input">
        Entrée le SAP : <input type="text" placeholder="SAP du candidat" name="sap" required/><br>
        </div>
        <div class="field button">
        <input type="submit" value="Rechercher" onclick="document.getElementById('demo').innerHTML = msg"/>
        </div>
        </form>
         <?} elseif(!empty($nom)){?>
            <header>DOA | Information sur Personnel</header>
		<form method="post">
        <div class="field input">
        <p><b>Nom :</b> <?php echo $nom?> </p>
        </div>
        <div class="field input">
        <p><b>Prénom :</b> <?php echo $prenom?> </p>
        </div>
        <div class="field input">
        <p><b>Fonction :</b> <?php echo $typeverif?> </p>
        </div>
        <hr>
        <div class="field input">
        <p><b>Diplomes :</b><br> <?php 
$req2 = $bdd->query("SELECT *
FROM `formationliaison`
INNER JOIN Formation
ON formationliaison.Num_Prerequis = Formation.NumPrérequis WHERE id_user LIKE '$id_userSAP'");
     $k=1;
 while ($donnees2 = $req2->fetch()){
     echo '(#'.$k.') - '.$donnees2['Nom_Prerequis'];
     echo '<br>';
     $k=$k+1;
}
        ?></p>
        </div>
        <div class="field button">
        <input href="personnel.php" type="submit" value="Retour"/>
        </div>
            <?} ?>
    </section>
        </div>
        <hr>
 }
<?php 



?>