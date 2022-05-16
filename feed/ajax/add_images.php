<?php

session_start();

$image = json_decode($_POST['images'])[0];
$userId = $_SESSION['unique_id'];
$dateTime = date("Y-m-d H:i:s");
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");
$users = json_encode($_SESSION["unique_id"]);
$sql = "INSERT INTO `posts` (`id`, `userId`, `description`, `post_img`, `date`, `users`) VALUES (NULL, '$userId', 'NULL', '$image', '2022-05-01', '$users');";
$result = mysqli_query($conn, $sql);

?>