<?php

include_once("bootstrap.php");


$token = $_GET["token"];



if (!empty($_POST)) {
    try {
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
    
        if ($password1 === $password2) {
            User::updatePassword($token,$password1);
            header("location: login.php");
        }
        else{
            throw new Exception("Passwords dont match each other");
        }
    }
    catch (Exception $e) {
        $error = $e->getMessage();
    }
   
}
    
    


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creative Minds</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
<img id="logo_mini" src="images/logo_mini.svg">

    <div id="form">
        <form action="" method="post">
        <br><br>
            <h1>New password</h1>
            <label>New password</label>
            <input type="password" name="password1" class="inputfield"><br>

            <label>Confirm password</label>
            <input type="password" name="password2" class="inputfield"><br>


            
            <?php if (isset($error)) {
                echo "<div id='error'>".$error."</div>";
            }?>

            <button type="submit">Submit</button><br>


        </form>
    </div>



</body>

</html>