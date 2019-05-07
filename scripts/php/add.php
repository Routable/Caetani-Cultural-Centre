<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();

  require 'connect.php';
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }

  $exhibittitle = mysqli_real_escape_string($mysqli, stripslashes(filter_input(INPUT_POST, 'exhibitTitle')));
  $exhibitdescription = mysqli_real_escape_string($mysqli, stripslashes(filter_input(INPUT_POST, 'exhibitDesc')));
  $exhibitphotos = stripslashes(filter_input(INPUT_POST, 'exhibitPhoto'));
  $uploadDir = '../../res/img';


  $sql = "INSERT INTO EXHIBITS (TITLE, DESCRIPTION) VALUES ('".$exhibittitle."', '".$exhibitdescription."')";

  if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
    $conn->close();

 ?>
