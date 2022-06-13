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
        .bottomNav {
    position: absolute;
    background-color: rgb(255, 255, 255);
    bottom: 25px;
    left: 25px;
    width: 330px;
    height: 50px;
    border-radius: 10px;
    z-index: 5;
    box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 50%);
    display: flex;
    justify-content: space-around;
    align-items: center;
}
.bottomNav div{
    width: 25px;
    height: 25px;
}
.bottomNav div img{
    width: 25px;
    height: 25px;
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
.feed{
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
 
  height: 100%;
  padding-top: 60px;
  background-color: #f2f2f2;
  width: 100%;
  padding-left: 15%;
  padding-right:15%;

}
.wrapper{
  padding: 0;
  margin: 0;
  overflow: hidden;

}
.topHeader, .users, .search{
  padding: 0;
  margin: 0;
  width: 100%;
}
.sidenav {
    height: 907px;
    width: 0;
    position: absolute;
    z-index: 0;
    top: 0;
    left: 0;
    background-color: #FF7A00;
    opacity: 0;
    transition: 0.5s;
    padding-top: 60px;
 
    display: flex;
    /* text-align: center; */
    flex-direction: column;
    
    visibility: hidden;
    
    white-space: nowrap;
    
}
.sidenav .closebtn {
    position: absolute;
    top: 175px;
    right: 0;
    font-size: 36px;
    margin-left: 50px;
    color: white;
    background-color: #f2f2f2;
    width: 40%;
    height: 500px;
    opacity: 0;

}
.sidenav a {
    margin-left: 70px;
    color: white;
    font-weight: 600;
    font-size: 20px;
    border-bottom: 1px solid rgb(255, 255, 255, 0.3);
    width: 35%;
    padding: 25px 0px;
   
    display: inline-block;
}
.sidenav a i{
    margin-right: 10px;
    margin-left: -30px;
    color: white;


}
.sidenav a:last-child{
    border-bottom: none;
    margin-top: 200px;
    margin-left: 35px;
    align-items: center;
}
.sidenav a:last-child i{

    margin-left: 10px;
    color: white;

}
.sidenav_logo{
    font-family: "Source Sans Pro";
    font-weight: bolder;
    font-size: 30px;
    color: white;
    margin-left: 35px;
    margin-bottom: 45px;
    align-items: center;

}
.post{
   width: 120%;
   margin-left: -10%;
}
.post .postImg{
    width: 100%;
    height: auto;
}
.menu{
    opacity: 1;
    visibility: visible;
}

    </style>
<body>
<div class="wrapper">
    
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="sidenav_logo"><img src="../php/images/assets/logo2.png"></div>
  <a href="../profile.php"><i class="fa-regular fa-circle-user"></i>Profile</a>
  <a href="#"><i class="fa-regular fa-handshake"></i>Matches</a>
  <a href="#"><i class="fa-solid fa-tag"></i>Offer and promo</a>
  <a href="#"><i class="fas fa-shield-alt"></i>Privacy policy</a>

  <a href="../php/logout.php?logout_id=<?php echo $_SESSION['unique_id'] ?>">Sign out<i class="fa-solid fa-arrow-right"></i></a>
  
</div>

    <div class="feed">
        <div class="topHeader">
           <img src="../php/icons/vector.svg" onclick="openNav()" alt="logo" class="menuVector">
            <?php echo' <a href="../profile.php"><img class="profilePic" id="profilePicture" data-id="'.$_SESSION["unique_id"].'" src="../php/images/' .$user[0]["img"]. '" alt=""></a>'; ?>
        </div>  
            <?php
            
            $data = array_reverse($data);
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
                <div><a href="../recipes/index.php"><img src="../php/icons/recepeten.svg"></a></div>
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

 function openNav() {
  let container =  document.querySelector(".feed");
  document.getElementById("mySidenav").style.visibility = "visible";
  document.getElementById("mySidenav").style.width = "100%";
  document.getElementById("mySidenav").style.overflow = "hidden";
  document.getElementById("mySidenav").style.opacity = "1";
  document.querySelector(".bottomNav").style.marginBottom = "0px";
  container.style.transform = "scale(0.55)";
  document.querySelector(".bottomNav").style.transform = "scale(0.55)";
  container.style.position = "relative";
  document.querySelector(".bottomNav").style.position = "relative";
  container.style.left = "165px";
  document.querySelector(".bottomNav").style.left = "165px";
  document.querySelector(".bottomNav").style.bottom = "230px";
  container.style.zIndex = "200";
  document.querySelector(".bottomNav").style.zIndex = "200";
  document.querySelector(".menu").style.opacity = 0;
  document.querySelector(".menu").style.visibility = "hidden";
  container.style.backgroundColor = "#F2F2F2";
  container.style.pointerEvents = "none"; 
  container.style.paddingBottom = "120px";
  container.style.borderRadius = "25px";
  container.style.boxShadow = "-35px 35px rgb(255,255,255,0.36)";
  
}

function closeNav() {
    // revert back to normal
    let container =  document.querySelector(".feed");
    document.getElementById("mySidenav").style.visibility = "hidden";
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mySidenav").style.overflow = "hidden";
    document.getElementById("mySidenav").style.opacity = "0";

    document.querySelector(".bottomNav").style.marginBottom = "0px";
    container.style.transform = "scale(1)";
    document.querySelector(".bottomNav").style.transform = "scale(1)";
    container.style.position = "relative";
    document.querySelector(".bottomNav").style.position = "absolute";
    container.style.left = "0px";
    document.querySelector(".bottomNav").style.left = "25px";
    document.querySelector(".bottomNav").style.bottom = "25px";
    container.style.zIndex = "0";
    document.querySelector(".bottomNav").style.zIndex = "0";
    document.querySelector(".menu").style.opacity = 1;
  document.querySelector(".menu").style.visibility = "visible";
    container.style.backgroundColor = "white";

    container.style.pointerEvents = "all";
    container.style.paddingBottom = "45%";
    container.style.borderRadius = "0px";
    container.style.boxShadow = "none";
    container.onclick = "";
    container.style.cursor = "default";
}

</script>
</body>


    
 


