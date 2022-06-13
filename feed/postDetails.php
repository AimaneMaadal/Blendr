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
    <style>
        .leftInner {
            height: 40px;
            float: left;
            width: 20%;
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
        .postInfo {
            display: block;
            margin-bottom: 10px;
            margin-top: 30px;
            flex-direction: row;
        }
        .topHeader {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 80%;
            margin: 0px auto;
            margin-top: 50px;
        }
        #commentInput{
            position: sticky;
            bottom: 21px;
            width: 75.2%;
            padding: 11.5px 10px;
            /* border-radius: 10px; */
            border: none;
            background: gainsboro;
            float: left;
            border-radius: 10px 0px 0px 10px;
            width: 84.9%;
        }
        #commentButton{
            position: sticky;
            float: right;
            bottom: 21px;
            right: 21px;
            height: 40px;
            border-radius: 0px 5px 5px 0px;
            width: 80px;
            background-color: #FF7A00;
            border: none;
            color: white;
            margin-top: -40px;
        }
        .comment{
            gap: 10px;
            display: flex;
            margin-top: 15px;
        }
        #comments{
            width: 80%;
            margin-top: 25px;
            overflow-y: scroll;
            height: 365px;
        }
        .profilePicPost {
            width: 25px;
            height: 25px;
            border-radius: 25px;
            z-index: 2;
            float: left;
            margin-right: 10px;
        }
    </style>
<body>
<div class="wrapper">
<div class="topHeader">
        <div><a href="index.php"><i class="fa-solid fa-chevron-left"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Post</b></div>
        <div><?php echo '<img class="profilePicPost" id="profilePicture" src="../php/images/' .User::getUserById($_SESSION["unique_id"])[0]["img"]. '" alt="">'; ?></div>
</div>   
    <?php
        $usersPost = json_decode($post["users"]);

        echo '<div class="post" style="margin-top: 44px;"><a  style="width: 80%;" href="postDetails.php?id='.$post["id"].'">';
        if (is_array($usersPost)) {
            echo '<div class="postInfo">';
            echo '<div class="leftInner">';
            for ($i=0; $i < count($usersPost); $i++) {
                echo '<img style="margin-right: 10px;" class="profilePicPost" id="profilePicture" src="../php/images/' .User::getUserById($usersPost[$i])[0]["img"]. '" alt="">';
            }
            echo '</div>';
            echo '<div class="rightInner">';
            echo '<div class="postTitle">';
            for ($i=0; $i < count($usersPost); $i++) {
                echo "<h4>".User::getUserById($usersPost[$i])[0]["fname"]."</h4>";
                if ($i<count($usersPost)-1) {
                    echo "<h4>&nbsp;en&nbsp;</h4>";
                }
            }
            echo '</div>';
            echo '<p style="margin-top: -19px;font-size: 10px;color: #858585;">'.time_elapsed_string($post["date"]).'</p>';
            
        }
        else {
            echo '<img class="profilePicPost" id="profilePicture" src="../php/images/' .User::getUserById($usersPost)[0]["img"]. '" alt="">';
            echo "<div class='rightInner' style='margin-left: 20px;'><h4 style='height: 15px;'>".User::getUserById($usersPost)[0]["fname"].' '.User::getUserById($usersPost)[0]["lname"]."</h4>";  
            echo '<p style="font-size: 10px; color: #858585;">'.time_elapsed_string($post["date"]).'</p></div>';
        }
        echo '</div>';
        echo '<img class="postImg" src="../php/images/posts/'.$post["post_img"]. '" alt="">';
        if (post::checkIfUserLikedPost($_SESSION["unique_id"], $post["id"])) {
            echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="liked">';
        }
        else{
            echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="disliked">';
        }
        echo '<input type="button" data-id="'.$post["id"].'" id="likeButton" class="share">';
        echo '</a>';
    ?>
    <div id="comments">

        <?php
            $comments = post::getCommentsByPostId($post["id"]);
            for ($i=0; $i < count($comments); $i++) { 
                echo '<div class="comment">';
                echo '<img class="profilePicComment" style="width: 30px;height: 30px;border-radius: 20px;" id="profilePicture" src="../php/images/' .User::getUserById($comments[$i]["userId"])[0]["img"]. '" alt="">';
                echo '<p>'.$comments[$i]["comment"].'</p>';
                echo '</div>';
            }
        ?>
    </div>
    <div class="commentInput" style="width: 80%;">
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


    
 


