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

    
  </style>
</head>

<body>
  <div class="wrapper">
    <section class="form signup">
      <h1>Registreren</h1>
      <p>Maak een account zodat je kunt matchen met mensen van verschillende culturen en dezelfde intresses.</p>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="field image">
          <label>
            <img src="../php/images/placeholder-removebg-preview.png" class="profilePic"></img><input type="file" capture="camera" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
            <img src="../php/images/add.svg" style="margin: -230px 0px 0px 160px; width: 12%">
            
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
          <input type="button" name="submit" value="Volgende">
        </div>
      </form>
      <div class="link">Heb je al een account? <a href="login.php">log in!</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>


