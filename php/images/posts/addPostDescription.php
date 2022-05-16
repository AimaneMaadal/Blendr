<?php

include_once("../classes/post.php");
session_start();

 
//database connection
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");

// Check if form was submitted
if (isset($_POST['submit'])) {
    $description = $_POST['postDescription'];
    echo $description;

}

$postId = $_GET['postId'];
 
$post = Post::getPostById($postId)[0];

var_dump($post["post_img"]);
 
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
    <style>
        .postImg{
            width: 100%;
            height: 300px;
            margin: 10px auto;
            margin-top: -10px;
            display: block;
            border-radius: 10px;
        }
        textarea{
            width: 100%;
            height: 300px;
            margin: 20px auto;
            display: block;         
            font-size: 12px;
            padding: 0 10px;
            border-radius: 10px;
            background-color: #ECECEC;
            border: none;
            color: #001F3C;
            font-weight: 600;
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
        .topHeader{
            width: 100%;
        }
       
    </style>
</head>
<body>
    <div class="wrapper">


   
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="topHeader"> 
            <a href="addPost.php">Back</a>
            <input type="submit" name="submit" class="postBtn" value="Plaats op feed">
        </div>
        <img src="../php/images/posts/<?php echo $post['post_img'] ?>" class="postImg">
        <textarea name="postDescription" name="textArea" cols="30" rows="10" placeholder="Beschrijf de post"></textarea>
    </form>
    
    
    </div>


<script>


</script>    
</body>
</html>
