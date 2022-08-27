<?php
include("connection.php");
// check if user is logged in
function check_login($con)
{
    if (isset($_SESSION["user_id"])) {
        $id = $_SESSION["user_id"];
        // find a user with user id of $id in the database
        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) { // check if the results are valid
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        };
    } else {
        // false for user is not logged in
        return false;
    };
};

function random_num($length)
{

    $text = "";
    if ($length < 5) {
        $length = 5;
    };
    $len = rand(4, $length);
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    };
    return $text;
};

function deleteAppointment($appointment_id)
{
    $queryDelete = "delete from appointments where appointment_id = $appointment_id";
    mysqli_query($GLOBALS['con'], $queryDelete);
    header("Location: appointments.php");
    die;
};
