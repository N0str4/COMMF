<?php

include '../config/config.php';


try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM logsequivalence");
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

?><script type="text/javascript">
window.location.replace("http://intradef.vikatchev.com/Login/administration/logsajoutequi.php");
</script>