<?php

 if(!empty($_POST)){
    try{   
      include_once("bootstrap.php");
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $password2 = $_POST['password2'];
      
      $user = new User();

      $user->setEmail($email);
      $user->setPassword($password);
      $user->setFirstname($firstname);
      $user->setLastname($lastname);

      if($user->canRegister($password,$password2)){
        echo "SESSION HAS STARTED";
        session_start();
        $_SESSION['user'] = $user->getEmail();
        $user->register();
        header("Location: index.php");

      }
  }
  catch(Throwable $error) {
    // if any errors are thrown in the class, they can be caught here
    $error = $error->getMessage();
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
    <h1>Create account</h1>

      <label>First name</label>
      <input type="text" name="firstname" class="inputfield"><br>

      <label>Last name</label>
      <input type="text" name="lastname" class="inputfield"><br>

      <label>Email address</label>
      <input type="email" name="email" class="inputfield"><br>

      <label>Password</label>
      <input type="password" name="password" class="inputfield"><br>

      <label>Confirm password</label>
      <input type="password" name="password2" class="inputfield"><br>
      
      <input type="checkbox"></input>
      <span>Remember me</span>

      <?php if (isset($error)) {
        echo "<div id='error'>".$error."</div>";
        }?>

      <button type="submit">Submit</button>
      <a href="login.php" id="noAccountLink">I already have an account</a><br>
    </form>
  </div>




</body>

</html>