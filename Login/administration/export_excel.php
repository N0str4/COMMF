<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
$id = (!empty($_GET['id']))? intval($_GET['id']) : 0;

$filename = "Extraction OCMF Simple Diplome";


	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=$filename.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");
 $conn = mysqli_connect("vikatch505.mysql.db", "vikatch505", "Billitlebg59", "vikatch505");
	
 if(!$conn){
	 die("Error: Failed to connect to database!");
 }





	require_once 'config/config.php';


	$output = "";
	
	$output .="
		<table>
			<thead>
				<tr>
					<th style ='background-color: #0066cc;color: #fff;'>Grade act LA</th>
					<th style ='background-color: #0066cc;color: #fff;'>Nom</th>
					<th style ='background-color: #0066cc;color: #fff;'>Prenom</th>
					<th>
					<th style ='background-color: #0066cc;color: #fff;'>Matricule SAP</th>
					<th style ='background-color: #0066cc;color: #fff;'>Identifiant Defense</th>
					<th style ='background-color: #0066cc;color: #fff;'>Matricule Legion</th>
					<th style ='background-color: #0066cc;color: #fff;'>Numero Alliance</th>
				</tr>
			<tbody>
	";
	$query = $conn->query("SELECT * FROM `utils` WHERE id LIKE '$id'") or die(mysqli_errno());
	while($fetch2 = $query->fetch_array()){

		if($fetch2['sap']!=0){
			$coucou = $fetch2['sap'];
		}elseif($fetch2['sap']==0){
			$coucou ='';

		}
	$output .= "
				<tr>
					<td>".$fetch2['Grade']."</td>
					<td>".$fetch2['nom']."</td>
					<td>".$fetch2['prenom']."</td>
					<td></td>
					<td>".$coucou."</td>
					<td>".$fetch2['matriculedefense']."</td>
					<td>".$fetch2['saplegion']."</td>
					<td>".$fetch2['numalliance']."</td>
				</tr>
	";
	}
	
	$output .="
			</tbody>
			
		</table>
		<br>
		<br>
		<br>	
		<table>
		<thead>
			<tr>
				<th style ='background-color: #0066cc;color: #fff;'>Affectation act L</th>
				<th style ='background-color: #0066cc;color: #fff;'>Affectation act DD</th>
			</tr>
		<tbody>
	";
	$query = $conn->query("SELECT * FROM `utils` WHERE id LIKE '$id'") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
		$regiment= $fetch['regiment'];
		$reqVerifReg = $bdd->query("SELECT *
		FROM regiments WHERE ID_FK LIKE '$regiment'");
		$donneesVerifReg = $reqVerifReg->fetch();
	$output .= "
				<tr>
					<td>".$donneesVerifReg['NomRegiment']."</td>
					<td>".$fetch['affectation']."</td>

				</tr>
	";
	}



	$output .="
	</tbody>
	
			</table>
			<br>
			<br>
			<br>	
			<table>
			<thead>
				<tr>
					<th style ='background-color: #0066cc;color: #fff;'>Diplome L</th>
					<th style ='background-color: #0066cc;color: #fff; '>Date d'obtention</th>
				</tr>
			<tbody>
";

$query = $conn->query("SELECT * FROM `formationliaison` WHERE id_user LIKE '$id'") or die(mysqli_errno());
while($fetch = $query->fetch_array()){
	$numprerequis= $fetch['Num_Prerequis'];
	$reqnomprerequis = $bdd->query("SELECT *
	FROM Formation WHERE NumPrérequis LIKE '$numprerequis'");
	$donneesNomPrerequis= $reqnomprerequis->fetch();

$output .= "
			<tr>
				<td>".$donneesNomPrerequis['Nom_Prerequis']."</td>
				<td>".$fetch['dateobtention']."</td>

			</tr>
";
}
$output .="
	</tbody>
	
			</table>
			";
	echo $output;
	
	$req6 = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
	$donnees6 = $req6->fetch();
	$email = $donnees6['email'];
	try{
		$etat = "Succès : Extraction OCMF Diplome ";
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

?>