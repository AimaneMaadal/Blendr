<?php
 //insert.php

include_once("../../classes/post.php");
include_once("../../classes/user.php");
 
 $host = "localhost";
 $username = "root";
 $password = "usbw";
 $database = "chatapp";

    
 $conn = new mysqli($host, $username, $password, $database);
    //add like to post
    if(isset($_POST["id"])){
        $postId = $_POST["post_id"];
        $userId = $_POST["id"];
        $comment = $_POST["comment"];
        $date = date("Y-m-d H:i:s");

        // echo "id: ".$userId;
        // echo "post_id: ".$_POST["post_id"];
        // echo "comment: ".$_POST["comment"];

        $sql = "INSERT INTO comments (postId, userId, comment, date) VALUES ('$postId', '$userId', '$comment', '$date')";
        $conn->query($sql);

        $sql = "SELECT * FROM comments WHERE postId = '$postId'";
        $result = $conn->query($sql);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        // echo json_encode($result);


            echo '<div class="comment">';
            echo '<img class="profilePicComment" style="width: 30px;height: 30px;" id="profilePicture" src="../php/images/' .User::getUserById($userId)[0]["img"]. '" alt="">';
            echo '<p>'.User::getUserById($userId)[0]["fname"].'</p>';
            echo '<p>'.$comment.'</p>';
            echo '</div>';
        
      

        


    }
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 ?>  