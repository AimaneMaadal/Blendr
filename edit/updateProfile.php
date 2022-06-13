<?php
//check incoming data
if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["bio"]) && isset($_POST["year"]) && isset($_POST["month"]) && isset($_POST["day"])){
    //get the data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $bio = $_POST["bio"];
    $year = $_POST["year"];
    $month = $_POST["month"];
    $day = $_POST["day"];

    //get unique id from user session
    session_start();
    $unique_id = $_SESSION["unique_id"];

    if(!empty($firstName) && !empty($lastName) && !empty($bio) && !empty($year) && !empty($month) && !empty($day)){
        //make a connection 
        $conn = new mysqli("localhost", "root", "usbw", "chatapp");
        //check connection
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        } 
        //make a query
        $date= strtotime("$year/$month/$day");
        $sql = "UPDATE users SET fname='$firstName', lname='$lastName', bio='$bio', date='$date' WHERE unique_id='$unique_id'";
        //check if query works
        if($conn->query($sql) === TRUE){
            //send user back to profile
            header("Location: ../profile.php");
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        //close connection
        $conn->close();
    }
    else{
        //return user to previous page
        echo "<script>console.log('wrong 3');</script>";
    }
}
?>