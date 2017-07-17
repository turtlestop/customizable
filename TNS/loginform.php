<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
<title>TNS Intranet</title>
<head>
<link href="styles/main.css" rel="stylesheet" type="text/css">
</head>
<body>

<header>
<div id="headerdiv">
<img id="headerimg" src="images/header.jpg" height="" width="" alt="The Awesome Nightly Show Intranet">
</div>
</header>

<div id="homef">
<img class="icon" src="images/home.png" height="42" width="42" onmouseover="this.src='images/home2.png'" onmouseout="this.src='images/home.png'" onclick="location.href='index.html'">
</div>
<div id="editf">
<img class="icon" src="images/editmb.png" height="42" width="42" onmouseover="this.src='images/editmb2.png'" onmouseout="this.src='images/editmb.png'" onclick="location.href='login.php'">
</div>

<div id="wrap">
<div id="main">
  <div id="uform">
  <h2>Login Form</h2>
  <div id="login">
  <h3>Please enter your login details:</h3>
  <form action="" method="post">
  <label>UserName :</label>
  <input id="name" name="username" placeholder="username" type="text">
  <label>Password :</label>
  <input id="password" name="password" placeholder="**********" type="password">
  <input name="submit" type="submit" value=" Login ">
  <span><?php echo $error; ?></span>
  </form>
  </div>
</div>
</div>
</body>
</html>
