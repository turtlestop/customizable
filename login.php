<?php

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is EMPTY";
}
else
{

// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];

$servername = getenv("SERVERNAME");
$rootname =getenv("USERNAME");
$rootword = getenv("PASSWORD");
$dbname = getenv("DBNAME");

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = new mysqli($servername, $rootname, $rootword, $dbname);
// echo $connection;
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
// // SQL query to fetch information of registerd users and finds user match.
$query = "SELECT * from login where password='$password' AND username='$username'";
$result = $connection->query($query);
// $error = $password;
// echo $result;
if ($result->num_rows > 0) {
  // $error = "hmm";
$_SESSION['login_user']=$username; // Initializing Session
$_SESSION['pass'] = $password;
$_SESSION['test'] = "green";

$error = 'ok, SESSION[login_user] is ' . $_SESSION['login_user'] . ' and SESSION[pass] is ' . $_SESSION['pass'];
// $error = 'cooleo';
header("location: profile.php"); // Redirecting To Other Page
}
 else {

$error = "Username or Password is invalid";
}
$connection->close();; // Closing Connection
}
}
?>
