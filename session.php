<?php

$dbname = getenv("DBNAME");
$username =getenv("USERNAME");
$password = getenv("PASSWORD");
$servername = getenv("SERVERNAME");

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = new mysqli($servername, $username, $password, $dbname);
// Selecting Database
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
$pass = $_SESSION['pass'];
// SQL Query To Fetch Complete Information Of User
$check=$connection->query("select username from login where username='$user_check'");
if($check->num_rows == 0){
$connection->close(); // Closing Connection


header('Location: loginform.php'); // Redirecting To Home Page
}
?>
