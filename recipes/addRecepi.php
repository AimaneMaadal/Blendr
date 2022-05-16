<?php 
  session_start();
  if (isset($_SESSION['unique_id'])) {
  }
  if (!empty($_POST)){
    $receptnaam = $_POST['receptnaam'];
    $origine = $_POST['origine'];


    
  }
?>

<link rel="stylesheet" href="../style.css">
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
    textarea{
        width: 100%;
        font-size: 12px;
        padding: 0 10px;
        border-radius: 10px;
        background-color: #ECECEC;
        height: 40px;
        border: none;
        color: #001F3C;
        font-weight: 600;
        height: 100px;
    }
    
  </style>
</head>

<body>
  <div class="wrapper">
    <section class="form signup">
      <h1>Recept toevoegen</h1>
      <p>Maak een account zodat je kunt matchen met mensen van verschillende culturen en dezelfde intresses.</p>
      <form method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="field image">
          <label>
            <img src="../php/icons/add.svg" style="margin: -16px 0px 9px 171px; width: 12%">
            
          </label>
          
        </div>
        <div class="name-details">
          <div class="field input">
            <input type="text" name="receptnaam" placeholder="Recept naam" >
          </div>
          <div class="field input">
            <input type="text" name="origine" placeholder="Recept origine" >
          </div>
        </div>
        <div class="field input">
          <textarea name="beschrijving" placeholder="Beschrijving" ></textarea>
        </div>
        <div class="name-details">
          <div class="field input">
            <input type="time" name="tijd" placeholder="Recept naam" >
          </div>
          <div class="field input">
            <input type="text" name="calorieën" placeholder="Calorieeën" style="width: 120%;">
          </div>
        </div>
        <button type="submit">Submit</button>
      </form>
    </section>
  </div>


  <script>

  </script>

</body>
</html>


