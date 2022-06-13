<?php
include_once "../classes/user.php";
include_once "../classes/config.php";
session_start();
$id = $_SESSION['unique_id'];
 



$user = user::getUserById($_SESSION['unique_id']);


if (isset($_POST['uploadAbout'])) {
    try {
        if (empty($_POST['about'])) {
            $error = "Please enter your about";
        }
        $about = $_POST['about'];
        $sql = "UPDATE `users` SET `bio` = '$about' WHERE `users`.`unique_id` = $id;";
        $conn = Db::getInstance();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("Location: signup4.php");
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }

}




?>


<?php include_once "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blendr</title>
    <style>
       
       .profilePic {
            width: 140px;
            height: 140px;
            margin: 30px auto;
            display: block;
            border-radius: 50%;
        }
        .aboutInput{
            width: 100%;
            font-size: 12px;
            padding: 10px 10px;
            border-radius: 10px;
            background-color: #ECECEC;
            height: 40px;
            border: none;
            color: #001F3C;
            font-weight: 600;
            height: 200px;
            margin-top: 10px;
        }
        .uploadAbout{
            height: 45px;
            width: 100%;
            display: block;
            border: none;
            color: #fff;
            font-size: 17px;
            background: #FF7A00;
            border-radius: 15px;
            cursor: pointer;
            margin-top: 80px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="wrapper">

    <h1 style="align-self: start;margin: 30px 0px 0px 45px;">Sign up</h1>
    <img src="../php/icons/step3.svg" style="width: 80%;margin: 20px 0px 20px -15px;">
    <p style="width: 80%;">We are are almost done, how would friends or family describe you. type a bio about yourself in 50 words.</p>   <br>
   
    <img src="../php/images/<?php echo $user[0]["img"] ?>" class="profilePic">

    <form style="width: 80%;" action="" method="POST" enctype="multipart/form-data">
    <div class="error-text"><?php 
    if (isset($error)) {
        echo $error;
    }
    ?></div> 
    <textarea class="aboutInput" placeholder="write something about yourself" name="about"></textarea>

       

        
        <input type="submit" name="uploadAbout" value="Continue" class="uploadAbout" />
        
    </form>
    
    
    </div>


<script>
var z = [];
$(document).on("click","#uploadImage",function(){
    if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        z.splice($.inArray($(this).data('id'), z), 1);
     }
     else{
        $(this).addClass("active");
        z.push($(this).data('id'));
     }
     console.log(z);
}); 

$(document).on("click","#uploadImageDone",function(){
    if (z == "") {
        // alert();  
    }
    else{
        const myJSON = JSON.stringify(z);
        // alert(myJSON);
        $.ajax({
            url: "ajax/add_about.php",
            type: "POST",
            data: {images: myJSON},
            success: function(data){
                console.log(data);
                window.location.href = "signup3.php";
            }
        });
    }
});

</script>    
</body>
</html>
