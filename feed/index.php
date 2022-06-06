<?php 
  session_start();
  include_once "../classes/post.php";
  include_once "../classes/user.php";
//   if(!isset($_SESSION['unique_id'])){
//     header("location: http://localhost/blendr/match.php");
//   }
  
  $data = post::getAllPosts();

  $user = user::getuserById($_SESSION['unique_id']);

  function userToString($user){
    return $user[0]['fname'];
  }

  //var_dump(userToString($user));

  //function calculate difference between date and current date return days or minutes
    function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) {
            $string = array_slice($string, 0, 1);
        }
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

  

?>
<?php include_once "../header.php"; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feed</title>
    <link rel="stylesheet" href="feed.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/6ec6696b28.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .leftInner {
            width: auto;
            height: 40px;
        }
        .rightInner {
            display: flex;
            width: 70%;
            flex-direction: column;
        }
        .postTitle{
            display: flex;
            width: 120%;
        }
        .sidenav {
            height: 907px;
            width: 0;
            position: absolute;
            z-index: 10;
            top: 0;
            left: 0;
            background-color: #FF7A00;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            display: flex;
            /* text-align: center; */
            flex-direction: column;
            gap: 40px;
        }
        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
            color: white;
        }
        .sidenav a {
            margin-left: 50px;
            color: white;
            font-weight: 600;
        }

    </style>
<body>
<div class="wrapper">
    
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">Profile</a>
  <a href="#">Matches</a>
  <a href="#">offer and promo</a>
  <a href="#">Privacy policy</a>
  <a href="../php/logout.php?logout_id=<?php echo $_SESSION['unique_id'] ?>">Uitloggen</a>
</div>

    <div class="feed">
        <div class="topHeader">
            <img src="../php/icons/vector.svg" onclick="openNav()" alt="logo" class="menuVector">
            <?php echo'<img class="profilePic" id="profilePicture" data-id="'.$_SESSION["unique_id"].'" src="../php/images/' .$user[0]["img"]. '" alt="">'; ?>
        </div>  
            <?php
            foreach($data as $post){
                $usersPost = json_decode($post["users"]);

                echo '<div class="post"><a href="postDetails.php?id='.$post["id"].'">';
                    echo '<div class="postInfo">';
                    if(is_array($usersPost)){
                        echo '<div class="leftInner">';
                        for ($i=0; $i < count($usersPost); $i++) { 
                            echo '<img class="profilePicPost" id="profilePicture" src="../php/images/' .User::getUserById($usersPost[$i])[0]["img"]. '" alt="">';
                        }
                        echo '</div>';
                        echo '<div class="rightInner">';
                        echo '<div class="postTitle">';
                        for ($i=0; $i < count($usersPost); $i++) { 
                            echo "<h4>".User::getUserById($usersPost[$i])[0]["fname"].' '.User::getUserById($usersPost[$i])[0]["lname"]."</h4>";  
                            if ($i<count($usersPost)-1) {
                                echo "<h4>&nbsp;en&nbsp;</h4>";
                            }
                        }
                        echo '</div>';
                        echo '<p style="margin-top: -19px;font-size: 10px;color: #858585;">'.time_elapsed_string($post["date"]).'</p>';
                        echo '</div>';
                    }
                    else {
                        echo '<img class="profilePicPost" id="profilePicture" src="../php/images/' .User::getUserById($usersPost)[0]["img"]. '" alt="">';
                        echo "<div class='rightInner' style='margin-left: 20px;'><h4 style='height: 15px;'>".User::getUserById($usersPost)[0]["fname"].' '.User::getUserById($usersPost)[0]["lname"]."</h4>";  
                        echo '<p style="font-size: 10px; color: #858585;">'.time_elapsed_string($post["date"]).'</p></div>';
                    }
                    echo '</div>'; 
                echo '<img class="postImg" src="../php/images/posts/' .$post["post_img"]. '" alt=""></a>';
                if (post::checkIfUserLikedPost($_SESSION["unique_id"], $post["id"])) {
                    echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="liked">';
                }
                else{
                    echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="disliked">';
                
                }
                echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="share">';
            
                
                if(post::getLastCommentByPostId($post["id"]) != null){
                    echo '<p class="comment"><b>'.userToString(user::getUserById(post::getLastCommentByPostId($post["id"])[0]["userId"])).'</b>
                    <span style="color: #001f3b80;font-size: 15px;font-weight: 400;">'.post::getLastCommentByPostId($post["id"])[0]["comment"].'</span></p>';
                }
                echo '</div>';
            }
            ?>

</div>
        <nav class="menu">
        <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open" />
        <label class="menu-open-button" for="menu-open">
            <span class="lines line-1"></span>
            <span class="lines line-3"></span>
        </label>

        <a href="addPost.php" class="menu-item item1"><i class="fa-solid fa-image"></i></a>
        <a href="addPostCam.php" class="menu-item item2"><i class="fa-solid fa-camera"></i></i></a>
        <a href="#" class="menu-item item3"><i class="fa-solid fa-utensils"></i></a>
        </nav>

            <div class="bottomNav">
                <div><img src="../php/icons/home_fill.svg"></div>
                <div><a href="../recipes/index.php"><img src="../php/icons/Recepeten.svg"></a></div>
                <div><a href="../match/index.php"><img src="../php/icons/match.svg"></a></div>
                <div><a href="../users.php"><img src="../php/icons/chat.svg"></a></div>
            </div>
    </div>
</div>
<script>
$("#menu-open").change(function() {
    if ($(this).is(":checked")) {
        $('.feed').css("pointer-events","none");
        $('.feed').css('opacity', '0.6');
    }
    else{
        $('.feed').css('opacity', '1');
        $('.feed').css('pointer-events','auto');
    }
});

$(document).on("click","#likeButton",function(){
    var id = $(this).attr("data-id");
    var userId = $("#profilePicture").attr("data-id");
    //if hasclass delete class and add new class
    if ($(this).hasClass("liked")) {
        $(this).removeClass("liked");
        $(this).addClass("disliked");
    }
    else{
        $(this).removeClass("disliked");
        $(this).addClass("liked");
    }
    $.ajax({  
        url:"ajax/add_like.php",  
        method:"POST",  
        data:{
            id:id,
            userId:userId
        }, 
        success:function(data){ 
            console.log(data);
        } 
    }); 
 });



</script>
</body>


    
 


