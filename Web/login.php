<?php
// start a session
session_start();

include("connection.php");
include("functions.php");

$user_data_ = check_login($con);
if ($user_data_ !== false) {
    header("Location: index.php");
    die;
};
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    if (!empty($user_name) && !empty($password) && !is_numeric($username)) {
        // read from the database

        $query = "select * from users where user_name = '$user_name' limit 1";

        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) { // check if the results are valid
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['password'] === $password) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            };
        } else {
            echo "Username or Password is wrong please try again!";
        };
        //redirect user after the code is done
        header("Location: login.php");
        die;
    } else {
        echo "Please enter some valid information";
    };
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./stylesheets/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./stylesheets/login.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="background-image3">
        <div class="wrapper">
            <div class="navbar-container">
                <ul class="links-container">
                    <div class="navbar-logo"></div>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="appointments.php">Create Appointment</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <?php
                    if ($user_data_ === false) {
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
        <div class="header">
            <h1 class="header-h1">Login Your Account Now</h1>
        </div>
    </div>
    <div class="login-form-container">
        <div class="container">
            <form class="login-email" method="POST">
                <p class="login-text">Login with username</p>
                <div class="input-group">
                    <input name="user_name" type="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input name="password" type="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <button class="btn">Login</button>
                </div>
                <div style="display: flex; justify-content: center;">
                    <a href="register.php">Don't have an account yet?</a>
                </div>
            </form>
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