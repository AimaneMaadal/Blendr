<?php

session_start();

$image = json_decode($_POST['images'])[0];
$userId = $_SESSION['unique_id'];
$dateTime = date("Y-m-d H:i:s");
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");
$users = json_encode($_SESSION["unique_id"]);
$sql = "INSERT INTO `posts` (`id`, `userId`, `description`, `post_img`, `date`, `users`) VALUES (NULL, '$userId', 'NULL', '$image', '$dateTime', '$users');";
$result = mysqli_query($conn, $sql);
//get sql of usersid last post
$sql = "SELECT * FROM `posts` WHERE `userId` = '$userId' ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$postId = $row['id'];


echo $postId;

?>