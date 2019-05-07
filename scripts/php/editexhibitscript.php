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

  $exhibittitle = mysqli_real_escape_string($mysqli, $_POST['exhibitTitle']);
  $exhibitdescription = mysqli_real_escape_string($mysqli, $_POST['exhibitDesc']);
  $exhibitphotos = mysqli_real_escape_string($mysqli, $_POST['exhibitPhoto']);
  $exhibitURL = mysqli_real_escape_string($mysqli, $_POST['exhibitURL']);
  $artistfirstname = mysqli_real_escape_string($mysqli, $_POST['artistFName']);
  $artistlastname = mysqli_real_escape_string($mysqli, $_POST['artistLName']);
  $artistbio = mysqli_real_escape_string($mysqli, $_POST['artistBio']);
  $artistDrop = mysqli_real_escape_string($mysqli, $_POST['artistSelect']);
  $othertitle = mysqli_real_escape_string($mysqli, $_POST['fieldName']);
  $otherdescription = mysqli_real_escape_string($mysqli, $_POST['fieldContent']);
  $categorySelect = mysqli_real_escape_string($mysqli, $_POST['categorySelect']);

  if($exhibitURL != ""){
      $values = "";
      if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $exhibitURL, $vidid)) {
        $values = $vidid[1];
      } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $exhibitURL, $vidid)) {
        $values = $vidid[1];
      } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $exhibitURL, $vidid)) {
        $values = $vidid[1];
      } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $exhibitURL, $vidid)) {
        $values = $vidid[1];
      }
      else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $exhibitURL, $vidid)) {
        $values = $vidid[1];
      }
      $exhibitURL = $values;
    }


  $sql = "UPDATE EXHIBITS SET TITLE='".$exhibittitle."', DESCRIPTION='".$exhibitdescription."', URL='".$exhibitURL."', OTHERTITLE='".$othertitle."', OTHERDESCRIPTION='".$otherdescription."' WHERE ID=".$id;
  $sql2 = "INSERT INTO ARTISTS (FIRST_NAME, LAST_NAME, BIO) VALUES ('".$artistfirstname."', '".$artistlastname."', '".$artistbio."')";
  $sqlcategory = "INSERT INTO CATEGORY (CATEGORY_NAME) VALUES ('".$categoryName."')";




  if ($mysqli->query($sql) === TRUE) { //IF FIRST QUERY COMPLETES SUCCESSFULLY
    $exhibitid = $mysqli->insert_id; //GET ID OF PREVIOUS SQL QUERY - IN THIS CASE, THE PRIMARY KEY OF EXHIBITS

       if($artistDrop == "addnew") { //CHECK TO SEE IF NEW ARTIST ENTERED. IF NOT, WE SKIP THIS
          if ($mysqli->query($sql2) === TRUE) { //INSERT ARTISTS

           $artistid = $mysqli->insert_id;  //GET ID OF PREVIOUS SQL INSERT - IN THIS CASE, THE PRIMARY KEY OF ARTISTS
           $sql3 = "INSERT INTO ARTISTS_EXHIBITS (ARTIST_ID, EXHIBIT_ID) VALUES ('".$artistid."','".$id."')"; //QUERY
           $mysqli->query($sql3); //RUN QUERY

          }
       } else if($artistDrop == "none") { //FOR FUTURE ASSHOLES TO FIX - THIS QUERY COULD CAUSE ISSUES
                  //$sql5 = "INSERT INTO ARTISTS_EXHIBITS (ARTIST_ID, EXHIBIT_ID) VALUES (-1,'".$exhibitid."')";
                  $sql5 = "UPDATE ARTISTS_EXHIBITS SET ARTIST_ID=-1 WHERE EXHIBIT_ID=".$id;
                  $mysqli->query($sql5); //RUN QUERY

        } else { //INSERT FOR ARTISTS THAT ALREADY EXIST
           //$sql4 = "INSERT INTO ARTISTS_EXHIBITS (ARTIST_ID, EXHIBIT_ID) VALUES ('".$artistDrop."','".$exhibitid."')"; //QUERY
           $sql4 = "UPDATE ARTISTS_EXHIBITS SET ARTIST_ID=".$artistDrop." WHERE EXHIBIT_ID=".$id;
           $mysqli->query($sql4); //RUN QUERY
       }

       if($categorySelect == "addnew") { //CHECK TO SEE IF THEY ADDED A CATEGORY
         if ($mysqli->query($sqlcategory) === TRUE) { //INSERT ARTISTS
              $categoryid = $mysqli->insert_id; //GET ID OF PREVIOUS SQL INSERT - IN THIS CASE THE PRIMARY KEY OF CATEGORY
            $sqlcategory2 = "UPDATE CATEGORY_EXHIBITS SET CATEGORY_ID=".$categoryid." WHERE EXHIBIT_ID=".$id;
             $mysqli->query($sqlcategory2); //RUN QUERY
          }

       } else if ($categorySelect == "none") {
         $sql15 = "UPDATE CATEGORY_EXHIBITS SET CATEGORY_ID=-1 WHERE EXHIBIT_ID=".$id;
          $mysqli->query($sql15); //RUN QUERY

       } else{ //INSERT FOR CATEGORY THAT ALREADY EXIST
           $sql14 = "UPDATE CATEGORY_EXHIBITS SET CATEGORY_ID=".$categorySelect." WHERE EXHIBIT_ID=".$id;
           $mysqli->query($sql14); //RUN QUERY
       }

} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error; //ERROR MESSAGE FOR INITIAL EXHIBIT QUERY
}


