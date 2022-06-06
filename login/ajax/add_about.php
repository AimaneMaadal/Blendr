<?php

session_start();

$tags = $_POST['tags'];
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");
$sql = "UPDATE users SET tags = '$tags' WHERE unique_id = '".$_SESSION['unique_id']."'"; 
$result = mysqli_query($conn, $sql);


?>