<?php
// echo "HELLO";

$fname = $_POST["fname"];
$fmsg = $_POST["fmsg"];
$act = $_POST["act"];

$dbname = getenv("DBNAME");
$username =getenv("USERNAME");
$password = getenv("PASSWORD");
$servername = getenv("SERVERNAME");

if ($act === "save"){
  include('session.php');

  // $password = $_SESSION['pass'];
  // $username = $_SESSION['login_user'];

  if ($_FILES["image"] == NULL){
    $filename = "none";
  }
  elseif ($_FILES['image'] !== NULL) {
    if (is_dir('imageuploads') && is_writable('imageuploads')) {
    } else {
        echo '     writerror!     ';
    }
    $uploadOk = 1;
    $path = $_FILES['image']['name'];
    $ext = pathinfo($path,PATHINFO_EXTENSION);
    $fprefix = uniqid();
    $filename = 'imageuploads/' . $fprefix . '.' . $ext;

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    $filetype = substr($check['mime'], 0, 5);
    // echo $filetype;
    if($filetype !== 'image') {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if (file_exists($filename)) {
      // echo "     NEW NAME     ";
        $nprefix = uniqid();
        $filename = 'imageuploads/' . $nprefix . '.' . $ext;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $filename)) {
        } else {
            echo "Error";
        }
  }
}
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$safename = mysqli_real_escape_string($conn,$fname);
$safemsg = mysqli_real_escape_string($conn,$fmsg);

$sql = "INSERT INTO bulletin (name, msg, image)
VALUES ('$safename','$safemsg', '$filename')";

if ($conn->query($sql) === FALSE) {
  echo "Damn it! Error: " . $sql . "<br>" . $conn->error;
}

$sql = "SELECT * FROM bulletin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $rows = array();
    while($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo "No Messages Yet!";
}

$conn->close();
}

elseif ($act === "load") {
  // Create connection
  // $pword = 'root';
  // $username = 'root';
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Now reading database:
  $sql = "SELECT * FROM bulletin";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      $rows = array();
      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      echo json_encode($rows);
  }

  $conn->close();
}
elseif ($act === "del"){
  include('session.php');
  $del = $_POST["delid"];
  $delpath = $_POST["delpath"];

  // $password = $_SESSION['pass'];
  // $username = $_SESSION['login_user'];

  // echo "tesingg";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      echo "error";
  }
  // Ok writing new message to database:
  // $nname = mysql_real_escape_string($fname);
  // $nmsg = mysql_real_escape_string($nmsg);
  // echo $nname;
  // echo $nmsg;
  $sql = "DELETE FROM bulletin WHERE id='$del'";

  if ($conn->query($sql) === TRUE) {

  } else {
    echo "error";
  }
  if ($delpath != "none" && $delpath !=""){
  if (file_exists($delpath)) {
      unlink($delpath);
  }}

  // Now reading database:
  $sql = "SELECT * FROM bulletin";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      $rows = array();
      while($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      echo json_encode($rows);
  }

  $conn->close();

  }


?>
