<?php
  $hostname = "localhost";
  $username = "root";
  $password = "usbw";
  $dbname = "chatapp";

  //make connection to database
  
  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>