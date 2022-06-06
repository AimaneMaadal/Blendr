<?php

session_start();

$tags = $_POST['tags'];
$id = $_POST['id'];

echo $id;
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");
$sql = "UPDATE `recipes` SET `tags` = '$tags' WHERE `recipes`.`recipe_id` = $id;";
$result = mysqli_query($conn, $sql);


?>