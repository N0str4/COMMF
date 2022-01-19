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


<main id="main" class="main">

<div class="pagetitle">
  <h1>Ajout de Formation</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Formation</li>
      <li class="breadcrumb-item active">Ajout</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">     </h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" method="post">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="nomforma" id="floatingName" placeholder="Nom de la nouvelle Formation" required>
                    <label for="floatingName">Nom de la nouvelle Formation</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="prenom" id="floatingEmail" placeholder="Votre Nom" disabled="disabled">
                    <label for="floatingEmail"><?php  echo 'Prenom: '.$donnees['fname']?></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="nom" id="floatingPassword" placeholder="Votre Prénom" disabled="disabled">
                    <label for="floatingPassword"><?php echo 'Nom: '.$donnees['lname']?></label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <select name="selection"class="form-select" id="floatingName" aria-label="TEST" required>
                      <option value="1">Personnel Millitaire</option>
                      <option value="0">Personnel Civil</option>
                      <option value="2">Les deux</option>
                    </select>
                    <label for="floatingSelect">Formation à destination de :</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select name="prerequis1" class="form-select" id="floatingSelect" aria-label="Choix du Pré-Requis" required>
                      <?php
                      
                      $req4 = $bdd->query("SELECT * FROM `Formation`");
                      $varListDeroulante=1;
                      while ($donnees4 = $req4->fetch()){?>
                      
                        <option value="<?php echo $donnees4['NumPrérequis'];?>"><?php echo $donnees4['Nom_Prerequis'] ?></option>
                        
                      <?php
                      $varListDeroulante=$varListDeroulante+1;
                      }
                    ?>

                    </select>
                    <label for="floatingSelect">Selection du Pré-Requis</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select name="prerequis2" class="form-select" id="floatingSelect" aria-label="Choix du Pré-Requis" required>
                      <?php
                      
                      $req3 = $bdd->query("SELECT * FROM `Formation`");
                      $varListDeroulante=1;
                      while ($donnees3 = $req3->fetch()){?>
                        <option value="<?php echo $donnees3['NumPrérequis']; ?>"><?php echo $donnees3['Nom_Prerequis'] ?></option>
                        
                      <?php
                      $varListDeroulante=$varListDeroulante+1;
                      }
                    ?>
                     <option value="0" selected>Aucune</option>
                    </select>
                    <label for="floatingSelect">Selection du Pré-Requis</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select name="prerequis3" class="form-select" id="floatingSelect" aria-label="Choix du Pré-Requis" required>
                      <?php
                      
                      $req2 = $bdd->query("SELECT * FROM `Formation`");
                      $varListDeroulante=1;
                      while ($donnees2 = $req2->fetch()){?>
                        <option value="<?php echo $donnees2['NumPrérequis']; ?>"><?php echo $donnees2['Nom_Prerequis'] ?></option>
                        
                      <?php
                      $varListDeroulante=$varListDeroulante+1;
                      }
                    ?>
                    <option value="0" selected>Aucune</option>

                    </select>
                    <label for="floatingSelect">Selection du Pré-Requis</label>
                  </div>
                </div>
                <br>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                  <select name="selectionprerequis1" class="form-select" id="floatingSelect" aria-label="Selection CIV or MIL" required>
                      <option value="0">Pré-Requis Millitaire</option>
                      <option value="1">Pré-Requis Civil</option>
                      <option value="3">Pré-Requis Civil et Millitaire</option>
                    </select>
                    <label for="floatingSelect">PréRequis Civ ou Millitaire</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                    <select name="selectionprerequis2" class="form-select" id="floatingSelect" aria-label="Selection CIV or MIL" required>
                      <option value="0">Pré-Requis Millitaire</option>
                      <option value="1">Pré-Requis Civil</option>
                      <option value="3">Pré-Requis Civil et Millitaire</option>
                    </select>
                    <label for="floatingSelect">PréRequis Civ ou Millitaire</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-3">
                  <select name="selectionprerequis3" class="form-select" id="floatingSelect" aria-label="Selection CIV or MIL" required>
                      <option value="0">Pré-Requis Millitaire</option>
                      <option value="1">Pré-Requis Civil</option>
                      <option value="3">Pré-Requis Civil et Millitaire</option>
                    </select>
                    <label for="floatingSelect">PréRequis Civ ou Millitaire</label>
                  </div>
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
<?php 
$nom = $donnees['lname'];
$prenom = $donnees['fname'];
$nomformation = $_POST['nomforma'];
$selection = $_POST['selection'];
$nomprerequis1 = $_POST['prerequis1'];
$nomprerequis2 = $_POST['prerequis2'];
$nomprerequis3 = $_POST['prerequis3'];
$selectionCivMil1 = $_POST['selectionprerequis1'];
$selectionCivMil2 = $_POST['selectionprerequis2'];
$selectionCivMil3 = $_POST['selectionprerequis3'];
$k=1;
$bdd = new PDO('mysql:host=vikatch505.mysql.db;dbname=vikatch505;charset=utf8', 'vikatch505', 'Billitlebg59');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



