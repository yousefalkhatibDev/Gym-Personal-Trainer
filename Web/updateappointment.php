<?php
// start a session
session_start();

include("connection.php");
include("functions.php");

// $con for connection
$user_data = check_login($con);
if ($user_data === false) {
    header("Location: login.php");
    die;
};

$user_id = $user_data['user_id'];

if (empty($_GET['name']) || empty($_GET['appointment_id']) || empty($_GET['age']) || empty($_GET['date']) || empty($_GET['time'])) {
    die("Invalid data");
};

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $appointment_id = $_GET['appointment_id'];
    if (!empty($name) && !empty($age) && !empty($date) && !empty($time) && !is_numeric($name) && is_numeric($age)) {
        $queryUpdate = "update appointments set name = '$name', age = '$age', date = '$date', time = '$time' where appointment_id = '$appointment_id'";
        mysqli_query($con, $queryUpdate);
        header("Location: appointments.php");
        die;
    } else {
        echo "Please enter some valid information";
    };
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="./stylesheets/appointments.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./stylesheets/index.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="background-image5">
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
        <div class="header">
            <h1 class="header-h1">Updtade Your Appointment</h1>
        </div>
        <div class="appointment-form-container">
            <div class="container">
                <form class="appointment-form" method="POST">
                    <p class="appointment-text">Update An Appointment</p>
                    <div class="input-group">
                        <input name="name" type="username" placeholder="Name" value="<?php echo $_GET['name'] ?>" required>
                        <input name="age" type="number" placeholder="Age" value="<?php echo $_GET['age'] ?>" required>
                    </div>
                    <div class="input-group">
                        <input name="date" type="date" placeholder="Date" value="<?php echo $_GET['date'] ?>" required>
                        <input name="time" type="time" placeholder="Time" value="<?php echo $_GET['time'] ?>" required>
                    </div>
                    <div class="input-group">
                        <button class="btn">Update Appointment</button>
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