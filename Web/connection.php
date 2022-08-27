<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "gymusers";
$dbport = 3307;


// connect to the data base
if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport)) { // if the connection fails it returns an error otherwise it return $con
    die("failed to connect to the database");
};
