<?php

session_start();

 

 
?>


<?php include_once "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
    <style>
        .image1{
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: block;
            border: none;
            border-radius: 10px;
            width: 31%;
            height: 56px;
            float: left;
            margin-top: 12px;
        }
        .image1:nth-child(1) {
            background-image: url("../php/images/show/food1.jpg");
            width: 100%;
            height: 160px;
            display: block;
        }
        .image1:nth-child(2) {
            background-image: url("../php/images/show/food2.jpg");
        }
        .image1:nth-child(3) {
            background-image: url("../php/images/show/food3.jpg");
        }
        .image1:nth-child(4) {
            background-image: url("../php/images/show/food4.jpg");
        }
        .image1:nth-child(5) {
            background-image: url("../php/images/show/food5.jpg");
        }
        .image1:nth-child(6) {
            background-image: url("../php/images/show/food6.jpg");
        }
        .image1:nth-child(7) {
            background-image: url("../php/images/show/food7.jpg");
        }
        .image1:nth-child(8) {
            background-image: url("../php/images/show/food8.jpg");
        }
        .image1:nth-child(9) {
            background-image: url("../php/images/show/food9.jpg");
        }
        .image1:nth-child(10) {
            background-image: url("../php/images/show/food10.jpg");
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
            margin: 25px auto;
        }
        #uploadImageDone {
            height: 45px;
            width: 100%;
            border: none;
            color: #fff;
            font-size: 17px;
            background: #FF7A00;
            border-radius: 15px;
            cursor: pointer;
            margin-top: 40px;
            font-weight: 600;
            margin-bottom: -15px;
        }
        #skipImage {
            height: 45px;
            width: 100%;
            color: #001F3B;
            font-size: 17px;
            background: #ffffff;
            border-radius: 15px;
            cursor: pointer;
            font-weight: 600;
            margin-top: -15px;
            border: 2px solid #001F3B;
        }

    </style>
</head>
<body>
    <div class="wrapper">


   
    <form action="" method="POST" enctype="multipart/form-data">
    <br><h1>Fotos uploaden</h1>
    <img src="../php/icons/step4.svg" style="width: 100%;margin: 20px 0px 20px 0px;">  
    <p>Kies fotos van jou gerechten die andere op je profiel pagina kunne bekijken</p>
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
            <input type="button" id="uploadImageDone" name="submit" value="Volgende">
            <img src="../php/icons/or.svg" style="width: 93%;margin: 22px -11px 22px 8px;"> 
            <input type="button" id="skipImage" name="submit" value="Skip"> 
        </div>
        
        

       

        
        
        
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
            url: "ajax/add_images.php",
            type: "POST",
            data: {images: myJSON},
            success: function(data){
                console.log(data);
                window.location.href = "../feed/index.php";
            }
        });
    }
});
$(document).on("click","#skipImage",function(){
    window.location.href = "../feed/index.php";
});

</script>    
</body>
</html>
