<?php
include'class/user.php';

session_start();
if(!isset($_SESSION['user']))
{
 header('location:login.php');
}
$user_id=$_SESSION['user'];
$user = new USER();

//fetch user details
$result=$user->user_detail($user_id);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	
    <script type="text/javascript" src="function.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	
</head>
<body>
<div class="container">
	<div class="header">
		<a href="Logout.php">Logout</a>
		<a href="">Hi <?php echo($result['username']); ?></a>
	</div>
	
	<div id="user_details"></div>
	<div id="user_model_details"></div>
	<div class="bottomNav">
		<a href="index.php"><img src="images/icons/home.svg" style="width: 8%;"></a>
		<a href="recepten.php"><img src="images/icons/recepten.svg" style="width: 6%;"></a>
		<a href="blend.php"><img src="images/icons/blend.svg" style="width: 9%;"></a>
		<a href="chat.php"><img src="images/icons/chat_active.svg" style="width: 9%;"></a>
	<div>
</div>

</body>
</html>