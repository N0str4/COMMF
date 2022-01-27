<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" href="MiseEnPage.css" />
		<title>OCMF - Gestion des pré-requis</title>

	</head>
	
	<header>
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
    	<li><a href="notice.php">Notice d'utilisation</a></li>
        <li><a class="active" href="contact.php">Contact</a></li>
        <li style="float:right"><a href="../administration/index.php">Administration</a></li>
        <li style="float:right"><a href="../php/logout.php?logout_id= <?php echo $_SESSION['unique_id'];?>">Deconnexion</a></li>
  	</ul>
    </nav>
<br>
	</header>
    <body>
        
        <div class="wrapper">
        <section class="form login">
        <img class="image" src="ministere.png" style="  border: none;
      width: 40%;
      margin-left:160px;
      text-align: center;
      height: 34%;">
            <header>DOA | Contact Support </header>
            <!-- modify this form HTML and place wherever you want your form -->
            <form method="post" action="https://formspree.io/f/xoqrjgjl">
            
            <div class="field input">
            <label>
            Entrée votre email : <input type="email" placeholder="@email intradef.gouv.fr" name="_replyto" required/><br>
            </label>
            </div>
            <div class="field input">
            <label>
            Objet : <input type="text" placeholder="Objet du mail" name="objet" required/><br>
            </label>
            </div>
            <div class="field input">
            <label>
            Votre message :<input placeholder="Votre message" name="message" required/><br>
            </div>
            </label>
            <div class="field button">
            <input type="submit" value="Envoyer"/>
            </div>
            </form>

