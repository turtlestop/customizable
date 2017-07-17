
<?php
include('session.php');
?>

<!DOCTYPE html>
<html>
<head>
<link href="styles/main.css" rel="stylesheet" type="text/css">
</head>
<body>

<!-- <script type="text/javascript" src="scripts/pdfobject.js"></script> -->
<!-- <script type="text/javascript" src="scripts/edit.js"></script> -->

<header>
  <div id="headerdiv">
    <img id="headerimg" src="images/header.jpg" height="" width="" alt="The Awesome Nightly Show Intranet" onclick="location.href='logout.php'">
  </div>
</header>

<div id="homef">
  <img class="icon" src="images/home.png" height="42" width="42" onmouseover="this.src='images/home2.png'" onmouseout="this.src='images/home.png'" onclick="location.href='logout.php'">
</div>
<div id="editf">
  <img class="icon" src="images/editmb.png" height="42" width="42" onmouseover="this.src='images/editmb2.png'" onmouseout="this.src='images/editmb.png'" onclick="location.href='profile.php'">
</div>

<div id="wrap">
  <div id="welcome">
  <b id="welcome">Welcome, <i><?php echo $user_check; ?>!</i></b>
</div>

<div id="editdiv">
  <div id="editimg">
      <img height="80px" width="80px" src="images/editmb.png" onmouseover="this.src='images/editmb2.png'" onmouseout="this.src='images/editmb.png'" onclick="location.href='editbb.php'">
  </div>

  <div id="edittxt">Edit Bulletin Board</div>
</div>

  <div id="uploaddiv">
    <div id="uploadimg">
      <img height="80px" width="80px" src="images/upload.png" onmouseover="this.src='images/upload2.png'" onmouseout="this.src='images/upload.png'" onclick="location.href='uploadform.php'">
    </div>
    <div id="edittxt">Upload New PDFs</div>
  </div>

  <div id="homediv">
    <div id="homeimg">
      <img height="80px" width="80px" src="images/home.png" onmouseover="this.src='images/home2.png'" onmouseout="this.src='images/home.png'" onclick="location.href='logout.php'">
    </div>
    <div id="hometxt">Back to Main Intranet!</div>
  </div>
</div>

</body>
</html>