if(isset($nomformation)){
if ($selection==0){
  // CIVIL
  try{
  $idFormaCivil=29;
  $envoieCivil = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis)
        VALUES(:id, :nomforma, :numpre)");
    $envoieCivil->bindParam(':id',$k);
    $envoieCivil->bindParam(':nomforma',$nomformation);
    $envoieCivil->bindParam(':numpre',$idFormaCivil);
    $envoieCivil->execute();
  }catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
}elseif($selection==1){
  // MILI
  try{
  $idFormaMil=28;
  $envoieMil = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis)
        VALUES(:id, :nomforma, :numpre)");
    $envoieMil->bindParam(':id',$k);
    $envoieMil->bindParam(':nomforma',$nomformation);
    $envoieMil->bindParam(':numpre',$idFormaMil);
    $envoieMil->execute();

  }catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
}elseif($selection==2){
  //LES DEUX
  
}
}




if (isset($nomformation) && $nomprerequis2==0 && $nomprerequis3==0){

try{
  //On insère les données reçues
  $sth = $bdd->prepare("
      INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
      VALUES(:id, :nomforma, :numpre, :type)");
  $sth->bindParam(':id',$k);
  $sth->bindParam(':nomforma',$nomformation);
  $sth->bindParam(':numpre',$nomprerequis1);
  $sth1->bindParam(':type',$selectionCivMil1);

  $sth->execute();
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <h4 class="alert-heading"> SUCCES !</h4>
    <p>La Formation à bien été ajouté avec 1 pré-requis.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div><?php

  
}
catch(PDOException $e){
  echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
}
}elseif (isset($nomformation) && $nomprerequis2!=0 && $nomprerequis3==0){
  try{
 
    //On insère les données reçues
    $sth1 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth1->bindParam(':id',$k);
    $sth1->bindParam(':nomforma',$nomformation);
    $sth1->bindParam(':numpre',$nomprerequis1);
    $sth1->bindParam(':type',$selectionCivMil1);
    $sth1->execute();
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
  try{
 
    //On insère les données reçues
    $sth2 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth2->bindParam(':id',$k);
    $sth2->bindParam(':nomforma',$nomformation);
    $sth2->bindParam(':numpre',$nomprerequis2);
    $sth2->bindParam(':type',$selectionCivMil2);
    $sth2->execute();
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <h4 class="alert-heading"> SUCCES !</h4>
    <p>La Formation à bien été ajouté avec 2 pré-requis.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div><?php
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

}elseif (isset($nomformation) && $nomprerequis2!=0 && $nomprerequis3!=0){
  try{
 
    //On insère les données reçues
    $sth1 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth1->bindParam(':id',$k);
    $sth1->bindParam(':nomforma',$nomformation);
    $sth1->bindParam(':numpre',$nomprerequis1);
    $sth1->bindParam(':type',$selectionCivMil1);

    $sth1->execute();
  
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }
  try{
 
    //On insère les données reçues
    $sth2 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth2->bindParam(':id',$k);
    $sth2->bindParam(':nomforma',$nomformation);
    $sth2->bindParam(':numpre',$nomprerequis2);
    $sth2->bindParam(':type',$selectionCivMil2);
    $sth2->execute();
    
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }try{
 
    //On insère les données reçues
    $sth3 = $bdd->prepare("
        INSERT INTO Formationdetails(id, nomformation, num_prerequis, type)
        VALUES(:id, :nomforma, :numpre, :type)");
    $sth3->bindParam(':id',$k);
    $sth3->bindParam(':nomforma',$nomformation);
    $sth3->bindParam(':numpre',$nomprerequis3);
    $sth3->bindParam(':type',$selectionCivMil3);
    $sth3->execute();?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <h4 class="alert-heading"> SUCCES !</h4>
    <p>La Formation à bien été ajouté avec 3 pré-requis.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div><?php
  }
  catch(PDOException $e){
    echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
  }

}


