<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
$id = (!empty($_GET['id']))? intval($_GET['id']) : 0;

	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=Extraction_OCMF_Diplomes.xls");  
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
				</tr>
			<tbody>
	";
	$query = $conn->query("SELECT * FROM `utils` WHERE id LIKE '$id'") or die(mysqli_errno());
	while($fetch = $query->fetch_array()){
		
	$output .= "
				<tr>
					<td>".$fetch['Grade']."</td>
					<td>".$fetch['nom']."</td>
					<td>".$fetch['prenom']."</td>
					<td></td>
					<td>".$fetch['sap']."</td>
					<td>".$fetch['matriculedefense']."</td>
					<td>".$fetch['saplegion']."</td>
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
	
	
?>