<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require 'connect.php';
$targetname = $_POST['accountSelect'];
$sql = "SELECT * FROM LOGIN WHERE EMAIL = '".$targetname."'";
$result=$mysqli->query($sql) or die;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $update = "DELETE FROM LOGIN WHERE EMAIL = '".$targetname."'";

      $result1=$mysqli->query($update) or die;
      $_SESSION['DIS'] = true;
      header("Location: ../../pages/settings.php");
    }
  }else {
    $_SESSION['WRONG'] = true;
    header("Location: ../../pages/settings.php");
  }
?>
