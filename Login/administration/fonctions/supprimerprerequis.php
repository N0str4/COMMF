<?php

include '../config/config.php';
$id = (!empty($_GET['id']))? intval($_GET['id']) : 0;
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
    $delete2 = $bdd->prepare("
    DELETE FROM Formation WHERE `NumPrérequis` = :id2");
    $delete2->bindParam(':id2',$id);
    $delete2->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

?><script type="text/javascript">
window.location.replace("http://intradef.vikatchev.com/Login/administration/visuprerequis.php");
</script>