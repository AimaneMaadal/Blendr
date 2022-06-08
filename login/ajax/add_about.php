<?php

session_start();

$bio = $_POST['about'];
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");
$sql = "UPDATE users SET bio = '$bio' WHERE unique_id = '".$_SESSION['unique_id']."'"; 
$result = mysqli_query($conn, $sql);


?>