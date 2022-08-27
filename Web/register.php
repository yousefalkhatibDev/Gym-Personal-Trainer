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

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if request method is post (form method)
    $user_name = $_POST['user_name'];  // get username from the form send
    $password = $_POST['password']; // get password from the form send
    if (!empty($user_name) && !empty($password) && !is_numeric($username)) { // validation (is_numeric to check if username doesn't only contain numbers)   
        $user_id = random_num(20);
        // save to database
        // create a user
        $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

        mysqli_query($con, $query);

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
    <title>Register</title>
    <link rel="stylesheet" href="./stylesheets/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./stylesheets/register.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="background-image4">
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
            <h1 class="header-h1">Register Your Account Now</h1>
        </div>
    </div>
    <div class="register-form-container">
        <div class="container">
            <form class="register-email" method="POST">
                <p class="register-text">Register with username</p>
                <div class="input-group">
                    <input name="user_name" type="text" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input name="password" type="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <button class="btn">Register</button>
                </div>
                <div style="display: flex; justify-content: center;">
                    <a href="login.php">Already have an account?</a>
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