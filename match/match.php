<?php 
  session_start();
  include_once "../classes/user.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: http://localhost/blendr2.0/match.php");
  }
  
$users = user::getAllMatch($_SESSION['unique_id']);

//if submit button is clicked then echo succes
if(isset($_POST['submit'])){
  echo "succes";
}


?>
<?php include_once "../header.php"; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blendr</title>
    <link rel="stylesheet" href="match.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/6ec6696b28.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .wrapper{
            background-color: #FF7A00;
        }
        img{
            border-radius: 302px;
            width: 160px;
            border: 9px solid white;
            float: left;
        }

    </style>    
<body>
<div class="wrapper">

<?php 


$otherUser = user::getuserById($users[0][2]);
$User = user::getuserById($_SESSION['unique_id']);

var_dump($otherUser);

echo "<img style='margin-left: -100px;' src = ../php/images/" . $otherUser[0]['img'].">";
echo "<img style='margin-left: 100px;margin-top: -161px;' src = ../php/images/" . $User[0]['img'].">";


$tags = user::getCommonInterests($otherUser[0]['unique_id']);
$tags2 = user::getCommonInterests($_SESSION['unique_id']);

$common = array_intersect($tags, $tags2);

echo '<span style="text-align: center;width: 80%;margin: 20px 0px 10px 0px;font-weight: 600;color: white;">Jij en '.$otherUser[0]["fname"].' zijn gematched en hebben samen '.count($common).' + gemeenschapelijke intresses</span>';


?>

<input style="margin: 36px;width: 80%;height: 50px;border-radius: 20px;color: #FF7A00;font-weight: 700;background-color: #Fff;border: none;font-size: 16px;" type="submit" value="Request meetup" id="request">

<a href="../feed/index.php" style="width: 100%;margin-left: 90px;"><input style="margin: -8px;width: 80%;height: 50px;border-radius: 20px;color: #ffffff;font-weight: 700;background-color: rgb(173 81 20);border: none;font-size: 16px;" type="submit" value="Return Home" id="request"></a>


</div>
<script>

$(document).on("click","#request",function(){
    id = <?php echo $otherUser[0]['unique_id']; ?>;
    id2 = <?php echo $_SESSION['unique_id']; ?>;
    alert(id+"succes"+id2);

    $.ajax({  
        url:"ajax/add_request.php",  
        method:"POST",  
        data:{
            id:id,
            id2:id2
        }, 
        success:function(data){ 
            console.log(data);
            //go to home
            window.location.href = "../users.php";
        } 
    }); 
 });


</script>    
</body>