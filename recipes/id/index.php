<?php
include_once "../../classes/user.php"; 
session_start();
if (isset($_SESSION['unique_id'])) {
} else {

    header("Location: login.php");
    exit;
}


?>
<?php include_once "../../header.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <div class="wrapper">
        <section>
            
            <?php

            require_once '../../classes/config.php';

            $db = Db::getInstance();
            //select the recipe that comes from the url
            $recipeId = $_GET['id'];
            $stmt = $db->prepare("SELECT * FROM recipes WHERE recipe_id = :recipeId");
            $stmt->bindValue(':recipeId', $recipeId);
            $stmt->execute();
            $recipe = $stmt->fetch(PDO::FETCH_ASSOC);


            $userFname = user::getUserById($recipe['maker'])[0]['fname'];
           
            ?>
            <!-- make go back button -->
            <div class="back"><a href="../index.php"><i class="fa-solid fa-angle-left"></i></a></div>
            <header>
                <?php $recipeImg = $recipe['img'];
                echo  "<img src=../../php/images/recepis/$recipeImg>" ?>
                <h6><?php echo $recipe['origin']; ?></h6>
                <h2><?php echo $recipe['name']; ?></h2>

            </header>
            <main>
           
                <!-- 3 divs next to each other -->
                <div class="infoBox">
                    <div class="info">

                        <?php
                        //check if duration in shorter than 120
                        if ($recipe['duration'] < 120 && $recipe['duration'] > 10) {
                            echo  ' <i class="fa-solid fa-fire-burner"></i> &nbsp;  '.$recipe['duration'] . " min";
                        } else {
                            echo ' <i class="fa-solid fa-fire-burner"></i> &nbsp;  '.$recipe['duration'] . " uur";
                        }
                        ?>
                    </div>
                    <div class="info">

                        <?php
                        //count the amount of ingredients in the recipe
                        $ingredients = json_decode($recipe['ingredients']);
                        $ingredientsCount = count($ingredients);
                        echo ' <i class="fa-solid fa-carrot"></i> &nbsp;  '.$ingredientsCount . " ing";
                        ?>
                    </div>
                    <div class="info">

                        <?php
                        echo '<i class="fa-solid fa-fire"></i> &nbsp; '.$recipe['calories'] . " cal";
                        ?>

                    </div>
                </div>


                <div class="tags">

                    <?php
                    $tags = json_decode($recipe['tags']);
                    if (is_array($tags)) {
                        foreach ($tags as $tag) {
                            echo "<span>" . $tag . "</span> ";
                        }
                    }

      
                    ?>

                </div>

                <div class="maker">
                    <?php echo "Recept maker: " . $userFname; ?>
                </div>
                <div class="description">
                    <?php echo $recipe['description']; ?>
                </div>
                <div class="subtitle">     <h5>Ingrediënten</h5></div>
                <div class="ingredienten">
                

                    <?php
                    $ingredients = json_decode($recipe['ingredients']);
                    foreach ($ingredients as $ingredient) {
                        echo "  <div class='ingBox'>
                        
                       <span style='background-image: url(../../php/images/recepis/ingredients/".$ingredient.".png);background-size: 90%;background-position: center;background-repeat: no-repeat;''>" . $ingredient . "</span>
                       
                       </div>";
                    }
                    ?>
                    
                </div>
                <button class="submitBtn"><a href="https://www.ah.be/producten" style='color: white;'>Add to shopping list</a></button>
          

            </main>


        </section>
    </div>

</body>

</html>