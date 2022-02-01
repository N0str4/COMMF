<?php 

include 'administration/config/config.php';

try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM logajoutpre");
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

  try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM logsequivalence");
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
  try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM logsajout");
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
  try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM logsconnexionocmf");
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }


  try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM logsconnexion");
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
  try{
    //On insère les données reçues


    $delete = $bdd->prepare("
    DELETE FROM logsrecherche");
    $delete->execute();

  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
