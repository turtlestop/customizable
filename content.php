<?php

$dbname = getenv("DBNAME");
$username = getenv("USERNAME");
$pword = getenv("PASSWORD");
$servername = getenv("SERVERNAME");

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
