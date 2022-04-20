<?php
//insert code here
if (!empty($_POST)) {
    try{ 
        $email = $_POST["email"];
        $password = $_POST["password"];

        include_once(__DIR__ . "/classes/User.php");

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        if ($user->canLogin($email, $password)) {
            session_start();
            $_SESSION["user"] = $email;
            header("Location: index.php");
        }
    }
    catch(Throwable $error) {
        $error = $error->getMessage();
    }
}

?><!DOCTYPE html>
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

        <h1>Login account</h1>
        <label>Email address</label><br>
        <input placeholder="Email" type="email" name="email" class="inputfield"><br>

        <label>Password</label><br>
        <input placeholder="Password" type="password" name="password" class="inputfield"><br>

        <input type="checkbox"></input>
        <span>Remeber me</span>
       
        <a href="resetpassword.php" id="forgotLink">Forgot password?</a><br>

        <?php if (isset($error)) {
        echo "<div id='error'>".$error."</div>";
        }?>

        <button type="submit">Login</button>
    </form>

    <a href="register.php" id="noAccountLink">Don't have an account yet?</a><br>
    </div>

</body>

</html>