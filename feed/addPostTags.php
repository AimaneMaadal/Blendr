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
// var_dump($usersTag[0]['match_id']);
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
        input[type=checkbox]{
            float: right;
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
        .submenu {
            display: flex;
            width: 100%;
            flex-direction: row;
            justify-content: space-around;
            position: sticky;
            bottom: 0px;
            bottom: 10;
            background-color: #F2F2F2;
            align-items: center;
            height: 60px;
            border-radius: 10px;
            padding: 32px 10px;
        }
        .submenu i{
            color: #FF7A00;
        }
        .user{
            width: 80%;
            margin-top: 27px;
        }
        .user img{
            width: 40px;
            height: 40px;
            border-radius: 50%;
            float: left;
        }
        .user p{
            margin-left: 50px;
            margin-top: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #001F3C;
            display: block;
        }
       
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="topHeader"> 
            <input type="button" id="back" value="back"></input>
           
        </div>
        <input type="text" name="gebruiker" value="zoek gebruiker"></input>
        <?php
        foreach ($usersTag as $user) {
            $userInfo = user::getUserById($user['match_id']);
            echo "<div class='user'>";
            echo '<img class="profilePicPost" id="profilePicture" src="../php/images/' .$userInfo[0]["img"]. '" alt="">'; 
            echo "<p>" .$userInfo[0]["fname"]." ".$userInfo[0]["lname"]."</p>";
            echo '<input data-id="'.$userInfo[0]["unique_id"].'" type="checkbox" id="checkbox" />';
            echo '</div>';               
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
    var z = ["<?php echo $_SESSION["unique_id"] ?>"];
    $(document).on("change","#checkbox",function(){
        if ($(this).is(':checked')) {
            if (z.length < 3) {
                z.push($(this).data("id"));
            }
            else{
                alert("You can only select 3 users");
                $(this).prop("checked", false);
            }
        }
        else {
            z.splice(z.indexOf($(this).data("id")), 1);
        }
        console.log(z);



    });
    $(document).on("click","#back",function(){
        if (z == "") {
        alert("cant be empty");  
    }
    else{
        const myJSON = JSON.stringify(z);
        const id = <?php echo $_GET["postId"]; ?>;
        alert(myJSON);
        $.ajax({
            url: "ajax/add_users.php",
            type: "POST",
            data: {
                users: myJSON,
                postId: id
            },
            success: function(data){
                console.log(data);
                window.location.href = "addPostDescription.php?postId=<?php echo $_GET["postId"]; ?>";
            }
        });
    }
    });

</script>    
</body>
</html>
