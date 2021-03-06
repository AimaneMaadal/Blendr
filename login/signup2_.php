<?php

session_start();
echo $_SESSION['unique_id'];
 
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


<?php include_once "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .image1{
            width: 80%;
            background-image: url("php/images/food1.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 200px;
            margin: 0 auto;
            display: block;
            border: none;
            border-radius: 10px;
        }
        form{
            width: 100%;
        }
        .active{
            border: 100px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="wrapper">
  <!-- multipart/form-data ensures that form
    data is going to be encoded as MIME data -->


    <form action="" method="POST" enctype="multipart/form-data">
        <h2>Upload Files</h2>
            <input type="file" name="files[]" multiple>
            <br><br>
            <input type="submit" name="submit" value="Upload" >
        </p>
    </form>
    </div>
    
</body>
</html>
