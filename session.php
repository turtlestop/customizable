<?php

$dbname = "heroku_387cf972599d81e";
$rootname ="b301d1b1d5515f";
$rootword = "7474867e";
$servername = "us-cdbr-iron-east-03.cleardb.net";


// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = new mysqli($servername, $rootname, $rootname, $dbname);
// Selecting Database
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
$pass = $_SESSION['pass'];
// SQL Query To Fetch Complete Information Of User
$check=$connection->query("select username from login where username='$user_check'");
if($check->num_rows == 0){
$connection->close(); // Closing Connection


header('Location: index.html'); // Redirecting To Home Page
}
?>
