<?php
include('session.php');

$dbname = getenv("DBNAME");
$username =getenv("USERNAME");
$pword = getenv("PASSWORD");
$servername = getenv("SERVERNAME")

$act = $_POST['act'];

if ($act == 'up'){

$dir = "pdfs/";
$name = $_FILES['newpdf']['name'];
$uploaded = 0;

$nfile = $dir . $_POST["ffunc"] . "/" . $name;
$uploadOk = 1;
//
if (is_dir($dir) && is_writable($dir)) {
} else {
    echo 'writerror';
}

$imageFileType = pathinfo($nfile,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
    // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    // if($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ". <br>";
    //     $uploadOk = 1;
    // } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }
// }
// Check if file already exists
if (file_exists($nfile)) {
    unlink($nfile);
}
// Check file size
// if ($_FILES["newpdf"]["size"] > 500000) {
//     echo "sizeerror";
//     $uploadOk = 0;
// }
// Allow certain file formats
if($imageFileType != "pdf") {
    echo "typeerror";
    $uploadOk = 0;
}
//
// echo $uploadOk;
// // echo $UPLOAD_ERR_OK;

// // echo "error: " . $_FILES["ERROR"] . "<br>";
// // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["newpdf"]["tmp_name"], $nfile)) {
        $uploaded = 1;
        // echo "no";
    } else {
        $uploaded = 0;
        echo "error!";
    }
}

if ($uploaded == 1){
  $title = $_POST['title'];
  $column = $_POST['ffunc'];
  //


  //
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $safetitle = mysqli_real_escape_string($conn,$title);

  $sql = "INSERT INTO pdfdocs (filepath, filename, columncat)
  VALUES ('$nfile','$safetitle', '$column')";

  if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  //
  $sql = "SELECT * FROM pdfdocs";
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
}




elseif ($act == 'del'){

  $delid = $_POST['id'];
  $delpath = $_POST['path'];

  // echo $pword;
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
  $sql = "DELETE FROM pdfdocs WHERE id='$delid'";

  if ($conn->query($sql) === TRUE) {

  } else {
    echo "error";
  }

  if (file_exists($delpath)) {
      unlink($delpath);
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

  $conn->close();

  }





?>
