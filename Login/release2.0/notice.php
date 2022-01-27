<?php session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }?>
<link rel="stylesheet" href="MiseEnPage.css" />
<nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo_img"><img src="bg1.png" style="  margin-left : 2px;
  width: 40px;
  margin-top:10px;
  margin-bottom: -10px;
  height: 65px;"></label>
      <label class="logo">OCMF</label>
      <label class="logo_img"><img src="logoADT.png" style="  margin-left : 1050px;
  width: 70px;
  padding: initial;
  margin-top:10px;
  height: 55px;"></label>
      <ul>
      <li><a href="index.php">DashBoard</a></li>
      <li><a href="personnel.php">Recherche</a></li>
    	<li><a class="active" href="notice.php">Notice d'utilisation</a></li>
      <li><a href="contact.php">Contact</a></li>
        <li style="float:right"><a href="../administration/index.php">Administration</a></li>
        <li style="float:right"><a href="../php/logout.php?logout_id= <?php echo $_SESSION['unique_id'];?>">Deconnexion</a></li>
  	</ul>
    </nav>
<br>
<html>
	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" href="notice.css" />
		<title>OCMF - Notice d'utilisation</title>

	</head>
    <div class="Introduction">
    <h1 class="couleur">O.C.M.F</h1>
    <h2 class="couleur2">
     Notice d'utilisation
    </h2>
    <hr>
    <p class="introduction_h1">
    1. Introduction
    </p>
    <p class ="introduction_text">
    <b>Outils Cellulle Metier Formation</b> est un outil permettant à la Celulle Metier et Formation de rechercher les pré-requis d'un candidat, en fonction d'une formation spécifique. 
    <br><br>
    L'utilisation de <b>l'OCMF </b> à était simplifié à sont maximum, afin de permettre à la Cellule, de pouvoir utiliser les possibilités de cette outils, à sont maximum.
    <br><br>
    </p>
  </div>
  <div class="Utilisation">
      <hr>
      <p class="introduction_h1">
    2. Utilisation Général
    </p>
    <p class="introduction_h2">
    2.1 Candidat et Formation
    </p><br>
    <p class="introduction_text">
    Chaque personnel de l'Armée de Terre est identifié par un SAP.
    Dans le but de selectionné un candidat, vous devez impérativement entré un <b>SAP valide.</b><br>
    Dans le cas, où un SAP invalide est entré, un message vous préviendra de réitéré votre action.<br>
    Chaque formation de l'Armée de Terre est identifié par un nom court et un nom long.<br>
    Dans le but de selectionné une formation facilement, vous devez impérativement selectionné le nom court de la  <b>formation voulu.</b><br> 
    </p><br>
     <p class="introduction_h2">
    2.2 Affichage des résultats
    </p><br>
    <p class="introduction_text">
    Une fois le <b>SAP</b> et la <b>Formation</b> correctement entré, un tableau s'affichera, contenant l'ensemble des informations connu sur le candidat.<br></p>
    <p class="center">
    <b>Vous retrouverez :</b><br>
      - <b>NOM</b><br>
  <k> (Nom du Millitaire, reférant au SAP)</k><br>
      - <b>FORMATION DEMANDER</b><br>
  <k> (Formation selectionné en amont)</k><br>
      - <b>DIPLOME REQUIS</b><br>
  <k> (Listing des formations requis pour validé la mise en formation du candidat.)</k><br>
      - <b>DIPLOME REQUIS DETENU OU NON</b><br>
  <k> (Etat des formations requis pour validé la mise en formation du candidat.)</k><br>
  <k> (Etat possible : VALIDE / NONVALIDE)</k><br>
  <k> (ATTENTION : Une formation peut etre Valide, cependant peut necessité un recyclage c.f voir recyclage ci dessous.)</k><br>
      - <b>RECYCLAGE</b><br>
   <k> (Indique à la Cellule, si le candidat dois impérativement faire un recyclage, si le diplome >5 ans.)</k><br>
      <br></p>
  </div>
  <div class="Prise_En_Charge">
  <hr>
      <p class="introduction_h1">
    3. Spécificité
    </p>
    <p class="introduction_h2">
    3.1 Spécificité pris en charge
    </p><br>
    <p class="introduction_text">
    LE <b>OCMF</b> prend en charge concernant les formations de :<br>     </p>
    <p class="center">
  - la validité <br>
  - le recyclage <br>
  - l'équivalence <br><br>
    </p><br>
    <p class="introduction_h2">
    3.2 Validité des formations
    </p><br>
    <p class="introduction_text">
    <b>L'OCMF</b> calcule <b>automatiquement</b> si les formations des candidats sont arrivé à expiration, où si dans le cas contraire, sont valide.<br>
    Dans le cas où une formation est arrivé à expiration, l'OCMF affichera alors que la formation est <b>NON VALIDE</b>, et necessite une formation initial afin de l'acquerir à nouveau.<br><br>
    <b>Liste des formations validite à A+5: </b><br>

A MAI 5 2 00 EXPERT E.S.PRESSION - FORM ADA EXPERT EQUIPEMENTS SOUS PRESSION<br>
    <b>Liste des formations validite à A+4: </b>  <br>
  A MAI 5 2 00 UTIL MACH PNEU HUTCH - FORM ADA UTILISA. MACHINE PNEUMATIQUE HUTCHINSON
    </p>
<br>
    <p class="introduction_h2">
    3.3 Recyclage des formations
    </p>
    <p class="introduction_text">
    <b>L'OCMF</b> calcule <b>automatiquement</b> si les formations des candidats sont arrivé à expiration, et necessite simplement un <b>recyclage</b><br>
    Dans le cas où une formation est arrivé à expiration et necessite un recyclage, l'OCMF affichera alors que la formation est <b>VALIDE</b>, mais affichera dans la colonne <b>'Recyclage'</b> en orange, qu'elle necessitera une formation recyclage afin de l'acquerir à nouveau.<br><br>
    <b>Liste des formations necessitant un recyclage à A+5</b><br>
  A MAI 5 2 00 RE MEOCLD - FORM ADA RECYCLAGE MEO TRM 10000 CLD<br>
  A MAI 5 2 00 RECY CL&M - FORM ADA RECYCLAGE CONTROLEURS APP. LEV. MANUTENTI<br>
  A MAI 5 2 00 RECYCLAGE MEO PPLD - FORM ADA MAI RECYCLAGE PPLD<br>
  A MAI 5 2 00 RH G DCL - FORM ADA REMISE A HAUTEUR GRUE DCL<br>
    </p><br>
     <p class="introduction_h2">
    3.4 Equivalence des formations
    </p>
    <p class="introduction_text">
    <b>L'OCMF</b> calcule <b>automatiquement</b> si les diplomes des candidats possède une <b>équivalence.</b><br>
    Dans le cas où, le diplome possédé par le candidat, possède une équivalence, dont la formation necessite.<br>
    Celle-ci, <b>Validera automatiquement</b>, la formation équivalente au diplome de l'intéréssé.<br>
    L'OCMF affichera le diplome requis, en <b>VALIDE</b>
<br>
  
  </div>
