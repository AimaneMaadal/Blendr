<?php

include_once("../../classes/post.php");

$users = $_POST['users'];
$postId = $_POST['postId'];

var_dump($users." ".$postId);

post::updateUsers($postId, $users);

?>