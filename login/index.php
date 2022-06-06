<?php 
  session_start();
  if (isset($_SESSION["unique_id"])) {
    header('Location: ../feed/index.php');
  }

?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login"><br><br><br><br><br><br><br><br>
      <header>Login</header>
      <p>Login in with your information and start looking for your next match!</p><br><br>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Sign In">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="signup.php">Signup now</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
