<?php

session_start();
 $_SESSION['unique_id'];
 
//database connection
$conn = mysqli_connect("localhost", "root", "usbw", "chatapp");

// Check if form was submitted
if(isset($_POST['submit'])) {
 
    // Configure upload directory and allowed file types
    $upload_dir = 'php/images/';
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
     
    // Define maxsize for files i.e 2MB
    $maxsize = 2 * 1024 * 1024;
 
    // Checks if user sent an empty form
    if(!empty(array_filter($_FILES['files']['name']))) {
 
        // Loop through each file in files[] array
        foreach ($_FILES['files']['tmp_name'] as $key => $value) {
             
            $file_tmpname = $_FILES['files']['tmp_name'][$key];
            $file_name = $_FILES['files']['name'][$key];
            $file_size = $_FILES['files']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
 
            // Set upload file path
            $filepath = $upload_dir.$file_name;
 
            // Check file type is allowed or not
            if(in_array(strtolower($file_ext), $allowed_types)) {
 
                // Verify file size - 2MB max
                if ($file_size > $maxsize)        
                    echo "Error: File size is larger than the allowed limit.";
 
                // If file with name already exist then append time in
                // front of name of the file to avoid overwriting of file
                if(file_exists($filepath)) {
                    $filepath = $upload_dir.time().$file_name;
                     
                    if( move_uploaded_file($file_tmpname, $filepath)) {
                       

                        echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        echo "Error uploading {$file_name} <br />";
                    }
                }
                else {
                 
                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        echo "Error uploading {$file_name} <br />";
                    }
                }
            }
            else {
                 
                // If file extension not valid
                echo "Error uploading {$file_name} ";
                echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
      var_dump(json_encode($_FILES['files']["name"]));
      $imageJson = json_encode($_FILES['files']["name"]);
      $filepath = json_encode($filepath);
      $sql = "UPDATE users SET showcase = '$imageJson' WHERE unique_id = '".$_SESSION['unique_id']."'";
      $result = mysqli_query($conn, $sql);
    }
    else {
         
        // If no files selected
        echo "No files selected.";
    }

}
if(!empty($_POST['uploadImageSelect'])){

    echo "uploadImageSelect";

}
 
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
    <style>
        .image1{
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: block;
            border: none;
            border-radius: 10px;
            width: 30%;
            height: 70px;
            float: left;
            margin-top: 15px;
        }
        .image1:nth-child(1) {
            background-image: url("../php/images/food1.jfif");
            width: 100%;
            height: 200px;
            display: block;
        }
        .image1:nth-child(2) {
            background-image: url("../php/images/food2.jfif");
        }
        .image1:nth-child(3) {
            background-image: url("../php/images/food6.jfif");
        }
        .image1:nth-child(4) {
            background-image: url("../php/images/food4.jpg");
        }
        .image1:nth-child(5) {
            background-image: url("../php/images/food5.jpg");
        }
        .image1:nth-child(6) {
            background-image: url("../php/images/food2.jfif");
        }
        .image1:nth-child(7) {
            background-image: url("../php/images/food2.jfif");
        }
        .image1:nth-child(8) {
            background-image: url("../php/images/food6.jfif");
        }
        .image1:nth-child(9) {
            background-image: url("../php/images/food4.jpg");
        }
        .image1:nth-child(10) {
            background-image: url("../php/images/food5.jpg");
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
        input:last-child {
            height: 45px;
            width: 100%;
            border: none;
            color: #fff;
            font-size: 17px;
            background: #FF7A00;
            border-radius: 15px;
            cursor: pointer;
            margin-top: 13px;
            font-weight: 600;
        }
        .fileChoice{
            display: flex;
            justify-content: space-around;
            margin-top: 167px;
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

    </style>
</head>
<body>
    <div class="wrapper">


   
    <form action="" method="POST" enctype="multipart/form-data">
    <h1>Fotos uploaden</h1><br><br><br>
      <p>Kies fotos van jou gerechten die andere op je profiel pagina kunne bekijken</p>
        <div class="food">
            <input type="button" data-id="food1.jfif" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food2.jfif" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food6.jfif" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food5.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food2.jfif" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food2.jfif" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food2.jfif" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food6.jfif" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food4.jpg" id="uploadImage" class="image1"></input>
            <input type="button" data-id="food5.jpg" id="uploadImage" class="image1"></input>
            <input type="button" id="uploadImageDone" name="submit" value="Volgende">
        </div>
        
        <div class="fileChoice">
            <a href="addPost.php" style="font-weight: 700;color: #FF7A00;">Galery</a>
            <a href="addPostCam.php">Camera</a>
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
        alert("cant be empty");  
    }
    else{
        const myJSON = JSON.stringify(z);
        alert(myJSON);
        $.ajax({
            url: "ajax/add_images.php",
            type: "POST",
            data: {images: myJSON},
            success: function(data){
                console.log(data);
                window.location.href = "addPostDescription.php?postId=" + data;
            }
        });
    }
});

</script>    
</body>
</html>
