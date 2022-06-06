<?php

echo "ok";



include_once '../../classes/config.php';

$id = $_POST['id'];
$matchId = $_POST['id2'];

$connect = Db::getInstance();

$sql = "UPDATE `matches` SET `like` = '3' WHERE `matches`.`user_id` = '$id' AND `matches`.`match_id` = '$matchId'";
$statement = $connect->prepare($sql);
$statement->execute();  


?>