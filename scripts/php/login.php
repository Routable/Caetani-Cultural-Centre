<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require 'connect.php';
//create and issue the query
$targetname = strtolower(stripslashes(filter_input(INPUT_POST, 'user_email')));
$targetpasswd = stripslashes(filter_input(INPUT_POST, 'password'));

$targetname = strip_tags($targetname,'<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');

$sql = "SELECT * FROM LOGIN WHERE EMAIL = '".$targetname."'";
//$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
$result=$mysqli->query($sql) or die;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $hash = $row["PASSWORD"];
      $isDisabled = $row['STATUS'];
    }
}
if($isDisabled=='DISABLED'){
  header("Location: ../../index.php");
} else{
if(password_verify($targetpasswd, $hash)){
  $_SESSION['targetname'] = $targetname;
  $_SESSION['user'] = $targetname;
 // header("Location: ../../pages/main.php");



header("Location: ../../pages/main.php");
} else {
  $_SESSION['error']=true;
  $_SESSION['attempts']=$_SESSION['attempts'] + 1;
  header("Location: ../../index.php");
}
}
?>
