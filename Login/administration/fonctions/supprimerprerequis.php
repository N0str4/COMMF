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
$req45 = $bdd->query("SELECT * FROM `Formation` WHERE NumPrérequis LIKE '$id'");
$donnees45 = $req45->fetch();



try{
    //On insère les données reçues
    $delete = $bdd->prepare("
    DELETE FROM Formationdetails WHERE `num_prerequis` = :id1");
    $delete->bindParam(':id1',$id);
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

  try{
    //On insère les données reçues
    $delete = $bdd->prepare("
    DELETE FROM formationliaison WHERE `Num_Prerequis` = :id1");
    $delete->bindParam(':id1',$id);
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

try{
    //On insère les données reçues
    $delete2 = $bdd->prepare("
    DELETE FROM Formation WHERE `NumPrérequis` = :id2");
    $delete2->bindParam(':id2',$id);
    $delete2->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }


  try{
    //On insère les données reçues
    $requeteLog1 = $bdd->prepare("
        INSERT INTO logajoutpre(Nom, Prerequis, Date, type)
        VALUES(:nom, :prerequis, :date, :type)");
    $requeteLog1->bindParam(':nom',$nom);
    $requeteLog1->bindParam(':prerequis',$donnees45["Nom_Prerequis"]); 
    $requeteLog1->bindParam(':date',$now); 
    $requeteLog1->bindParam(':type',$supprimage); 
    $requeteLog1->execute();
    
  }   
  catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
  }
?><script type="text/javascript">
window.location.replace("http://intradef.vikatchev.com/Login/administration/visuprerequis.php");
</script>