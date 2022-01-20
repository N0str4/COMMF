<?php

include '../config/config.php';
$id = (!empty($_GET['id']))? intval($_GET['id']) : 0;

try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM users WHERE `user_id` = :id");
    $delete->bindParam(':id',$id);
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
?>
<script type="text/javascript">
                window.location.replace("http://intradef.vikatchev.com/Login/administration/acces.php");
            </script>