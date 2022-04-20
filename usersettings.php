<?php

include_once("bootstrap.php");

session_start();
if (!isset($_SESSION['user'])) {
    header('location: login.php');
} else {
    $user = new User();
    $sessionId = $_SESSION['user'];
    $userData = User::getUserFromEmail($sessionId);
}

if (!empty($_POST['updateImage'])) {


    $imageName = $_FILES['userImage']['name'];
    $fileType  = $_FILES['userImage']['type'];
    $fileSize  = $_FILES['userImage']['size'];
    $fileTmpName = $_FILES['userImage']['tmp_name'];
    $fileError = $_FILES['userImage']['error'];

    $fileData = explode('/', $fileType);
    $fileExtension = $fileData[count($fileData) - 1];

    if ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png') {
        //check if file is correct type
        //check file size
        if ($fileSize < 5000000) {

            $fileNewName = "images/profile_pictures/" . basename($imageName);
            $uploaded = move_uploaded_file($fileTmpName, $fileNewName);

            if ($uploaded) {
                $profilePicture = basename($imageName);
                $user->setProfilePicture($profilePicture);
                $user->updateProfilePicture($profilePicture, $sessionId);
            }
        } else {
            echo ("too big");
        }
    } else {
        echo ("no");
    }
}


if (!empty($_POST['update'])) {
    try {
        $user->setFirstName($_POST['updateFirstName']);
        $user->setLastname($_POST['updateLastName']);
        $user->setEmail($_POST['updateEmail']);
        $user->setBio($_POST['updateBio']);
        $user->setEducation($_POST['updateEducation']);

        //$user->setProfilePicture($_FILES['updateImage']);
        $user->updateUser();

        $userData = User::getUserFromEmail($sessionId);
    }   
    catch(Throwable $error) {
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

    <header>
        <?php include('nav.php'); ?>
    </header>

    <?php if (!empty($error)) {echo $error; } ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label>Profile picture</label>
            <img class="profilePicture" src="images/profile_pictures/<?php echo $userData['profilepicture']; ?>" alt="Profile picture">
            <input type="file" id="userImage" name="userImage" value=""><br>
        </div>
        <input type="submit" name="updateImage" value="Update profile picture">
    </form>



    <form action="" method="post" class="profile_info">
        <label>Email address</label>
        <input type="email" name="updateEmail" value="<?php echo htmlspecialchars($userData['email']); ?>"><br>

        <label>First Name</label>
        <input type="text" name="updateFirstName" value="<?php echo htmlspecialchars($userData['firstname']); ?>"><br>

        <label>Last Name</label>
        <input type="text" name="updateLastName" value="<?php echo htmlspecialchars($userData['lastname']); ?>"><br>

        <label>Bio</label>
        <input type="text" name="updateBio" value="<?php echo htmlspecialchars($userData['bio']); ?>"><br>

        <label>Education</label>
        <input type="text" name="updateEducation" value="<?php echo htmlspecialchars($userData['education']); ?>"><br>

        <input type="submit" name="update" value="Update gegevens">
    </form>

    <a href="changepassword.php">Change current password</a>
    <a href="delete.php">Delete profile</a>

</body>

</html>