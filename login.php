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

// $CLEAR_DATABASE_URL = "mysql://b301d1b1d5515f:7474867e@us-cdbr-iron-east-03.cleardb.net/heroku_387cf972599d81e?reconnect=true";
//
// $url = parse_url(getenv($CLEAR_DATABASE_URL));
//
// $servername = $url["host"];
// $rootname = $url["user"];
// $rootword = $url["pass"];
// $dbname = substr($url["path"], 1);

$dbname = "heroku_387cf972599d81e";
$rootname = "b301d1b1d5515f";
$rootword = "7474867e";
$servername = "us-cdbr-iron-east-03.cleardb.net";

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = new mysqli($servername, $rootname, $rootword, $dbname);
// echo $connection;
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

// // To protect MySQL injection for Security purpose
// $username = stripslashes($username);
// $password = stripslashes($password);
// $username = mysqli_real_escape_string($username);
// $password = mysqli_real_escape_string($password);

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
// header("location: profile.php"); // Redirecting To Other Page
}
 else {

$error = "Username or Password is invalid";
}
$connection->close();; // Closing Connection
}
}
?>
