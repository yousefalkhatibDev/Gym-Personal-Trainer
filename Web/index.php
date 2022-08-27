<?php
// start a session
session_start();

include("connection.php");
include("functions.php");

// $con for connection checkss if the user is logged in and connects the user to the database
$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./stylesheets/index.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="background-image">
        <div class="wrapper">
            <div class="navbar-container">
                <ul class="links-container">
                    <div class="navbar-logo"></div>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="appointments.php">Create Appointment</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <?php
                    if ($user_data === false) {
                        echo '
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    ';
                    } else {
                        echo '
                        <li><a href="logout.php">Log Out</a></li>
                    ';
                    };
                    ?>
                </ul>
                <div class="ham">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </div>
        </div>
        <div class="quote">
            <span>IN THIS FITNESS SYSTEM, WE DO</span>
            <span>TWO THINGS:</span>
            <div class="types-of-work">
                <div class="lose-weight">
                    <img src="./images/lose-weight.png" class="img" />
                    <span class="description">Lose Weight</span>
                </div>
                <div class="get-jacked">
                    <img src="./images/get-jacked.png" class="img" />
                    <span class="description">Get Jacked</span>
                </div>
            </div>
        </div>

    </div>
    <script>
        const burger = document.querySelector(".ham")
        const links = document.querySelector(".links-container")
        burger.addEventListener("click", () => {
            links.classList.toggle("navActive")
            burger.classList.toggle("hamNavActive")
        })

        document.addEventListener("scroll", () => {
            links.classList.remove("navActive")
            burger.classList.remove("hamNavActive")
        })
    </script>
</body>

</html>