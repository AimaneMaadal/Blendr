<?php 
  session_start();
  include_once "../classes/user.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: http://localhost/blendr2.0/match.php");
  }
  
  $id = $_GET['id'];
  $data = User::getUserById($id)[0];
  $tags = user::getCommonInterests($id);
  $tags2 = user::getCommonInterests($_SESSION['unique_id']);

  $common = array_intersect($tags, $tags2);
  $diff = array_diff($tags, $tags2);


  $commonShow = array_slice($common, 0, 3);


  $geo = user::getUserGeo($id);
  $geo2 = user::getUserGeo($_SESSION['unique_id']);
  
  $long1 = json_decode($geo)[1];
  $lat1 = json_decode($geo)[0];
  $long2 = json_decode($geo2)[1];
  $lat2 = json_decode($geo2)[0];

  $distance = distance($lat1, $long1, $lat2, $long2);

  function distance($lat1, $lon1, $lat2, $lon2) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    return round($miles * 1.609344);
  }

  function getAddress($latitude, $longitude)
{
        //google map api url
        $url = "https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=$latitude&longitude=$longitude&localityLanguage=nl";

        // send http request
        $geocode = file_get_contents($url);
        $json = json_decode($geocode, true);
        return $json['locality'];
}

function getEmoji($emoji){
  $emoji = user::getEmoji($emoji)[0]['emoji'];
  return substr_replace($emoji, "&#x", 0, 2);
}



  
  //compare 2 arrays and return the common values
  function compare($a, $b) {
    $result = array_intersect($a, $b);
    return $result;
  }
?>
<?php include_once "../header.php"; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blendr</title>
    <link rel="stylesheet" href="match.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        .profile-inner{
          margin-top: 20px;
        }
        .global-actions{
          margin-top: 210px;
          position: relative;
        }
        .divIntrests{
          width: 80%;
          background-color: white;
          margin: 22px auto;
          height: 70px;
          border-radius: 10px;
        }
        .divIntrests img{
          width: 32px;
          height: 32px;
          padding: 0px 6px;
          margin: 19px 0px 0px 15px;
          z-index: 1;
          position: relative;
          /* box-shadow: rgb(17 12 46 / 15%) 20px 48px 100px 10px; */
          border-radius: 50%;
          background-color: #ffdd84;
        }
        .divIntrests img:nth-child(2){
          margin-left: -13px;
          z-index: 0;
          position: relative;
        }
        .modal {
          margin: 5% auto;
          display: none;
          background-color: #ff0000;
          position: absolute;
          z-index: 3;
          width: 300px;
          bottom: 243px;
          height: 250px;
          left: 40px;
          border-radius: 10px;
          box-shadow: 0px 0px 1000px 80px #888888;
          overflow: auto;
        }

        /* Modal Content */
        .modal-content {
          background-color: #fefefe;
          margin: auto;
          padding: 20px;
          /* border: 1px solid #888; */
          width: 100%;
          height: 250px;
          overflow-y: scroll;
        }

        /* The Close Button */
        .close {
          color: #aaaaaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
          margin-top: -10px;
          position: absolute;
          right: 22px;
        }

        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }
        .tag {
          padding: 2px 7% 2px;
          border-radius: 50px;
          color: #001F3B;
          font-weight: bolder;
          border: 1px solid grey;
          margin: 5px;
          width: auto;
        }
        .tags{
          display: flex;
        }
        .distanceIndicator{
          float: left;
          margin-top: 14px;
          background-color: #FF7A00;
          padding: 5px 8px;
          border-radius: 4px;
          color: white;
          font-weight: 600;
          float: right;
          margin-right: 40px;
        }
        .commonDiv{
          float: left;
          background-color: white;
          padding: 6px 6px;
          font-size: 20px;
          margin: 15px 0px -40px 47px;
          border-radius: 20px;
          width: 40px;
          height: 40px;
          text-align: center;
          z-index: 3;
          box-shadow: 3px 4px 9px -6px rgb(0 0 0 / 25%);
        }
        .commonDiv:nth-child(1){
          margin-left: 50px;
        }
        .commonDiv:nth-child(2){
          margin-left: -57px;
        }
        .commonDiv:nth-child(3){
          margin-left: -77px;
        }
        .gallery-item{
          width: 126px;
          background-image: url(../php/images/food5.jpg);
          background-position: center;
          background-size: cover;
          height: 96px;
          border-radius: 14px;
        }.gallery{
          display: flex;
          flex-wrap: wrap;
          justify-content: flex-start;
          /* margin-top: 20px; */
          width: 80%;
          gap: 20px;
          margin: 0px auto;
        }
        .bottomNav{  
          position: sticky;
          background-color: rgb(255, 255, 255);
          /* bottom: 10; */
          width: 330px;
          height: 50px;
          border-radius: 10px;
          /* z-index: 5; */
          box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 50%);
          display: flex;
          justify-content: space-around;
          align-items: center;
          top: 749px;
        }
        .bottomNav div{
            width: 25px;
            height: 25px;
        }
        .bottomNav div img{
            width: 25px;
            height: 25px;
        }
    </style>  
