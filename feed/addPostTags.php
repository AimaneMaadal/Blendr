<?php

include_once("../classes/post.php");
include_once("../classes/user.php");
session_start();

 
$postId = $_GET['postId'];

if (isset($_POST['submit'])) {
    $description = $_POST['postDescription'];
    post::updateDescription($postId, $description);
}


 
$post = Post::getPostById($postId)[0];
$usersTag = user::getAllMatches($_SESSION['unique_id']);


// var_dump(toArray($usersTag));
var_dump($usersTag[0]['match_id']);
//var_dump($post["post_img"]);
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
    <script src="https://kit.fontawesome.com/6ec6696b28.js" crossorigin="anonymous"></script>
    <style>
        .postImg{
            width: 100%;
            height: 300px;
            margin: 10px auto;
            margin-top: -10px;
            display: block;
            border-radius: 10px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        input[type=text]{
            width: 80%;

            background-color: #ECECEC;
            border: none;
            color: #001F3C;
            font-weight: 600;
            padding: 10px 11px;
        }
        .postBtn{
            width: 115px;
            height: 21px;
            left: 249px;
            top: 54px;
            background: #FF7A00;
            border-radius: 4px;
            border: none;
            color: #fff;
            font-weight: 600;
        }
        .submenu{
            display: flex;
            width: 80%;
            flex-direction: row;
            justify-content: space-around;
            margin-top: 27px;
        }
        .submenu i{
            color: #FF7A00;
        }
       
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="topHeader"> 
            <a href="addPost.php">Back</a>
            <input type="submit" name="submit" class="postBtn" value="Plaats op feed">
        </div>
        <input type="text" name="gebruiker" value="zoek gebruiker"></input>
        <?php
        foreach ($usersTag as $user) {
            $userInfo = user::getUserById($user['match_id']);
            echo $user['match_id']."<br>";
        }


        ?>
        <div class="submenu">
            <div class="submenuItem">
                <a href="#"><i class="fa-solid fa-image fa-xl"></i></a>
            </div>
            <div class="submenuItem">
                <a href="/addPostTags.php?postId=62#"><i class="fa-solid fa-people-group fa-xl"></i></a>
            </div>
            <div class="submenuItem">
                <a href="#"><i class="fa-solid fa-location-dot fa-xl"></i></a>
            </div>
            <div class="submenuItem">
                <a href="#"><i class="fa-solid fa-face-grin fa-xl"></i></a>
            </div>
        </div>  
    </div>
  


</body>


<script>


</script>    
</body>
</html>
