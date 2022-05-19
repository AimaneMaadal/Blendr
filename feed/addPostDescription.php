<?php

include_once("../classes/post.php");
session_start();

 
$postId = $_GET['postId'];

if (isset($_POST['submit'])) {
    $description = $_POST['postDescription'];
    post::updateDescription($postId, $description);
    header('Location: index.php');
}


 
$post = Post::getPostById($postId)[0];

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
        .topHeader{
            width: 100%;
        }
        form{
            width: 80%;
            margin: 0 auto;
            display: block;
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


   
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="topHeader"> 
            <a href="addPost.php">Back</a>
            <input type="submit" name="submit" class="postBtn" value="Plaats op feed">
        </div>
        <div class="postImg" style="background-image: url(../php/images/posts/<?php echo $post["post_img"] ?>);"></div>
        
        <textarea name="postDescription" name="textArea" cols="30" rows="10" placeholder="Beschrijf de post"></textarea> 
    </form>
    <div class="submenu">
            <div class="submenuItem">
                <a href="#"><i class="fa-solid fa-image fa-xl"></i></a>
            </div>
            <div class="submenuItem">
                <?php echo  '<a href="addPostTags.php?postId='.$_GET["postId"].'"><i class="fa-solid fa-people-group fa-xl"></i></a>'; ?>      
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
