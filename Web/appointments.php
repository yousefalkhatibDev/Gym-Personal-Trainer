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

if (!empty($_GET['click']) && !empty($_GET['appointment_id'])) {
    deleteAppointment($_GET['appointment_id']);
};

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $global_user_id = $GLOBALS['user_id'];
    if (!empty($name) && !empty($age) && !empty($date) && !empty($time) && !is_numeric($name) && is_numeric($age)) {
        $appointment_id = random_num(20);
        $queryAdd = "insert into appointments (appointment_id,user_id,name,age,date,time) values ('$appointment_id','$global_user_id','$name','$age','$date','$time')";

        mysqli_query($con, $queryAdd);

        header("Location: appointments.php");
        die;
    } else {
        echo "Please enter some valid information";
    };
}

$queryGet = "select * from appointments where user_id = '$user_id'";
$appointments = mysqli_query($con, $queryGet);
// while($result = mysqli_fetch_assoc($appointments)) {
//     print_r($result);
// };



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
            <h1 class="header-h1">Create An Appointment Now</h1>
        </div>
        <div class="appointment-form-container">
            <div class="container">
                <form class="appointment-form" method="POST">
                    <p class="appointment-text">Create An Appointment</p>
                    <div class="input-group">
                        <input name="name" type="username" placeholder="Name" required>
                        <input name="age" type="number" placeholder="Age" required>
                    </div>
                    <div class="input-group">
                        <input name="date" type="date" placeholder="Date" required>
                        <input name="time" type="time" placeholder="Time" required>
                    </div>
                    <div class="input-group">
                        <button class="btn">Submit Appointment</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th style="width: 8%;">Delete</th>
                    <th style="width: 8%;">Update</th>
                </tr>
                <?php
                while ($result = mysqli_fetch_assoc($appointments)) {
                    echo "<tr>";
                    echo "<td>";
                    print_r($result['name']);
                    echo "</td>";
                    echo "<td>";
                    print_r($result['age']);
                    echo "</td>";
                    echo "<td>";
                    print_r($result['date']);
                    echo "</td>";
                    echo "<td>";
                    print_r($result['time']);
                    echo "</td>";
                    echo "<td>";
                    //delete
                    echo "<a href='appointments.php?click=1&appointment_id={$result['appointment_id']}' class='delete-button'>";
                    echo "Delete";
                    echo "</a>";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='updateappointment.php?name={$result['name']}&appointment_id={$result['appointment_id']}&age={$result['age']}&date={$result['date']}&time={$result['time']}' class='update-button'>";
                    echo "Update";
                    echo "</a>";
                    echo "</td>";
                    echo "</tr>";
                };
                ?>
            </table>
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