//--------------------------------------------------- FILE SCRIPTS



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
// Check if file already exists
if (file_exists($target_file2)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
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

$sql4 = "UPDATE ARTISTS SET IMGPATH = '".$target_file2."' WHERE ARTISTS.ID = '".$artistid."'";
if ($mysqli->query($sql4) === TRUE) { echo "True"; }



//--------------------------------------------------------------------

//$files = array_filter($_FILES['upload']['name']); something like that to be used before processing files.
// Count # of uploaded files in array
$total = count($_FILES['fileToUpload']['name']);
// Loop through each file
for($i=0; $i<$total; $i++) {
 $target_file = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//Get the temp file path
$tmpFilePath = $_FILES['fileToUpload']['tmp_name'][$i];
//Make sure we have a filepath
if ($tmpFilePath != ""){
//Setup our new file path
$newFilePath = "../../uploads/" . $_FILES['fileToUpload']['name'][$i];
$newFilePath = preg_replace('/\s+/', '', $newFilePath);
//Upload the file into the temp dir
if(move_uploaded_file($tmpFilePath, $newFilePath)) {
//Handle other code here
}


$sql3 = "INSERT INTO IMAGES (EXHIBIT_ID, PATH) VALUES ('".$id."', '".$newFilePath."')";
if ($mysqli->query($sql3) === TRUE) {
  echo "True";
}
}
}

//--------------------------------------------------------------------
//$files = array_filter($_FILES['upload']['name']); something like that to be used before processing files.
// Count # of uploaded files in array
$total2 = count($_FILES['otherFileToUpload']['name']);
// Loop through each file
for($i=0; $i<$total2; $i++) {
 $target_file2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
//Get the temp file path
$tmpFilePath2 = $_FILES['otherFileToUpload']['tmp_name'][$i];
//Make sure we have a filepath
if ($tmpFilePath2 != ""){
//Setup our new file path
$newFilePath2 = "../../uploads/other/" . $_FILES['otherFileToUpload']['name'][$i];
$newFilePath2 = preg_replace('/\s+/', '', $newFilePath2);
//Upload the file into the temp dir
if(move_uploaded_file($tmpFilePath2, $newFilePath2)) {
//Handle other code here
}

$sqlotherfile = "INSERT INTO FILES (EXHIBIT_ID, PATH) VALUES ('".$id."', '".$newFilePath2."')";
if ($mysqli->query($sqlotherfile) === TRUE) {
  echo "True";
}
}
}


//--------------------------------------------------------------------

//DELETE Images
foreach($_POST['imgdel'] as $pathtodelete){
  //$pathtodelete is the path of the image to delete
  $deletesql = "DELETE FROM IMAGES WHERE EXHIBIT_ID=".$id." AND PATH='".$pathtodelete."'";
  unlink($pathtodelete);
  $mysqli->query($deletesql);
}

//--------------------------------------------------------------------

//DELETE Other Files
foreach($_POST['otherfiledel'] as $pathtodelete){
  //$pathtodelete is the path of the image to delete
  $deletesql = "DELETE FROM FILES WHERE EXHIBIT_ID=".$id." AND PATH='".$pathtodelete."'";
  unlink($pathtodelete);
  $mysqli->query($deletesql);
}

//--------------------------------------------------------------------

$_SESSION['EDITED'] = true;
$mysqli->close();
header("Location: ../../pages/viewexhibit.php?id=".$id);


 ?>
