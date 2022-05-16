<?php 
  session_start();
  if (isset($_SESSION['unique_id'])) {
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
    input {
        height: 45px;
        border: none;
        color: red;
        font-size: 17px;
        background: #ffffff;
        border-radius: 15px;
        cursor: pointer;
        margin-top: 737px;
        font-weight: 600;
        width: 80%;
        /* bottom: 0; */
    }
    .wrapper{
        background-image: url("php/icons/start.svg");
    }

    
  </style>
</head>
<script src="https://kit.fontawesome.com/6ec6696b28.js" crossorigin="anonymous"></script>
<body>
  <div class="wrapper">
      
        <input type="button"  onclick="location.href='login/signup.php';"  name="submit" value="Volgende">
  </div>

  
</body>
</html>


