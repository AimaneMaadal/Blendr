<?php

session_start();

$image = json_decode($_POST['images'])[0];
$userId = $_SESSION['unique_id'];
$dateTime = date("Y-m-d H:i:s");
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");
$users = json_encode($_SESSION["unique_id"]);
$sql = "INSERT INTO `recipes` (`recipe_id`, `name`, `origin`, `duration`, `tags`, `maker`, `ingredients`, `description`, `img`, `calories`) VALUES (NULL, 'NULL', 'NULL', '00:00:00', 'NULL', '$userId', 'NULL', 'NULL', '$image', 'NULL');";
$result = mysqli_query($conn, $sql);
//get sql of usersid last post
$sql = "SELECT * FROM `recipes` WHERE `maker` = '$userId' ORDER BY `recipe_id` DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$postId = $row['recipe_id'];


echo $postId;

?>