<?php

session_start();
// new filename
$filename = 'post_'.date('YmdHis') . '.jpeg';
move_uploaded_file($_FILES['webcam']['tmp_name'],'../../php/images/posts/'.$filename);
$image = $filename;
$userId = $_SESSION['unique_id'];
$dateTime = date("Y-m-d H:i:s");
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");
$users = json_encode($_SESSION["unique_id"]);
$sql = "INSERT INTO `posts` (`id`, `userId`, `description`, `post_img`, `date`, `users`) VALUES (NULL, '$userId', 'NULL', '$image', '2022-05-01', '$users');";
$result = mysqli_query($conn, $sql);

$sql = "SELECT * FROM `posts` WHERE `userId` = '$userId' ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$postId = $row['id'];

echo $postId;
