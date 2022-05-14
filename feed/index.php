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
    <title>Blendr</title>
    <link rel="stylesheet" href="feed.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/6ec6696b28.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<body>
<div class="wrapper">
<div class="topHeader">
    <img src="../php/icons/vector.svg" alt="logo" class="menu">
    <?php echo'<img class="profilePic" id="profilePicture" data-id="'.$_SESSION["unique_id"].'" src="../php/images/' .$user[0]["img"]. '" alt="">'; ?>
</div>  
    <?php
    foreach($data as $post){
        $usersPost = json_decode($post["users"]);

        echo '<div class="post"><a href="postDetails.php?id='.$post["id"].'">';
            echo '<div class="postInfo">';
            for ($i=0; $i < count($usersPost); $i++) { 
                echo '<img class="profilePicPost" id="profilePicture" src="../php/images/' .User::getUserById($usersPost[$i])[0]["img"]. '" alt="">';
            }
            for ($i=0; $i < count($usersPost); $i++) { 
                echo "<h4>".User::getUserById($usersPost[$i])[0]["fname"]."</h4>";  
                if ($i<count($usersPost)-1) {
                    echo "<h4>&nbsp;en&nbsp;</h4>";
                }
            }
            echo '</div>';
            echo '<p style="margin: -21px 0px 12px 48px;font-size: 11px;color: grey;font-weight: 500;">'.time_elapsed_string($post["date"]).'</p>';
        echo '<img class="postImg" src="../php/images/' .$post["post_img"]. '" alt=""></a>';
        if (post::checkIfUserLikedPost($_SESSION["unique_id"], $post["id"])) {
            echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="liked">';
        }
        else{
            echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="disliked">';
        }
        echo '<input type="button" class="share">';
        
        if(post::getLastCommentByPostId($post["id"]) != null){
            echo '<p class="comment"><b>'.user::getUserById(post::getLastCommentByPostId($post["id"])[0]["userId"])[0]["fname"].'</b>
            <span style="color: #001f3b80;font-size: 15px;font-weight: 400;">'.post::getLastCommentByPostId($post["id"])[0]["comment"].'</span></p>';
        }
        echo '</div>';
    }
    ?>
    <div class="bottomNav">
        <div><img src="../php/icons/home_fill.svg"></div>
        <div><img src="../php/icons/Recepeten.svg"></div>
        <div><img src="../php/icons/match.svg"></div>
        <div><img src="../php/icons/chat.svg"></div>
    </div>
    <div><img src="../php/icons/add.svg" class="addPost" style="position: fixed;bottom: 150px;width: 60px;margin-left: 108px;"></div>
   


</div>
</div>
<script>

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


    
 


