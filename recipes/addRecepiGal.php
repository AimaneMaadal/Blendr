<?php

session_start();
 $_SESSION['unique_id'];
 
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
        .image1{
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: block;
            border: none;
            border-radius: 10px;
            width: 32%;
            height: 75px;
            float: left;
            margin-top: 7px;
        }
        .image1:nth-child(1) {
            background-image: url("../php/images/recepis/food1.jpg");
            width: 100%;
            height: 200px;
            display: block;
        }
        .image1:nth-child(2) {
            background-image: url("../php/images/recepis/food2.jpg");
        }
        .image1:nth-child(3) {
            background-image: url("../php/images/recepis/food3.jpg");
        }
        .image1:nth-child(4) {
            background-image: url("../php/images/recepis/food4.jpg");
        }
        .image1:nth-child(5) {
            background-image: url("../php/images/recepis/food5.jpg");
        }
        .image1:nth-child(6) {
            background-image: url("../php/images/recepis/food6.jpg");
        }
        .image1:nth-child(7) {
            background-image: url("../php/images/recepis/food7.jpg");
        }
        .image1:nth-child(8) {
            background-image: url("../php/images/recepis/food8.jpg");
        }
        .image1:nth-child(9) {
            background-image: url("../php/images/recepis/food9.jpg");
        }
        .image1:nth-child(10) {
            background-image: url("../php/images/recepis/food10.jpg");
        }
        .image1:nth-child(11) {
            background-image: url("../php/images/recepis/food11.jpg");
        }
        .image1:nth-child(12) {
            background-image: url("../php/images/recepis/food12.jpg");
        }
        .image1:nth-child(13) {
            background-image: url("../php/images/recepis/food13.jpg");
        }
        .image1:nth-child(14) {
            background-image: url("../php/images/recepis/food14.jpg");
        }
        .image1:nth-child(15) {
            background-image: url("../php/images/recepis/food15.jpg");
        }
        .image1:nth-child(16) {
            background-image: url("../php/images/recepis/food16.jpg");
        }


        form{
            width: 80%;

        }
        .active{
            outline: 3px solid orange;
        }
        h1{
            float: left;
        }
        .food{
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 0 auto;
        }

        .fileChoice{
            display: flex;
            justify-content: space-around;
            margin-top: 58px;
        }
        .fileChoice a:first-child{
            font-weight: 600px;
        }
        .activeChoice{
            border-bottom: 3px solid #FF7A00;
            height: 15px;
            width: 160px;
            text-align: center;
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
        <div><i class="fa-solid fa-chevron-left fa-lg">&nbsp&nbsp&nbsp&nbsp&nbsp</i><b>Gallery</b> <i class="fa-solid fa-chevron-down"></i></div>
        <div><label><i class="fa-solid fa-arrow-right fa-lg" style="color: #F0A500;"></i><input type="button" id="uploadImageDone" name="submit" value="Volgende" style="display: none;"></label></div>
    </div>  
        <div class="food">
            <input type="button" data-id="food1.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food2.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food3.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food4.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food5.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food6.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food7.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food8.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food9.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food10.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food11.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food12.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food13.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food14.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food15.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food16.jpg" id="uploadImage" class="image1"></input>
            
            
        </div>
        
        <div class="fileChoice">
            <a href="addRecepiGal.php" style="font-weight: 700;color: #FF7A00;">Gallery</a>
            <a href="addRecepiCam.php">Camera</a>
        </div>
        <div class="activeChoice"></div>

       

        
        
        
    </form>
    
    
    </div>


<script>
var z = [];
$(document).on("click","#uploadImage",function(){
    if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        z.splice($.inArray($(this).data('id'), z), 1);
     }
     else if(z.length < 1){
        $(this).addClass("active");
        z.push($(this).data('id'));
     }
     console.log(z);
}); 

$(document).on("click","#uploadImageDone",function(){
    if (z == "") {
        // alert("cant be empty");  
    }
    else{
        const myJSON = JSON.stringify(z);
        // alert(myJSON);
        $.ajax({
            url: "ajax/add_images.php",
            type: "POST",
            data: {images: myJSON},
            success: function(data){
                console.log(data);
                window.location.href = "addRecepi.php?recepiId=" + data;
            }
        });
    }
});

</script>    
</body>
</html>
