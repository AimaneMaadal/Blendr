<nav>
    <span>Brandish</span>

    <?php
    if (isset($_SESSION['user'])) {
        $sessionId = $_SESSION['user'];
        $user = User::getUserFromEmail($sessionId);
        //echo "Welkom ".$user["email"];
        echo "<div class='nav_right'><a class='nav_btn' href='logout.php'>Log out</a></div>";
        echo "<div class='nav_right'><a class='nav_btn' href='usersettings.php'>Edit profile</a></div>";
    } else {
        echo "<div class='nav_right'><a class='nav_btn' href='login.php'>Inloggen</a> ";
        echo "<a class='nav_btn' href='register.php'>Aanmelden</a></div>";
    }

    ?>

</nav>