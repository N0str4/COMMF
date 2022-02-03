<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');


include 'config/config.php';
$req = $bdd->query("SELECT * FROM `users` WHERE `user_id` LIKE '{$_SESSION['id']}'");
$donnees = $req->fetch();

include 'config/menu.php';
?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Notice d'Utilisation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Notice d'utilisation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section faq">
      <div class="row">
        <div class="col-lg-12">

          <div class="card basic">
            <div class="card-body">
              <h5 class="card-title"> 1. Introduction</h5>

              <div>
                <h6>1. Introduction</h6>
                <p><b>Outils Cellulle Metier Formation</b> est un outil permettant à la Celulle Metier et Formation de rechercher les pré-requis d'un candidat, en fonction d'une formation spécifique. 
    <br><br>
    L'utilisation de <b>l'OCMF </b> à était simplifié à sont maximum, afin de permettre à la Cellule, de pouvoir utiliser les possibilités de cette outils, à sont maximum.</p>
              </div>

              <div class="pt-2">
                <h6>2. Candidat et Formation</h6>
               <p> Chaque personnel de l'Armée de Terre est identifié par un SAP.
    Dans le but de selectionné un candidat, vous devez impérativement entré un <b>SAP valide.</b><br>
    Dans le cas, où un SAP invalide est entré, un message vous préviendra de réitéré votre action.<br>
    Chaque formation de l'Armée de Terre est identifié par un nom court et un nom long.<br>
    Dans le but de selectionné une formation facilement, vous devez impérativement selectionné le nom court de la  <b>formation voulu.</b><br> </p>
              </div>

              <div class="pt-2">
                <h6>3. Affichage des résultats</h6>
<p> Une fois le <b>SAP</b> et la <b>Formation</b> correctement entré, un tableau s'affichera, contenant l'ensemble des informations connu sur le candidat.<br></p>
<p>    <b>Vous retrouverez :</b><br>
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
              <div class="pt-2">
                <h6>4. Spécificité pris en charge</h6>
                <p>LE <b>OCMF</b> prend en charge concernant les formations de :<br>     </p>
<p>
  - la validité <br>
  - le recyclage <br>
  - l'équivalence <br><br>        </p>     
                 </div>
                 <div class="pt-2">
              <h6>5. Recyclage des formations</h6>
              <p class="introduction_text">
    <b>L'OCMF</b> calcule <b>automatiquement</b> si les formations des candidats sont arrivé à expiration, et necessite simplement un <b>recyclage</b><br>
    Dans le cas où une formation est arrivé à expiration et necessite un recyclage, l'OCMF affichera alors que la formation est <b>VALIDE</b>, mais affichera dans la colonne <b>'Recyclage'</b> en orange, qu'elle necessitera une formation recyclage afin de l'acquerir à nouveau.<br><br>
    <b>Liste des formations necessitant un recyclage à A+5</b><br>
  A MAI 5 2 00 RE MEOCLD - FORM ADA RECYCLAGE MEO TRM 10000 CLD<br>
  A MAI 5 2 00 RECY CL&M - FORM ADA RECYCLAGE CONTROLEURS APP. LEV. MANUTENTI<br>
  A MAI 5 2 00 RECYCLAGE MEO PPLD - FORM ADA MAI RECYCLAGE PPLD<br>
  A MAI 5 2 00 RH G DCL - FORM ADA REMISE A HAUTEUR GRUE DCL<br>
                 </div>

            </div>
          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>