<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OCMF - Administration</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


<?php
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
$req = $bdd->query("SELECT * FROM `users` WHERE unique_id LIKE '{$_SESSION['unique_id']}'");
$donnees = $req->fetch();
 
?>





  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/vendor/tableau.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  </head>

<body>
        <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Administration OCMF</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $donnees['lname']?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $donnees['fname'].' '.$donnees['lname'];?></h6>
              <span><?php echo $donnees['grade']?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../php/logout.php?logout_id= <?php echo $_SESSION['unique_id'];?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Deconnexion</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header>









        <!-- MENU  -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Formation</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="ajoutdeformation.php">
          <i class="bi bi-circle"></i><span>Ajout de Formation</span>
        </a>
      </li>
      <li>
        <a href="visuformation.php">
          <i class="bi bi-circle"></i><span>Visualisation des Formations</span>
        </a>
      </li>
    </ul>
    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Pré-Requis</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="ajoutdeprérequis.php">
          <i class="bi bi-circle"></i><span>Ajout de Prérequis</span>
        </a>
      </li>
      <li>
        <a href="visuprerequis.php">
          <i class="bi bi-circle"></i><span>Visualisation des prérequis</span>
        </a>
      </li>
    </ul>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Accès Panel</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="forms-elements.html">
          <i class="bi bi-circle"></i><span>Ajouter un accès</span>
        </a>
      </li>
    </ul>
  </li><!-- End Forms Nav -->

</aside><!-- End Sidebar-->  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Visualisation des formations</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Formations</li>
          <li class="breadcrumb-item active">Informations</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Formations</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom de la Formation</th>
                    <th scope="col">Nom du Prérequis</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
$req2 = $bdd->query("SELECT *
FROM `Formationdetails`");
$k=0;
?>
<?php while ($donnees = $req2->fetch()){
    $k=$k+1;
$test=$donnees['num_prerequis'];
$req3 = $bdd->query("SELECT *
FROM `Formationdetails`
INNER JOIN Formation
ON Formationdetails.num_prerequis = Formation.NumPrérequis WHERE NumPrérequis LIKE '$test'");
$donnees2 = $req3->fetch()
?>

  <tr><th scope="row"><?php echo $k?></th><td> <?php echo $donnees['nomformation']?></td><td> <?php echo $donnees2['Nom_Prerequis']?></td></tr>




<?php }?>
                  <?php /*<tr>
                    <th scope="row"><?php echo $k?></th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                  </tr>*/?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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