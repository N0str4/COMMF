<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper2">
    <div class="toast">
      <div class="content2">
        <div class="icon"><i class="fas fa-wifi"></i></div>
        <div class="details">
          <span>You're online now</span>
          <p>Hurray! Internet is connected.</p>
        </div>
      </div>
      <div class="close-icon"><i class="far fa-times-circle"></i></div>
    </div>
  </div>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Deconneion</a>
      </header>
      <div class="search">
        <span class="text">Selectionner un utilisateur pour tchatter en direct</span>
        <input type="text" placeholder="Entez un nom">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
  <script src="script.js"></script>
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</body>
</html>
