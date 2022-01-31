<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OCMF - Administration</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


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
            <img src="assets/img/bg1.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $donnees['lname']?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul style="margin " class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $donnees['fname'].' '.$donnees['lname'];?></h6>
              <span><?php echo $donnees['grade']?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../release2.0/index.php">
                <i class="bi bi-arrow-90deg-left"></i>
                <span>Retour sur l'OCMF</span>
              </a>
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
      <span>Tableau de bord</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="bi-file-earmark-spreadsheet"></i><span>Formation</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="ajoutdeformation.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Ajout de Formation</span>
        </a>
      </li>
      <li>
        <a href="visuformation.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Visualisation des Formations</span>
        </a>
      </li>
    </ul>
    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-bookmark-check"></i><span>Pré-Requis</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="ajoutdeprérequis.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Ajout de Prérequis</span>
        </a>
      </li>
        <a href="visuprerequis.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Visualisation des prérequis</span>
        </a>
      </li>
    </ul>
    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#table-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-diagram-3-fill"></i><span>Equivalence</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="table-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="equivalence.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Ajout d'équivalence</span>
        </a>
      </li>
      <li>
        <a href="visuequivalence.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Visualisation d'équivalence</span>
        </a>
      </li>
    </ul>
    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-info-circle-fill"></i><span>Logs</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="logsrecherche.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Recherches SAP/Diplomes</span>
        </a>
      </li>
    </ul>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="logsajout.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Formations</span>
        </a>
      </li>
    </ul>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="logsajoutprerequis.php">
          <i class="bi bi-plus-circle-dotted"></i><span>PréRequis</span>
        </a>
      </li>
    </ul>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="logsajoutequi.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Equivalence</span>
        </a>
      </li>
    </ul>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="logsconnexionpanel.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Connexion Panel</span>
        </a>
      </li>
    </ul>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="logsconnexionocmf.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Connexion OCMF</span>
        </a>
      </li>
    </ul>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Divers</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="acces.php">
          <i class="bi bi-plus-circle-dotted"></i><span>Accès Utilisateurs</span>
        </a>
      </li>
    </ul>
  </li><!-- End Forms Nav -->

</aside><!-- End Sidebar-->  

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

  