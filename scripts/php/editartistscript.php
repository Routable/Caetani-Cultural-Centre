<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
  require 'connect.php';
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

  $id     = $_GET['id'];
  $id     = mysqli_real_escape_string($mysqli, $id);

  $artistfname = mysqli_real_escape_string($mysqli, $_POST['firstName']);
  $artistlname = mysqli_real_escape_string($mysqli, $_POST['lastName']);
  $artistbio = mysqli_real_escape_string($mysqli, $_POST['artistBio']);
  $artistimg = mysqli_real_escape_string($mysqli, $_POST['IMGPATH']);

  $target_dir2 = "../../uploads/artists/";
  $target_file2 = $target_dir2 . basename($_FILES["artistImage"]["name"]);
  $target_file2 = preg_replace('/\s+/', '', $target_file2);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["artistImage"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["artistImage"]["tmp_name"], $target_file2)) {
          echo "The file ". basename( $_FILES["artistImage"]["name"]). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
  if($uploadOk == 1){
    $sql = "UPDATE ARTISTS SET FIRST_NAME='".$artistfname."', LAST_NAME='".$artistlname."', BIO='".$artistbio."', IMGPATH='".$target_file2."' WHERE ID=".$id;
    if($artistimg != NULL){
      unlink($artistimg);
    }
  } else{
    $sql = "UPDATE ARTISTS SET FIRST_NAME='".$artistfname."', LAST_NAME='".$artistlname."', BIO='".$artistbio."' WHERE ID=".$id;
  }

  $mysqli->query($sql);

  $_SESSION['EDITED'] = true;
  $mysqli->close();
  header("Location: ../../pages/viewartist.php?id=".$id);

  ?>
