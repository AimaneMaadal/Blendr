<?php 
  include_once '../classes/user.php';
  session_start();
  if (isset($_SESSION['unique_id'])) {
  
  } else {
        
    header("Location: login.php");
    exit;
}

$user = user::getUserbyId($_SESSION['unique_id']);

?>
<?php include_once "../header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipes</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .recepis{
      display: flex;
      overflow-y: scroll;
      margin-left: -25px;
      margin-top: -30px;
      width: 380px;
    }
    .filter{
      display: flex;
      width: 90%;
      justify-content: space-between;
      margin-left: 15px;
    }
    .listmenu{
      margin: 28px 0px 50px 19px;
      width: 130%;
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
    }
    .listmenu a{
      flex: 0 0 auto;
    }
    .listmenu li{
        display: inline-block;
        margin-right: 32px;
        margin-bottom: 10px;
        margin-top: 14px;
        font-size: 17px;
        font-weight: 600;
        color: #001F3C;
    }
    .profilePic {
        margin-left: 122px;
    }
    .topHeader{
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      width: 80%;
      margin: 35px auto;
    }
    .addBtn{
      width: 100%;
      display: block;
      margin-top: -30px;
    }
    .wrapper{
      align-items: normal;
    }
    .bottomNav{
      position: absolute;
      bottom: 25px;
      left: 25px;
    }
   </style> 
</head>

<body>
<div class="wrapper">


      <div class="topHeader">
            <img src="../php/icons/slogan.svg" alt="logo" class="menuVector">
            <?php echo'<img class="profilePic" id="profilePicture" data-id="'.$_SESSION["unique_id"].'" src="../php/images/' .$user[0]["img"]. '" alt="">'; ?>
        </div>
        <div class="filter">
          <input type="text" id="search" placeholder="Search">
          <i class="fa-solid fa-filter fa-2x" style="margin-top: 4px;color: #F0A500;"></i>
        </div>  


      <ul class="listmenu">
        <li><a href="index.php" style="font-weight: 700; color: #FF7A00; border-bottom: 4px solid #FF7A00; padding-bottom: 7px;">Recepten</a></li>
        <li><a href="recipes.php">Ingredienten</a></li>
        <li><a href="recipes.php">Snacks</a></li>
        <li><a href="recipes.php">Drinks</a></li>
      </ul> 
   
            <div class="recepis">
            <?php

            require_once '../classes/config.php';

            $db = Db::getInstance();
            $stmt = $db->prepare("SELECT * FROM recipes");
            $stmt->execute();
            $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($recipes as $recipe) {
                $recipeId = $recipe['recipe_id'];
                echo "<a href='./id/index.php?id=$recipeId'><div class='recipeBox'>";
                $receptImg = "../php/images/recepis/".$recipe['img'];
                echo "<img src='$receptImg'>";
                echo "<div class='recepiInfo'>";
                echo "<h2>" . $recipe['name'] . "</h2>";
                $tags = json_decode($recipe['tags']);
                echo "<div class='tags'>";
                if(!empty($tags)){
                  foreach ($tags as $tag) {
                    echo "<span class='tag'>$tag</span>";
                  }
                }            
                echo "</div></div></div></a>";
            }
          
    
            ?>
          </div>

        <a href="addRecepiGal.php" style="margin: 0px auto;display: block;width: 20%;"><img src="../php/icons/add.svg" class="addBtn"></a>
        <div class="bottomNav">
          <div><a href="../feed/index.php"><img src="../php/icons/home.svg"></div>
          <div><img src="../php/icons/recepeten_fill.svg"></div>
          <div><a href="../match/index.php"><img src="../php/icons/match.svg"></a></div>
          <div><a href="../users.php"><img src="../php/icons/chat.svg"></a></div>
        </div>
  </div>

</body>
</html>


