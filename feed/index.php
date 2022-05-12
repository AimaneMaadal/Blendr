<?php 
  session_start();
  include_once "../classes/post.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: http://localhost/blendr2.0/match.php");
  }
  
  $data = post::getAllPosts();


?>
<?php include_once "../header.php"; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blendr</title>
    <link rel="stylesheet" href="match.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/6ec6696b28.js" crossorigin="anonymous"></script>
    <style>
        .card-item{
            /* background-image: url("../php/images/food2.jfif"); */
        }
        .pop_up{
            background-color: #FFE6AE;
            margin-bottom: 58px;
            margin-top: -53px;
            width: 75%;
            height: 54px;
            border-radius: 16px;
        }
        .pop_up>div{
            background-color: white;
            width: 40px;
            height: 40px;
            margin: 7px 3px 3px 9px;
            border-radius: 12px;
        }
        .pop_up h3 {
            float: left;
            margin: -38px 0px 0px 66px;
            color: #001F3B;
        }
        .pop_up p {
            float: left;
            margin: -23px 0px 0px 66px;
            color: #001F3B;
        }
        .pop_up>div i{
            color: #FFDD27;
            margin: 20px 0px 0px 7px;
        }
        .pop_up i {
            color: #ffffff;
            margin: -22px 0px 0px 257px;
            float: left;
        }
        .profilePic {
            background: white;
            width: 45px;
            height: 45px;
            margin: -100px -138px 80px -30px;
            border-radius: 425px;
            float: right;
        }
        .menu {
            float: left;
            margin: -85px 0px 0px -142px;
        }
    </style>    
<body>
<div class="wrapper">

    
</div>
 


