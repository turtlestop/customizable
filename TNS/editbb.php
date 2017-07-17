<?php
include('session.php');
?>

<!DOCTYPE html>
<html>
<head>
<link href="styles/main.css" rel="stylesheet" type="text/css">
</head>
<body onload="loadeboard()">

<script type="text/javascript" src="scripts/edit.js"></script>

<header>
<div id="headerdiv">
<img id="headerimg" src="images/header.jpg" height="" width="" alt="The Awesome Nightly Show Intranet">
</div>
</header>

<div id="homef">
<img class="icon" src="images/home.png" height="42" width="42" onmouseover="this.src='images/home2.png'" onmouseout="this.src='images/home.png'" onclick="location.href='logout.php'">
</div>
<div id="editf">
<img class="icon" src="images/editmb.png" height="42" width="42" onmouseover="this.src='images/editmb2.png'" onmouseout="this.src='images/editmb.png'" onclick="location.href='profile.php'">
</div>

<div id="wrap">

  <div id="form">
    <div style="color: black">
  </div>
    <div id="fline1">
      <div id="fname">Name: <input type="text" id="name" value=""></div>
    </div>

    <div id="fline2">
      <div id="fmess">
        Message:
      </div>
      <div id="msgbox">
        <textarea type="text" id="fmsg"></textarea>
      </div>
    </div>

    <div id="buttondiv">
    <div id="imgupload">
      Attach Image: <input type="file" id="image" data-button-text="asf">
    </div>
    <div id="submit">
      <button type="button" onclick="savef()">Post Message.</button>
    </div>
  </div>
  <div id="msgs">
  </div>
</div>

</body>
</html>
