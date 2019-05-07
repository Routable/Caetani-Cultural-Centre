<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require 'connect.php';
//create and issue the query
$targetname = $_SESSION['targetname'];
$targetpasswd = stripslashes(filter_input(INPUT_POST, 'currentPassword'));
$sql = "SELECT * FROM LOGIN WHERE EMAIL = '".$targetname."'";
//$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
$result=$mysqli->query($sql) or die;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $hash = $row["PASSWORD"];
    }
}
if(password_verify($targetpasswd, $hash)){
  $_SESSION['targetname'] = $targetname;
  $_SESSION['user'] = $targetname;


    $passwordconfirm = $_POST['passwordConfirm'];
    $currentpassword = $_POST['currentPassword'];
    $newpassword = $_POST['newPassword'];

    $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
    $update = "UPDATE LOGIN SET PASSWORD = '".$newpassword."' WHERE EMAIL = '".$targetname."'";

    $result1=$mysqli->query($update) or die;
    $_SESSION['PASS'] = true;
    header("Location: ../../pages/settings.php");
  }else {
    $_SESSION['WRONG'] = true;
    header("Location: ../../pages/settings.php");
  }

?>
