<?php

    include_once("bootstrap.php");

    session_start();
    if (isset($_SESSION['user'])) {
        $sessionId = $_SESSION['user'];
        $user = User::getUserFromEmail($sessionId);
        $user->deleteUser();
    }
    session_destroy();
    header("Location: register.php");
?>