<body>
<div class="wrapper">
    
<!-- echo json_decode($data["showcase"])[0];
        $img = "../php/images/show/".json_decode($data["showcase"])[0];     
        echo '<div class="banner" style="background-image:url(\'' .$img. '\'); background-position: center;  background-size: cover;" >ok</div>'; -->

    <?php
       //check if $data is not null
        if($data != null){
          //check if $data["showcase"] is not null
          if($data["showcase"] != null){
            //check if $data["showcase"] is not empty
            if(!empty($data["showcase"])){
              echo json_decode($data["showcase"])[0];
              $img = "../php/images/show/".json_decode($data["showcase"])[0];     
              echo '<div class="banner" style="background-image:url(\'' .$img. '\'); background-position: center;  background-size: cover;" >ok</div>';
            }
          }
        }
            
    ?>
<div class="global-actions">

      <a href="./index.php">
      <div class="left-action"><img src="../php/icons/like.svg"></img></div>
      </a>

  
  <div class="top-action" id="topButton"><img src="../php/icons/pot.svg"></img></div>
  <div class="right-action"><img src="../php/icons/dislike.svg"></img></div>
</div>
       <?php
        echo '<div class="profile-inner">
        <img src="../php/images/' .$data["img"]. '" alt="">  
        <div class="userInfo">
        <h3>' .$data["fname"].' '.$data["lname"].'</h3>
        '.getAddress($lat1, $long1).'
        </div>';
        echo '<div class="distanceIndicator">'.$distance.' Km</div>';
        echo '<br><br><br><br><br><h2>About</h2><p>'.$data["bio"].'</p>'

    ?>

    <div class="divIntrests">
        <?php
          if ($common) {
            foreach ($commonShow as $emoji) {
              echo "<div class='commonDiv'>".getEmoji($emoji)."</div>";
            }
            echo '<div class="intestsRight" style="width: 165px;float: left;margin: 5px 0px 0px 10px;""><br><span><b>'.count($common).'+ &nbsp</b> Gemeenschapelijke intresses</span>';
            echo "<br><button id='myBtn' style='background: none;border: none;><b style='color: orange;'>Zie meer</b></button></div>";
          }
          else {
            echo '<div class="intestsRight" style="width: 185px;float: left;margin: 5px 0px 0px 40px;""><br><span><b>Geen &nbsp</b> Gemeenschapelijke intresses</span>';
            echo "<br><button id='myBtn' style='background: none;border: none;><b style='color: orange;'>Zie meer intresses</b></button></div>";
          }
        ?>
    </div>

<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close">&times;</span>
  <h3>Gemeenschapelijke intresses</h3>
  <?php

    echo '<div class="tags">';
    foreach($common as $tag) {
      echo '<div class="tag">'.$tag.'</div>';
    }
    echo '</div>';
  ?>
  <br><br><h3>Verchillende intresses</h3>
  <?php

    echo '<div class="tags">';
    foreach($diff as $tag) {
      echo '<div class="tag">'.$tag.'</div>';
    }
    echo '</div>';
   ?> 



</div>




</div>
<br><br><h2>Gallery</h2><br><br>
<div class="gallery">
  <?php
    $imgs = json_decode($data["showcase"]);
    foreach ($imgs as $img) {
      $img = "../php/images/show/".$img;     
      echo '<div class="gallery-item" style="background-image:url(\'' .$img. '\'); background-position: center;  background-size: cover;">p</div>';
    }
  ?>
</div>


<br><br><br><br><br><br>
</div>

<div class="bottomNav">
      <div><img src="../php/icons/home.svg"></div>
      <div><img src="../php/icons/recepeten.svg"></div>
      <div><img src="../php/icons/match_fill.svg"></div>
      <div><img src="../php/icons/chat.svg"></div>
  </div>


    <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>

    
</body>
