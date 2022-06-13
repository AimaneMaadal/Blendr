<?php 
  session_start();
  
  $recepiId = $_GET['recepiId'];
  

  require_once '../classes/config.php';

  $db = Db::getInstance();
  //select the recipe that comes from the url
  $stmt = $db->prepare("SELECT * FROM recipes WHERE recipe_id = :recipeId");
  $stmt->bindValue(':recipeId', $recepiId);
  $stmt->execute();
  $recipe = $stmt->fetch(PDO::FETCH_ASSOC);


  //var_dump($recipe);





  if (!empty($_POST)){
    $receptnaam = $_POST['receptnaam'];
    $origine = $_POST['origine'];
    $tijd = $_POST['tijd'];
    $beschrijving = $_POST['beschrijving'];
    $calorieën = $_POST['calorieën'];
    echo $receptnaam." ".$origine." ".$tijd." ".$beschrijving." ".$calorieën." ".$recepiId;
    //update recepi by recepiId
    $conn = mysqli_connect("localhost", "root", "usbw", "chatapp");
    $sql = "UPDATE `recipes` SET `name` = '$receptnaam', `origin` = '$origine', `duration` = '$tijd', `description` = '$beschrijving', `calories` = '$calorieën' WHERE `recipes`.`recipe_id` = '$recepiId';";
    $result = mysqli_query($conn, $sql);

    header("Location: id/index.php?id=$recepiId");
    
  }

  $recipeName = $recipe['name'];
  $recipeOrigin = $recipe['origin'];
  $recipeDuration = $recipe['duration'];
  $recipeDescription = $recipe['description'];
  $recipeCalories = $recipe['calories'];
  $recipeIngredients = json_decode($recipe['ingredients']);
  $ingredientsShow = ""; 
  if ($recipeIngredients) {
    $ingredientsShow = implode(",",array_slice($recipeIngredients, 0, 3));
    $ingredientsShow .= "..."; 
  }

  



?>

<link rel="stylesheet" href="../style.css">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/6ec6696b28.js" crossorigin="anonymous"></script>
  <title>Document</title>
  <style>

.profilePic{
      width: 100px;
      height: 100px;
      margin: 30px auto;
      margin-bottom: 30px;
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
    .select_input {
        font-size: 12px;
        padding: 13px 10px;
        border-radius: 10px;
        background-color: #ECECEC;
        height: 40px;
        border: none;
        color: #001F3C;
        font-weight: 600;
        margin: 2px 0px 10px 0px;
        display: flex;
        justify-content: space-between;
    }
    .select_input a{
        width: 100%;
        display: flex;
        justify-content: space-between;
    }
    .submitBtn{
      height: 45px;
      border: none;
      color: #fff;
      font-size: 17px;
      background: #FF7A00;
      border-radius: 15px;
      cursor: pointer;
      margin-top: 13px;
      font-weight: 600;
      width: 100%;
      margin-top: 30px;
    }
    
  </style>
</head>

<body>
  <div class="wrapper">
    <section class="form signup">
      <h1>Add recipe</h1>
      <p>Create an account so you can match with people of different cultures and the same interests.</p>
      <form method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="field image">
          <label>
            <img src="../php/images/recepis/<?php echo $recipe['img']; ?>" alt="profile pic" class="profilePic">
          </label>
          
        </div>
        <div class="name-details">
          <div class="field input">
            <input type="text" name="receptnaam" value="<?php if($recipeName != "NULL"){ echo $recipeName; } ?>" placeholder="Recipe name" required>
          </div>
          <div class="field input">
            <input type="text" name="origine" value="<?php if($recipeOrigin != "NULL"){ echo $recipeOrigin; } ?>" placeholder="Recipe origin" required>
          </div>
        </div>
        <div class="field input">
          <textarea name="beschrijving" placeholder="Description" required><?php if($recipeDescription != "NULL"){ echo $recipeDescription; } ?></textarea>
        </div>
        <div class="name-details">
          <div class="field input">
            <input type="time" name="tijd" value="<?php echo $recipe["duration"] ?>" placeholder="Recept naam" required>
          </div>
          <div class="field input">
            <input type="text" name="calorieën" value="<?php if($recipeCalories != "NULL"){ echo $recipeCalories; } ?>" placeholder="Calories" style="width: 120%;" required>
          </div>
        </div>
          <div class="select_input">
            <a href="addIngredients.php?id=<?php echo $recepiId?>">
              <div>Ingredients</div>
              <div><p style="font-size: 10px;color: grey;"><?php  echo $ingredientsShow ?><i class="fa-solid fa-chevron-right"></i></p></div>
            </a>
          </div>
          <div class="select_input">
            <a href="addTags.php?id=<?php echo $recepiId?>">
              <div>Tags</div>
              <div><i class="fa-solid fa-chevron-right"></i></div>
            </a>
          </div>
        <button class="submitBtn" type="submit">Add Recipe</button>
      </form>
    </section>
  </div>


  <script>

  </script>

</body>
</html>


