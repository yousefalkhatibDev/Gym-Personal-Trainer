<?php
// start a session
session_start();

include("connection.php");
include("functions.php");

// $con for connection
$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="./stylesheets/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./stylesheets/aboutus.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="background-image2">
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
        <div class="info">
            <img src="./images/profile.jpg" class="profile-image" />
            <div class="trainer-info">
                <h1 class="trainer-name">Muhanad Radi</h1>
                <p class="trainer-descreption">Profisional Gym Trainer with 5+ years of experience</p>
            </div>
        </div>
        <div class="contact-us">
            <h1 class="header">Contact Us</h1>
            <div class="contact-info">
                <div class="location">
                    <div class="icon-container">
                        <ion-icon name="location-outline" class="icon"></ion-icon>
                    </div>
                    <p class="location-value">Jordan, Amman</p>
                </div>
                <div class="phone">
                    <div class="icon-container">
                        <ion-icon name="call-outline" class="icon"></ion-icon>
                    </div>
                    <p class="phone-value">+962 798610814</p>

                </div>
                <div class="email">
                    <div class="icon-container">
                        <ion-icon name="mail-outline" class="icon"></ion-icon>
                    </div>
                    <p class="email-value">muhanad.radi016@gmail.com</p>
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
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>