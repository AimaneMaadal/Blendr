<?php

include_once '../../classes/config.php';

$id = $_GET['id'];
$matchId = $_GET['id2'];
$like = $_GET['like'];

$connect = Db::getInstance();

$sql = "INSERT INTO `matches` (`id`, `user_id`, `match_id`, `like`) VALUES (NULL, '$id', '$matchId', '$like')";
$statement = $connect->prepare($sql);

$statement->execute();    

echo "id: ".$id." Liked: ".$_GET['id2']." Type: ".$_GET['like'];



?>