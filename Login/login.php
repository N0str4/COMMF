<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: release2.0/index.php");
  }
?>

<?php include_once "header.php"; ?>
<body>

  <div class="wrapper">
    <section class="form login">
    <img class="image" src="ministere.png" style="  border: none;
  width: 40%;
  margin-left:120px;
  text-align: center;
  height: 34%;">
      <header>DOA | Accès O.C.M.F </header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Adresse email</label>
          <input type="text" name="email" placeholder="Entrez votre email @intradef.gouf.fr" required>
        </div>
        <div class="field input">
          <label>Mot De Passe</label>
          <input type="password" name="password" placeholder="Entrez votre Mot de Passe" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continuez vers l'OCMF ">
        </div>
      </form>
      <div class="link">Referez vous au CNE RYSSEN, en cas de problème.</div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
