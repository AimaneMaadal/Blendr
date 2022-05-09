<?php

session_start();

$images = $_POST['images'];
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");
$sql = "UPDATE users SET showcase = '$images' WHERE unique_id = '".$_SESSION['unique_id']."'"; 
$result = mysqli_query($conn, $sql);


?>