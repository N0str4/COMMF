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
	


require_once 'config/config.php';




if($id==1){ // MDR
$test='MDR';
$req2 = $bdd->query("SELECT *
FROM `utils` WHERE `Catégorie` LIKE '$test'");

$rows = $req2->fetchAll();

foreach ($rows as $fetch){

	$output = "";
	
	$output .="
		<table>
		<br>
		<br>
		<br>
			<thead>
				<tr>
					<th style ='background-color: #0066cc;color: #fff;'>2Grade act LA</th>
					<th style ='background-color: #0066cc;color: #fff;'>Nom</th>
					<th style ='background-color: #0066cc;color: #fff;'>Prenom</th>
					<th>
					<th style ='background-color: #0066cc;color: #fff;'>Matricule SAP</th>
					<th style ='background-color: #0066cc;color: #fff;'>Identifiant Defense</th>
					<th style ='background-color: #0066cc;color: #fff;'>Matricule Legion</th>
				</tr>
			<tbody>
	";

		
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
		$id2=$fetch['id'];
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
$req2 = $bdd->query("SELECT *
FROM `formationliaison` WHERE `id_user` LIKE '$id2'");
while ($donnees = $req2->fetch()){

	$numprerequis= $donnees['Num_Prerequis'];
	$reqnomprerequis = $bdd->query("SELECT *
	FROM Formation WHERE NumPrérequis LIKE '$numprerequis'");
	$donneesNomPrerequis= $reqnomprerequis->fetch();

$output .= "
			<tr>
				<td>".$donneesNomPrerequis['Nom_Prerequis']."</td>
				<td>".$donnees['dateobtention']."</td>

			</tr>
";
}
$output .="
	</tbody>
	
			</table>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			";
	
	echo $output;
	
}	
}elseif($id==3){ //OFF
	$test='OFF';
	$req2 = $bdd->query("SELECT *
	FROM `utils` WHERE `Catégorie` LIKE '$test'");
	
	$rows = $req2->fetchAll();
	
	foreach ($rows as $fetch){
	
		$output = "";
		
		$output .="
			<table>
			<br>
			<br>
			<br>
				<thead>
					<tr>
						<th style ='background-color: #0066cc;color: #fff;'>2Grade act LA</th>
						<th style ='background-color: #0066cc;color: #fff;'>Nom</th>
						<th style ='background-color: #0066cc;color: #fff;'>Prenom</th>
						<th>
						<th style ='background-color: #0066cc;color: #fff;'>Matricule SAP</th>
						<th style ='background-color: #0066cc;color: #fff;'>Identifiant Defense</th>
						<th style ='background-color: #0066cc;color: #fff;'>Matricule Legion</th>
					</tr>
				<tbody>
		";
	
			
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
			$id2=$fetch['id'];
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
	$req2 = $bdd->query("SELECT *
	FROM `formationliaison` WHERE `id_user` LIKE '$id2'");
	while ($donnees = $req2->fetch()){
	
		$numprerequis= $donnees['Num_Prerequis'];
		$reqnomprerequis = $bdd->query("SELECT *
		FROM Formation WHERE NumPrérequis LIKE '$numprerequis'");
		$donneesNomPrerequis= $reqnomprerequis->fetch();
	
	$output .= "
				<tr>
					<td>".$donneesNomPrerequis['Nom_Prerequis']."</td>
					<td>".$donnees['dateobtention']."</td>
	
				</tr>
	";
	}
	$output .="
		</tbody>
		
				</table>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				";
		
		echo $output;
		
	}	
	}elseif($id==2){ //SOFF
		$test='SOFF';
		$req2 = $bdd->query("SELECT *
		FROM `utils` WHERE `Catégorie` LIKE '$test'");
		
		$rows = $req2->fetchAll();
		
		foreach ($rows as $fetch){
		
			$output = "";
			
			$output .="
				<table>
				<br>
				<br>
				<br>
					<thead>
						<tr>
							<th style ='background-color: #0066cc;color: #fff;'>2Grade act LA</th>
							<th style ='background-color: #0066cc;color: #fff;'>Nom</th>
							<th style ='background-color: #0066cc;color: #fff;'>Prenom</th>
							<th>
							<th style ='background-color: #0066cc;color: #fff;'>Matricule SAP</th>
							<th style ='background-color: #0066cc;color: #fff;'>Identifiant Defense</th>
							<th style ='background-color: #0066cc;color: #fff;'>Matricule Legion</th>
						</tr>
					<tbody>
			";
		
				
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
				$id2=$fetch['id'];
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
		$req2 = $bdd->query("SELECT *
		FROM `formationliaison` WHERE `id_user` LIKE '$id2'");
		while ($donnees = $req2->fetch()){
		
			$numprerequis= $donnees['Num_Prerequis'];
			$reqnomprerequis = $bdd->query("SELECT *
			FROM Formation WHERE NumPrérequis LIKE '$numprerequis'");
			$donneesNomPrerequis= $reqnomprerequis->fetch();
		
		$output .= "
					<tr>
						<td>".$donneesNomPrerequis['Nom_Prerequis']."</td>
						<td>".$donnees['dateobtention']."</td>
		
					</tr>
		";
		}
		$output .="
			</tbody>
			
					</table>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					";
			
			echo $output;
			
		}	
		}	
?>