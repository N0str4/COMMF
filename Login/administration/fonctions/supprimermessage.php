<?php

include '../config/config.php';
$id = (!empty($_GET['id']))? intval($_GET['id']) : 0;

try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM infoIndex");
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

?><script type="text/javascript">
window.location.replace("http://intradef.vikatchev.com/Login/administration/fonctions/regroupementlogcomplete.php?etat=1&id=<? echo $id; ?>&type=3");
</script>