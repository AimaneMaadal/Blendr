<?php 
  session_start();
  include_once "../classes/user.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: http://localhost/blendr2.0/match.php");
  }
  
  $id = $_GET['id'];
  $data = User::getUserById($id);

?>
<?php include_once "../header.php"; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blendr</title>
    <link rel="stylesheet" href="match.css">
    <link rel="stylesheet" href="../style.css">
   
<body>
<div class="wrapper">
<header>
        <div class="content">
        <a href="php/logout.php?logout_id=<?php echo $_SESSION['unique_id'] ?>" class="logout">Logout</a>
    </header>

   

    <?php foreach($data as $row){ 
        $img = "../php/images/".json_decode($row["showcase"])[0];            
        echo 'ok'.$row["showcase"];
    } 
    ?>
    



    
</body>