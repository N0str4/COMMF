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
    $req45 = $bdd->query("SELECT * FROM `Equivalence` WHERE ID_FK LIKE '$id'");
    $donnees45 = $req45->fetch();
     


    try{
        //On insère les données reçues
        $requeteLog1 = $bdd->prepare("
            INSERT INTO logsequivalence (Nom, Equivalence, Equivalence2, Date, type)
            VALUES(:nom, :Equivalence, :Equivalence2, :date, :type)");
        $requeteLog1->bindParam(':date',$now); 
        $requeteLog1->bindParam(':nom',$nom);
        $requeteLog1->bindParam(':Equivalence',$donnees45['id_prerequis']);
        $requeteLog1->bindParam(':Equivalence2',$donnees45['liaison_id_prerequis']); 
        $requeteLog1->bindParam(':type',$supprimage); 
        $requeteLog1->execute();
      }   
      catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
      }
    
try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM Equivalence WHERE `ID_FK` = :id");
    $delete->bindParam(':id',$id);
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

?><script type="text/javascript">
window.location.replace("http://intradef.vikatchev.com/Login/administration/visuequivalence.php");
</script>