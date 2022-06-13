<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  include_once "classes/user.php";
  
  $user = user::getuserById($_SESSION['unique_id']);
?>
<?php include_once "./header.php"; ?>

<head>
  <style>

.bottomNav {
    position: fixed;
    background-color: rgb(255, 255, 255);
    bottom: 80px;
    width: 330px;
    height: 50px;
    border-radius: 10px;
    z-index: 5;
    box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 50%);
    display: flex;
    justify-content: space-around;
    align-items: center;
}
.bottomNav div{
    width: 25px;
    height: 25px;
}
.bottomNav div img{
    width: 25px;
    height: 25px;
}
.sidenav {
  height: 907px;
  width: 0;
  position: absolute;
  z-index: 10;
  top: 0;
  left: 0;
  background-color: #FF7A00;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
  display: flex;
  /* text-align: center; */
  flex-direction: column;
  gap: 40px;
}
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
  color: white;
}
.sidenav a {
  margin-left: 50px;
  color: white;
  font-weight: 600;
}
  </style>
</head>
<body>
  <div class="wrapper">
        
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">Profile</a>
  <a href="#">Matches</a>
  <a href="#">offer and promo</a>
  <a href="#">Privacy policy</a>
  <a href="../php/logout.php?logout_id=<?php echo $_SESSION['unique_id'] ?>">Uitloggen</a>
</div>
  <div class="topHeader">
            <img src="php/icons/vector.svg" onclick="openNav()" alt="logo" class="menuVector">
            <?php echo'<img class="profilePic" id="profilePicture" data-id="'.$_SESSION["unique_id"].'" src="php/images/' .$user[0]["img"]. '" alt="">'; ?>
        </div>  
    <section class="users">
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users INNER JOIN matches ON users.unique_id = matches.match_id WHERE matches.like = 2;");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          
        </div>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
    <div class="bottomNav">
          <div><a href="feed/index.php"><img src="php/icons/home.svg"></a></div>
          <div><a href="recipes/index.php"><img src="php/icons/recepeten.svg"></a></div>
          <div><a href="match/index.php"><img src="php/icons/match.svg"></a></div>
          <div><a href="users.php"><img src="php/icons/chat_fill.svg"></a></div>
        </div>
  </div>

  <script src="javascript/users.js"></script>
  <script>
function openNav() {
  document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

  </script>

</body>
</html>
