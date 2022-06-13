<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login/index.php");
  }
  include_once "classes/user.php";
  
  $user = user::getuserById($_SESSION['unique_id']);

?>
<?php include_once "./header.php"; ?>

<head>
  <style>

.bottomNav {
    position: absolute;
    background-color: rgb(255, 255, 255);
    bottom: 25px;
    left: 25px;
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
.container{
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 100px;
  height: 100%;
  padding-top: 60px;
  background-color: #f2f2f2;
  width: 100%;
  padding-left: 15%;
  padding-right:15%;

}
.wrapper{
  padding: 0;
  margin: 0;
  overflow: hidden;
}
.topHeader, .users, .search{
  padding: 0;
  margin: 0;
  width: 100%;
}
.sidenav {
    height: 907px;
    width: 0;
    position: absolute;
    z-index: 0;
    top: 0;
    left: 0;
    background-color: #FF7A00;
    opacity: 0;
    transition: 0.5s;
    padding-top: 60px;
 
    display: flex;
    /* text-align: center; */
    flex-direction: column;
    
    visibility: hidden;
    
    white-space: nowrap;
    
}
.sidenav .closebtn {
    position: absolute;
    top: 175px;
    right: 0;
    font-size: 36px;
    margin-left: 50px;
    color: white;
    background-color: #f2f2f2;
    width: 40%;
    height: 500px;
    opacity: 0;

}
.sidenav a {
    margin-left: 70px;
    color: white;
    font-weight: 600;
    font-size: 20px;
    border-bottom: 1px solid rgb(255, 255, 255, 0.3);
    width: 35%;
    padding: 25px 0px;
   
    display: inline-block;
}
.sidenav a i{
    margin-right: 10px;
    margin-left: -30px;
    color: white;


}
.sidenav a:last-child{
    border-bottom: none;
    margin-top: 200px;
    margin-left: 35px;
    align-items: center;
}
.sidenav a:last-child i{

    margin-left: 10px;
    color: white;

}
.sidenav_logo{
    font-family: "Source Sans Pro";
    font-weight: bolder;
    font-size: 30px;
    color: white;
    margin-left: 35px;
    margin-bottom: 45px;
    align-items: center;

}
  </style>
</head>
<body>
<div class="wrapper">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="sidenav_logo"><img src="./php/images/assets/logo2.png"></div>
  <a href="./profile.php"><i class="fa-regular fa-circle-user"></i>Profile</a>
  <a href="#"><i class="fa-regular fa-handshake"></i>Matches</a>
  <a href="#"><i class="fa-solid fa-tag"></i>Offer and promo</a>
  <a href="#"><i class="fas fa-shield-alt"></i>Privacy policy</a>

  <a href="./php/logout.php?logout_id=<?php echo $_SESSION['unique_id'] ?>">Uitloggen<i class="fa-solid fa-arrow-right"></i></a>
  
</div>
<div class="container">


  <div class="topHeader">
            <img src="php/icons/vector.svg" onclick="openNav()" alt="logo" class="menuVector">
            <?php echo'<a href="./profile.php"><img class="profilePic" id="profilePicture" data-id="'.$_SESSION["unique_id"].'" src="php/images/' .$user[0]["img"]. '" alt=""></a>'; ?>
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
  </div>


  <script src="javascript/users.js"></script>
  <script>
function openNav() {
  let container =  document.querySelector(".container");
  document.getElementById("mySidenav").style.visibility = "visible";
  document.getElementById("mySidenav").style.width = "100%";
  document.getElementById("mySidenav").style.overflow = "hidden";
  document.getElementById("mySidenav").style.opacity = "1";

  document.querySelector(".bottomNav").style.marginBottom = "0px";
  container.style.transform = "scale(0.55)";
  container.style.position = "relative";
  container.style.left = "165px";
  container.style.zIndex = "200";
 
  container.style.backgroundColor = "#F2F2F2";
  container.style.pointerEvents = "none"; 
  container.style.paddingBottom = "120px";
  container.style.borderRadius = "25px";
  container.style.boxShadow = "-35px 35px rgb(255,255,255,0.36)";
  
}

function closeNav() {
    // revert back to normal
    let container =  document.querySelector(".container");
    document.getElementById("mySidenav").style.visibility = "hidden";
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mySidenav").style.overflow = "hidden";
    document.getElementById("mySidenav").style.opacity = "0";

    document.querySelector(".bottomNav").style.marginBottom = "0px";
    container.style.transform = "scale(1)";
    container.style.position = "relative";
    container.style.left = "0px";
    container.style.zIndex = "0";
    container.style.backgroundColor = "white";
    container.style.pointerEvents = "all";
    container.style.paddingBottom = "45%";
    container.style.borderRadius = "0px";
    container.style.boxShadow = "none";
    container.onclick = "";
    container.style.cursor = "default";
}

  </script>

</body>
</html>
