<?php
 //insert.php
 $host = "localhost";
 $username = "root";
 $password = "usbw";
 $database = "chatapp";
 $teller = 0;
    $conn = new mysqli($host, $username, $password, $database);
    //add like to post
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $user_id = $_POST["userId"];

        //check if like already exists if exist delete else add
        $sql = "SELECT * FROM post_likes WHERE userId = '$user_id' AND postId = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql = "DELETE FROM post_likes WHERE userId = '$user_id' AND postId = '$id'";
            $conn->query($sql);
        }
        else{
            $sql = "INSERT INTO post_likes (userId, postId) VALUES ('$user_id', '$id')";
            $conn->query($sql);
        }
    }
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 ?>  