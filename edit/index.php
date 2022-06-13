<?php 
  session_start();
  include_once "../php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../login/index.php");
  }
  include_once "../classes/user.php";
  
  $user = user::getuserById($_SESSION['unique_id']);

?>
<?php include_once "../header.php"; ?>

<head>
  <link rel="stylesheet" href="../style.css">
  <style>
    .wrapper{
        background-color: #f2f2f2;
    }
    .header{
        font-weight: bold;
    }
    .container{
        margin-top: 10px;
       
        margin-top: 15px;
    }
    .userDataHeader{
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 18px;
    }
    .userData{
        display: flex;
        flex-direction: row;
        margin-top: 25px;
    
   
    }
    .userImg{
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-right: 15px;
        
    }
    .imgBox{
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .userInfo{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
      
        align-items: center;
        text-align: center;
        justify-content: space-between;
    }
    .userInfo input, .userInfo select{
        padding: 10px;
        border: none;
        background-color: #ebebeb;
        margin-bottom: 10px;
        border-radius: 10px;
        font-weight: bold;
    }
    .update{
        background-color: #FF7A00;
        color: white;
        border: none;
        padding: 15px 25px;
        border-radius: 10px;
        font-weight: bold;
        margin-top: 10px;
        width: 100%;
    }
    
 
  </style>
</head>
<body>
<div class="wrapper">


    <section class="form">
    <div class="header">
        <a href="../feed/index.php">    <i class="fas fa-arrow-left"></i> &nbsp; &nbsp;&nbsp; Edit profile</a>
    </div>
    <div class="container">
    <form action="../edit/updateProfile.php" method="post">
    <div class="imgBox">
    <?php 
        echo'<img class="userImg"data-id="'.$_SESSION["unique_id"].'" src="../php/images/' .$user[0]["img"]. '" alt="">';
    ?>
         
 </div>

        <div class="userData">
   
        
         <div class="userInfo">
         <input style="width: 48%;" type="text" value="<?php echo $user[0]["fname"]?>" name="firstName">
         <input style="width: 48%;" type="text" value="<?php echo $user[0]["lname"]?>" name="lastName">
         <input style="width: 100%; font-weight: 600; padding: 25px 0px 25px 10px;" type="text" value="<?php echo $user[0]["bio"]?>" name="bio">
         <?php
               $date = explode("-", $user[0]["date"]);
               //get the current year
               $year = date("Y");
                //get the current month
                $month = date("m");
                //get the current day
                $day = date("d");
              
            echo '<select name="year">';
                    echo '<option value="'.$year.'" selected>&nbsp&nbsp'.$year.'</option>';
              for($i = date('Y'); $i >= date('Y', strtotime('-100 years')); $i--){
                echo "<option value='$i'>&nbsp&nbsp$i</option>";
              } 
            echo '</select>';
            echo '<select name="month">';
            echo '<option value="'.$month.'" selected>&nbsp&nbsp'.$month.'</option>';
              for($i = 1; $i <= 12; $i++){
                $i = str_pad($i, 2, 0, STR_PAD_LEFT);
                echo "<option value='$i'>&nbsp&nbsp$i</option>";
              }
            echo '</select>';
            echo '<select name="day">';
            echo '<option value="'.$day.'" selected>&nbsp&nbsp'.$day.'</option>';
              for($i = 1; $i <= 31; $i++){
                $i = str_pad($i, 2, 0, STR_PAD_LEFT);
                echo "<option value='$i'>&nbsp&nbsp$i</option>";
              }
            echo '</select>';
        ?>

         </div>
  
        </div>
       <input type="submit" value="Update profiel" class='update'>
       </form>
    </div>
  
    </section>
   
  </div>
  </div>

  <script>

  </script>

</body>
</html>
