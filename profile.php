<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login/index.php");
  }
  include_once "classes/user.php";
  
  $user = user::getuserById($_SESSION['unique_id']);

?>
<?php include_once "./header.php"; ?>

<head>
  <style>
    .wrapper{
        background-color: #f2f2f2;
    }
    .header{
        font-weight: bold;
    }
    .container{
        margin-top: 10px;
    
        margin-top: 35%;
    }
    .userDataHeader{
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 18px;
    }
    .userData{

        padding: 15px;
    
        display: flex;
      
        overflow: hidden;
        margin-top: 15px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        margin-bottom: 30px;
     
    }
    .userImg{
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 15px;
    }
    .underline{
        border-bottom: 1px solid rgb(0, 31, 59, 0.5);
        
    }
    .userInfo h5{
        padding: 10px 0px;
        color: rgb(0, 31, 59, 0.5);
        font-weight: 600;
    }
    .extra{
        padding: 15px;
    
    display: flex;
  
    overflow: hidden;
    margin-top: 15px;
    background-color: white;
    border-radius: 20px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    justify-content: space-between;
    /* center */
    align-items: center;
    font-weight: bold;
    padding-left: 20px;
    }
    .edit{
        color: #FF7A00;
    }
  </style>
</head>
<body>
<div class="wrapper">


    <section class="form">
    <div class="header">
        <a href="feed/index.php">    <i class="fas fa-arrow-left"></i> &nbsp; &nbsp;&nbsp; Profiel</a>
    </div>
    <div class="container">
        <div class="userDataHeader">
        <h6>Persoonlijke gegevens</h6>
        <a href="edit/index.php">     <h6  class="edit">Bewerken</h6></a>
        </div>
        <div class="userData">
           <div class="imgBox">
           <?php 
            //echo the profile image of the session user
           echo'<img class="userImg"data-id="'.$_SESSION["unique_id"].'" src="./php/images/' .$user[0]["img"]. '" alt="">';
           
            ?>
         
           </div>
         <div class="userInfo">
         <h3><?php echo $user[0]["fname"]." ".$user[0]["lname"];?></h3>
         <h5 class="underline"><?php echo $user[0]["email"];?></h5>
         <h5 class="underline"><?php 
            //get geo from user and explode it into lat and long
            $geo = explode(",", $user[0]["geo"]);
            $lat = $geo[0];
            $long = $geo[1];
     
            $url = "https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=$lat&longitude=$long[1]&localityLanguage=nl";
            $geocode = file_get_contents($url);
            $json = json_decode($geocode, true);
            echo $json['locality'];



         ?></h5>
         <h5>
            <?php 
            //print user bio
            echo $user[0]["bio"];
            ?>
         </h5>
         </div>
  
        </div>
        <div class="extra">
            <!-- print a link and awesome icon right arrow -->
            <a href="#">Matches geschiedenis</a>
            <i class="fas fa-arrow-right"></i>
         </div>
         <div class="extra">
            <!-- print a link and awesome icon right arrow -->
            <a href="#">Betaalmethodes</a>
            <i class="fas fa-arrow-right"></i>
         </div>
         <div class="extra">
            <!-- print a link and awesome icon right arrow -->
            <a href="#">Faq</a>
            <i class="fas fa-arrow-right"></i>
         </div>
         <div class="extra">
            <!-- print a link and awesome icon right arrow -->
            <a href="#">Help</a>
            <i class="fas fa-arrow-right"></i>
         </div>
    </div>
  
    </section>
  
  </div>
  </div>

  <script>

  </script>

</body>
</html>
