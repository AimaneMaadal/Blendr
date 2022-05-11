<?php 
  session_start();
  if (isset($_SESSION['unique_id'])) {
  
  } else {
        
    header("Location: login.php");
    exit;
}


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
  <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="wrapper">
    <section>
      <header>
      <h1>Recipes</h1>
        
      </header>
        <main>
            
            <?php

            require_once '../classes/config.php';

            $db = Db::getInstance();
            $stmt = $db->prepare("SELECT * FROM recipes");
            $stmt->execute();
            $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($recipes as $recipe) {
                echo "<div class='recipeBox'>";
                $receptImg = $recipe['img'];
                echo "<img src='$receptImg'>";
                echo "<h2>" . $recipe['name'] . "</h2>";
                $tags = json_decode($recipe['tags']);
                foreach ($tags as $tag) {
                    echo "<span>".$tag."</span> ";
                }
                echo "</div>";
            }
          
    
            ?>
        </main>

      
    </section>
  </div>

</body>
</html>


