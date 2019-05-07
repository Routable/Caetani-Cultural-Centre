<?php
  include_once("../scripts/php/analyticstracking.php")
?>

<?php
require '../scripts/php/connect.php';
if ($mysqli->connect_error){
  die("Connection failed: " . $mysqli->connect_error);
}

$id = $_GET['id'];
$id = mysqli_real_escape_string($mysqli,$id);

$incrementviews = "UPDATE EXHIBITS SET VIEWS = VIEWS + 1 WHERE ID = '".$id."'";
$result = mysqli_query($mysqli,$incrementviews);

//$query = "SELECT * FROM EXHIBITS WHERE ID = '".$id."'";
$query = "SELECT * FROM ARTISTS A, ARTISTS_EXHIBITS AE, EXHIBITS E WHERE A.ID = AE.ARTIST_ID AND E.ID = '".$id."' AND AE.EXHIBIT_ID = '".$id."'";
$result = mysqli_query($mysqli,$query);

while($row = mysqli_fetch_array($result)) {
  $exdescription = strip_tags($row['DESCRIPTION'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
  $extitle = strip_tags($row['TITLE'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
  $youtube = strip_tags($row['URL'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
  $artistfname = strip_tags($row['FIRST_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
  $artistlname = strip_tags($row['LAST_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
  $artistdesc = strip_tags($row['BIO'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
  $artistimg = strip_tags($row['IMGPATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
  $othertitle = strip_tags($row['OTHERTITLE'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
  $otherdesc = strip_tags($row['OTHERDESCRIPTION'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
}

$query2 = "SELECT * FROM FILES WHERE EXHIBIT_ID =".$id;
$result2 = mysqli_query($mysqli, $query2);
while($filerow = mysqli_fetch_array($result2)){
  $otherfiles = strip_tags($filerow['PATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Caetani Cultural Center Exhibit Dashboard">
    <meta name="keywords" content="Caetani Cultural Center, Exhibit, Dashboard">
    <meta name="author" content="Okanagan College Capstone Project">

    <title><?php echo $extitle ?></title>

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
<style>

    .required:after { content:" *"; color: red; }
</style>
</head>

  <body>
    <div class="container" style="padding-top:20px">


    <div class="container">

      <div class="jumbotron" style="word-wrap: break-word;">
        <?php
          echo '<h1><center>'.$extitle.'</center></h1>';
        ?>
      </div>

   <!-- DESCRIPTION FIELD -->
       <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">
        <i class="glyphicon glyphicon-file" style="padding-right:5px"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Description</a>
      </h2>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">

          <?php
            echo '<p>'.$exdescription.'</p>';
          ?>

      </div>
    </div>
  </div>
 <!-- DESCRIPTION FIELD END -->

     <!-- Other Fields -->
    <?php
    if($otherdesc == NUll && $othertitle == NULL){
      echo "<div class = \"hide\">";
    }else {
      echo "<div>";
    }
     ?>
       <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">
        <i class="glyphicon glyphicon-search" style="padding-right:5px"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapse5"><?php echo $othertitle; ?></a>
      </h2>
    </div>
    <div id="collapse5" class="panel-collapse collapse in">
      <div class="panel-body">
      <p> <?php echo $otherdesc; ?> </p>

      </div>
    </div>
  </div>
</div> <!-- Hiding div -->

    <!-- Other Fields END -->

    <!-- FOURTH FIELD -->

    <?php
    $sql = "SELECT * FROM IMAGES WHERE EXHIBIT_ID=".$id;
    $resultimages = $mysqli->query($sql);
    if($resultimages->num_rows > 1){

      $toPrint = ' <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">
        <i class="glyphicon glyphicon-save-file" style="padding-right:5px"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Photos</a>
      </h2>
    </div>
    <div id="collapse4" class="panel-collapse collapse in">

        <div class="img-thumbnail center-block img-responsive">
  <div id="exhibitImages" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">';

        $firstRow = true;
        $counter = 0;
        while($counter < $resultimages->num_rows){
          if($firstRow){
            $toPrint .= "<li data-target=\"#exhibitImages\" data-slide-to=\"0\" class=\"active\"></li>";
            $firstRow = false;
          }else{
            $toPrint .= "<li data-target=\"#exhibitImages\" data-slide-to=\"".$counter."\"></li>";
          }
          $counter++;
        }

        $toPrint .= "</ol><div class=\"carousel-inner\">";
        $firstRow = true;
          while($row = mysqli_fetch_array($resultimages)) {
            if($firstRow){
              $toPrint .= "<div class=\"item active\">
          <img src=\"".strip_tags($row['PATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>')."\" style=\"width:100%;\" class=\"img-thumbnail center-block img-responsive\"></div>";
              $firstRow = false;
            } else{
              $toPrint .= "<div class=\"item\">
          <img src=\"".strip_tags($row['PATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>')."\" style=\"width:100%;\" class=\"img-thumbnail center-block img-responsive\"></div>";
            }
            }
if($resultimages->num_rows > 1){
            $toPrint .= "
    <a class=\"left carousel-control\" href=\"#exhibitImages\" data-slide=\"prev\">
      <span class=\"glyphicon glyphicon-chevron-left\"></span>
      <span class=\"sr-only\">Previous</span>
    </a>
    <a class=\"right carousel-control\" href=\"#exhibitImages\" data-slide=\"next\">
      <span class=\"glyphicon glyphicon-chevron-right\"></span>
      <span class=\"sr-only\">Next</span>
    </a>";
  }
  $toPrint .= '  </div>
  </div>
  </div>
  </div>
  </div>';
echo $toPrint;
} else if($resultimages->num_rows > 0){
    while($row = mysqli_fetch_array($resultimages)) {
      echo "<img src=\"". strip_tags($row['PATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>') . "\" style=\"max-width:100%;\" class=\"img-thumbnail center-block img-responsive\">";
    }
}
        ?>



 <!-- FOURTH FIELD END -->


   <!-- ABOUT ARTIST FIELD -->
   <?php
   if ($artistfname == "None") {
     echo "<div class = \"hide\">";
   }else {
     echo "<div>";
   }
   ?>
       <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">
        <i class="glyphicon glyphicon-user" style="padding-right:5px"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Artist</a>
      </h2>
    </div>
    <div id="collapse2" class="panel-collapse collapse in">
      <div class="panel-body">
        <h2><center><?php echo $artistfname." ".$artistlname ?></center></h2>
           <!-- THIS IS WHERE YOU WOULD INSERT THE QUERY TO SPEW OUT THE IMAGE -->
        <?php
        if($artistfname != "None"){
          if($artistimg != "../../uploads/artists/" && $artistimg != NULL){
            echo "<img src=\"". $artistimg . "\" alt=\"". $artistimg ."\" class=\"img-thumbnail center-block img-responsive\"><br>
            <div class=\"panel panel-default\">
             <div class=\"panel-heading\">About</div>";
          }
          echo "<div class=\"panel-body\"><p>" .$artistdesc."</p></div>";
          echo "</div>";
        }
        ?>

      </div>
    </div>
  </div>
  </div>
  <div> <!-- Hiding Div -->
 <!-- ABOUT ARTIST FIELD END -->



   <!-- VIDEOS FIELD -->
   <?php
   if ($youtube == NULL) {
     echo "<div class = \"hide\">";
   }else {
     echo "<div>";
   }
   ?>
       <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">
        <i class="glyphicon glyphicon-film" style="padding-right:5px"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Videos</a>
      </h2>
    </div>
    <div id="collapse3" class="panel-collapse collapse in">

       <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo $youtube ?>" allowfullscreen></iframe>
      </div>

    </div>
  </div>
</div>
 <!-- VIDEO FIELD END -->





        <!-- Other Files -->
    <?php
    if($otherfiles == NULL){
      echo "<div class = \"hide\">";
    }else {
      echo "<div>";
    }
     ?>
       <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">
        <i class="glyphicon glyphicon-search" style="padding-right:5px"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Other Files</a>
      </h2>
    </div>
    <div id="collapse5" class="panel-collapse collapse in">
      <div class="panel-body">
        <?php
        $query2 = "SELECT * FROM FILES WHERE EXHIBIT_ID =".$id;
        $result2 = mysqli_query($mysqli, $query2);
        while($filerow = mysqli_fetch_array($result2)){
          $otherfiles = strip_tags($filerow['PATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');;
          echo '<p><a href="'.$otherfiles.'">'.substr($otherfiles, 20).'</a></p>';
        }
        ?>


      </div>
    </div>
  </div>
</div> <!-- Hiding div -->

<!-- Category -->
<?php

$catquery = "SELECT CATEGORY_ID FROM CATEGORY_EXHIBITS WHERE EXHIBIT_ID =".$id;
$catresult = mysqli_query($mysqli, $catquery);
while($catrow = mysqli_fetch_array($catresult)){
  $excatid = strip_tags($catrow['CATEGORY_ID'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
}
$catquery = "SELECT * FROM CATEGORY WHERE CATEGORY_ID =".$excatid;
$catresult = mysqli_query($mysqli, $catquery);
while($catrow = mysqli_fetch_array($catresult)){
  $excatid = strip_tags($catrow['CATEGORY_ID'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
  $excatname = strip_tags($catrow['CATEGORY_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
}

if($excatid == -1){
 echo "<div class = \"hide\">";
}else {
 echo "<div>";
}
?>
  <div class="panel panel-default">
<div class="panel-heading">
 <h2 class="panel-title">
   <i class="glyphicon glyphicon-search" style="padding-right:5px"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Category</a>
 </h2>
</div>
<div id="collapse5" class="panel-collapse collapse in">
 <div class="panel-body">
 <p> <?php echo $excatname; ?> </p>

 </div>
</div>
</div>
</div> <!-- Hiding div -->

<!-- Category END -->
<?php
$similarexsql = "SELECT * FROM EXHIBITS E, CATEGORY_EXHIBITS CE WHERE CE.CATEGORY_ID= ".$excatid." AND CE.EXHIBIT_ID = E.ID AND NOT E.ID = ".$id." AND NOT CE.EXHIBIT_ID =".$id;
$similarexresult = mysqli_query($mysqli, $similarexsql);
if($excatid == -1 || $similarexresult->num_rows == 0){
 echo "<div class = \"hide\">";
}else {
 echo "<div>";
}
?>
  <div class="panel panel-default">
<div class="panel-heading">
 <h2 class="panel-title">
   <i class="glyphicon glyphicon-search" style="padding-right:5px"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapse6">See Others in Category</a>
 </h2>
</div>
<div id="collapse5" class="panel-collapse collapse in">
 <div class="panel-body">
  <?php
 $counter = 0;
 while($similarrow = mysqli_fetch_array($similarexresult)){
   if($counter < 3){
     echo '<p><a href="exhibit.php?id='.$similarrow['EXHIBIT_ID'].'">'.strip_tags($similarrow['TITLE'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'</a></p>';
   }
   $counter += 1;
 }
 ?>

 </div>
</div>
</div>
</div> <!-- Hiding div -->

 <!-- Other Files END -->

      <footer class="footer">
        <p><a href="https://caetani.org/">Caetani Cultural Center - 2018 &copy; </a></p>
      </footer>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
