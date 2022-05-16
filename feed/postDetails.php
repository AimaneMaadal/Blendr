<?php 
  session_start();
  include_once "../classes/post.php";
  include_once "../classes/user.php";
//   if(!isset($_SESSION['unique_id'])){
//     header("location: http://localhost/blendr/match.php");
//   }
  

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

    $post = post::getPostById($_GET['id']);
    $post = $post[0];
  

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
    <img src="../php/icons/vector.svg" alt="logo" class="menuButton">
    <?php echo'<img class="profilePic" id="profilePicture" data-id="'.$_SESSION["unique_id"].'" src="../php/images/' .$user[0]["img"]. '" alt="">'; ?>
</div>  
    <?php
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
        echo '<img class="postImg" src="../php/images/' .$post["post_img"]. '" alt="">';
        if (post::checkIfUserLikedPost($_SESSION["unique_id"], $post["id"])) {
            echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="liked">';
        }
        else{
            echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="disliked">';
        }
        echo '</a></div>';
    ?>
    <div id="comments">

        <?php
            $comments = post::getCommentsByPostId($post["id"]);
            for ($i=0; $i < count($comments); $i++) { 
                echo '<div class="comment">';
                echo '<img class="profilePicComment" style="width: 30px;height: 30px;" id="profilePicture" src="../php/images/' .User::getUserById($comments[$i]["userId"])[0]["img"]. '" alt="">';
                echo '<p>'.User::getUserById($comments[$i]["userId"])[0]["fname"].'</p>';
                echo '<p>'.$comments[$i]["comment"].'</p>';
                echo '</div>';
            }
        ?>
        <input type="text" id="commentInput" placeholder="Add a comment...">
        <input type="button" id="commentButton" value="Comment">
    </div>


</div>
</div>
<script>

$(document).on("click","#commentButton",function(){
    var input = $("#commentInput").val();
    if (input.length>0) {
        $.ajax({  
        url:"ajax/add_comment.php",  
        method:"POST",  
        data:{
            id: <?php echo $_SESSION["unique_id"] ?> ,
            post_id: <?php echo $_GET["id"] ?>,
            comment:input
        }, 
        success:function(data){ 
            console.log(data);
            $('#comments').prepend(data);
        } 
        }); 
        $("#commentInput").val("");
    }     
});
</script>
</body>


    
 


