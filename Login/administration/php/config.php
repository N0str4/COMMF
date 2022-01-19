<?php
  $hostname = "vikatch505.mysql.db";
  $username = "vikatch505";
  $password = "Billitlebg59";
  $dbname = "vikatch505";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }



  
?>
