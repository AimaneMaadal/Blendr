<?php 
  session_start();
  include_once "../classes/user.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: http://localhost/blendr2.0/match.php");
  }
  
  $id = $_GET['id'];
  $data = User::getUserById($id)[0];

?>
<?php include_once "../header.php"; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blendr</title>
    <link rel="stylesheet" href="match.css">
    <link rel="stylesheet" href="../style.css">
   
<body>
<div class="wrapper">
    
   

    <?php
    
        $img = "../php/images/".json_decode($data["showcase"])[0];     
        echo '<div class="banner" style="background-image:url(\'' .$img. '\'); background-position: center;  background-size: cover;" >ok</div>';
       
        echo '<div class="profile-inner">
        <img src="../php/images/' .$data["img"]. '" alt="">  
        <div class="userInfo">
        <h3>' .$data["fname"].' '.$data["lname"].'</h3>
        '.$data["date"].'
        </div>';
        echo '<br><br><br><br><br><h2>About</h2><p>De struikelende jongen rolde losjes omdat een of andere gangster ruw achter een deftige bloemist vloog die, een territoriale, elegante tandarts werd. De oogverblindende boer schopte alleen maar omdat een of andere krokodil snel boven een mollige schorpioen sloeg die, een lieflijke, zombie-achtige boer werd. </p>'

    
    ?>
    



    
</body>