<?php

// $CLEAR_DATABASE_URL = "mysql://b301d1b1d5515f:7474867e@us-cdbr-iron-east-03.cleardb.net/heroku_387cf972599d81e?reconnect=true";
//
// $url = parse_url(getenv($CLEAR_DATABASE_URL));
//
// $servername = $url["host"];
// $username = $url["user"];
// $pword = $url["pass"];
// $dbname = substr($url["path"], 1);

$dbname = "heroku_387cf972599d81e";
$username ="b301d1b1d5515f";
$pword = "7474867e";
$servername = "us-cdbr-iron-east-03.cleardb.net";

// Create connection
$conn = new mysqli($servername, $username, $pword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Now reading database:
$sql = "SELECT * FROM pdfdocs";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $rows = array();
    while($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    echo json_encode($rows);
}
else {
  echo 'hahaha';
}

$conn->close();
?>
