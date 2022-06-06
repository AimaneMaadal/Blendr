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
    .profilePic{
      width: 100px;
      height: 100px;
      margin: 30px auto;
      margin-bottom: -10px;
      display: block;
      border-radius: 50%;
    }
    .form form .image input {
      display: none;
    }
    select{
      width: 30%;
      background-color: #ECECEC;
      height: 40px;
      border: none;
      border-radius: 10px;
      font-size: 12px;
      font-weight: 600;
    }
    select option:first-child
    {
        color: #ccc;
    }
    #geo{
      display: none;
    }

    
  </style>
</head>

<body onload="getLocation()">
  <div class="wrapper">
    <section class="form signup">
      <h1>Sign up</h1>
      <img src="../php/icons/step1.svg" style="width: 100%;margin: 20px 0px 20px -5px;">
      <p>Create an account so you can match with people of different cultures and the same interests.</p>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="field image">
          <label>
            <img src="../php/images/placeholder-removebg-preview.png" id="profilePic" class="profilePic"></img><input type="file" onchange="document.getElementById('profilePic').src = window.URL.createObjectURL(this.files[0])" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
            <img src="../php/icons/add.svg" style="margin: -230px 0px 0px 160px; width: 12%">  
          </label> 
        </div>
        <div class="name-details">
          <div class="field input">
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <input type="password" name="password" placeholder="Enter new password" required>
          <input type="text" name="geo" id="geo" placeholder="Enter new password">
          <i class="fas fa-eye"></i>
        </div>
        <?php
            echo '<select name="year">';
              echo '<option>&nbsp &nbsp Year</option>';
              for($i = date('Y'); $i >= date('Y', strtotime('-100 years')); $i--){
                echo "<option value='$i'>&nbsp&nbsp$i</option>";
              } 
            echo '</select>';
            echo '<select name="month" style="margin:0px 5% 2px 5%;">';
              echo '<option>&nbsp&nbspMonth</option>';
              for($i = 1; $i <= 12; $i++){
                $i = str_pad($i, 2, 0, STR_PAD_LEFT);
                echo "<option value='$i'>&nbsp&nbsp$i</option>";
              }
            echo '</select>';
            echo '<select name="day">';
              echo '<option>&nbsp&nbspDay</option>';
              for($i = 1; $i <= 31; $i++){
                $i = str_pad($i, 2, 0, STR_PAD_LEFT);
                echo "<option value='$i'>&nbsp&nbsp$i</option>";
              }
            echo '</select>';
        ?>
        <div class="error-text"></div>
          <div class="field button">
          <input type="button" onclick="loadDoc()" name="submit" value="Volgende">
        </div>
      </form>
      <div class="link">Heb je al een account? <a href="index.php">log in!</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>
  <script>
    imgInp.onchange = evt => {
      const [file] = imgInp.files
      if (file) {
        blah.src = URL.createObjectURL(file)
      }
    }
    var x = document.getElementById("demo");
    function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
          x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
      console.log(position);
      var geo = JSON.stringify([position.coords.latitude, position.coords.longitude]);
      document.getElementById("geo").value = geo;
    }
  </script>

</body>
</html>


