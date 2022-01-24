<?php

include '../config/config.php';
$id = (!empty($_GET['id']))? intval($_GET['id']) : 0;
if(isset ($_GET["nom"])) { 
    $nom = $_GET["nom"]; 
    } else { 
    $nom = "ERROR"; // ou toute valeur par défaut... 
    }

$supprimage = "SUPPRESSIONS";
$now = date('Y-m-d H:i:s');



$req45 = $bdd->query("SELECT * FROM `Formationdetails` WHERE ID_PK LIKE '$id'");
$donnees45 = $req45->fetch();




try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM Formationdetails WHERE `ID_PK` = :id");
    $delete->bindParam(':id',$id);
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

  try{
    //On insère les données reçues
    $requeteLog1 = $bdd->prepare("
        INSERT INTO logsajout(Nom, Formation, Prerequis, Date, type)
        VALUES(:nom, :formation, :prerequis, :date, :type)");
    $requeteLog1->bindParam(':date',$now); 
    $requeteLog1->bindParam(':nom',$nom);
    $requeteLog1->bindParam(':formation',$donnees45['nomformation']);
    $requeteLog1->bindParam(':prerequis',$donnees45['num_prerequis']); 
    $requeteLog1->bindParam(':type',$supprimage); 
    $requeteLog1->execute();
  }   
  catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
  }
  

?><script type="text/javascript">
window.location.replace("http://intradef.vikatchev.com/Login/administration/visuformation.php");
</script>