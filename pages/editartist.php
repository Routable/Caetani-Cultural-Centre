<?php
include("../scripts/php/logincheck.php");
?>

<?php
require '../scripts/php/connect.php';
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$id     = $_GET['id'];
$id     = mysqli_real_escape_string($mysqli, $id);
$query  = "SELECT * FROM ARTISTS WHERE ID = '" . $id . "'";
$result = mysqli_query($mysqli, $query);

while ($row = mysqli_fetch_array($result)) {
    $artistbio = $row['BIO'];
    $artistfname       = $row['FIRST_NAME'];
    $artistlname       = $row['LAST_NAME'];
    $artistimage       = $row['IMGPATH'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Caetani Cultural Center Exhibit Dashboard">
    <meta name="keywords" content="Caetani Cultural Center, Exhibit, Dashboard, Add">
    <meta name="author" content="Okanagan College Capstone Project">
    <script src="../scripts/js/validation.js"></script>

    <title>Edit Artist</title>

     <!-- Latest compiled and minified CSS. This is not local to the server, we are pulling this from the Bootstrap repo directly. -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <link href="../res/img/favicon.png" rel="icon" type="image/png" sizes="16x16">

    <!-- Custom CSS for the page(s). Any CSS changes to the primary site should be done in this file location -->
    <link href="../css/basewebsite.css" rel="stylesheet">

    <!-- Custom Fonts and Emoticons - look up Font Awesome for information on how to use.  -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

     <!-- JQUERY  -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
 <div class="container">
   <a href = "main.php">
      <img src="../res/img/logo.png" alt="Caetani Cultural Center"  class="img-responsive">
    </a>
</div>
    <div id="wrapper">
        <!-- Navigation for the pages.  -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>



            </div>
            <!-- /.navbar-header -->


            <div class="navbar-default sidebar" role="navigation">
                 <div class="sidebar-nav navbar-collapse collapse-in collapse" aria-expanded="false" style="height: 1px;">
                   <?php require '../scripts/php/navbarlist.php'; ?>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Artist</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

<form action="../scripts/php/editartistscript.php?id=<?php echo $id ?>" method="post" autocomplete="off" enctype="multipart/form-data">


    <div class="form-group">
         <label for="firstName">First Name</label>
         <input type="text" id="firstName" name="firstName" class="form-control" maxlength="49" onkeyup="validateEditArtist()" value="<?php echo $artistfname ?>">
         <label id="arFName-error" class="alert alert-danger" style="display:none">First name must be filled out</label>
    </div>

    <div class="form-group">
         <label for="lastName">Last Name</label>
         <input type="text" id="lastName" name="lastName" class="form-control" maxlength="49" onkeyup="validateEditArtist()" value="<?php echo $artistlname ?>">
         <label id="arLName-error" class="alert alert-danger" style="display:none">Last name must be filled out</label>
    </div>

    <div class="form-group">
      <label for="artistBio">Artist Bio</label>
      <textarea  id="artistBio" name="artistBio" rows="3" style="max-width:100%;" class="form-control" maxlength="1999" onkeyup="validateEditArtist()"><?php echo $artistbio ?></textarea>
      <label id="arDesc-error" class="alert alert-danger" style="display:none">Description must be filled out</label>
    </div>

    <!-- IMAGES FIELD -->
       <div class="panel panel-primary">
    <div class="panel-heading">
      <h2 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Images</a>
      </h2>
    </div>
    <div id="collapse2" class="panel-collapse collapse in">

      <?php

      if(strcmp($artistimage, "../../uploads/artists/") !== 0){
        if($artistimage != NULL) {
        echo '<img src="'.$artistimage.'" width="300" height="200" class="img-thumbnail img-responsive"></div>';
      }else {
        echo '</div>';
      }
      }
      ?>

      <div class="form-group">
      <br>

        &nbsp;<label for="artistImage">Replace/Add Picture of Artist</label>
        <small>supported file types: JPEG, PNG, and GIF.</small>
        &nbsp;<input type="file" accept="image/png,image/GIF, image/JPEG" name="artistImage" style="max-width:100%;" id="artistImage" class="btn btn-default">
     </div>
</div>

<div class="form-group">
  <button id="saveButton" type="submit" class="btn btn-primary btn-lg">Save Changes</button>
</div>
</form>
 <!-- IMAGE FIELD END -->
</body>
</html>
