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
$query = "SELECT * FROM ARTISTS A, ARTISTS_EXHIBITS AE, IMAGES I, EXHIBITS E WHERE A.ID = AE.ARTIST_ID AND E.ID = '".$id."' AND AE.EXHIBIT_ID = '".$id."' AND I.EXHIBIT_ID = '".$id."'";
$result = mysqli_query($mysqli,$query);

while($row = mysqli_fetch_array($result)) {
  $exdescription = $row['DESCRIPTION'];
  $extitle = $row['TITLE'];
  $youtube = $row['URL'];
  $artistfname = $row['FIRST_NAME'];
  $artistlname = $row['LAST_NAME'];
  $artistdesc = $row['BIO'];
  $artistimg = $row['IMGPATH'];
  $othertitle = $row['OTHERTITLE'];
  $otherdesc = $row['OTHERDESCRIPTION'];
}

$query2 = "SELECT * FROM FILES WHERE EXHIBIT_ID =".$id;
$result2 = mysqli_query($mysqli, $query2);
while($filerow = mysqli_fetch_array($result2)){
  $otherfiles = $filerow['PATH'];
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
      <div class="jumbotron">
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

    <!-- FOURTH FIELD -->
       <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">
        <i class="glyphicon glyphicon-save-file" style="padding-right:5px"></i><a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Photos</a>
      </h2>
    </div>
    <div id="collapse4" class="panel-collapse collapse in">


        <?php
        $sql = "SELECT * FROM IMAGES WHERE EXHIBIT_ID=".$id;
        $result = $mysqli->query($sql);

        if($result->num_rows > 0){
        $toPrint = "<div class=\"img-thumbnail center-block img-responsive\">
  <div id=\"exhibitImages\" class=\"carousel slide\" data-ride=\"carousel\">
    <ol class=\"carousel-indicators\">";

        $firstRow = true;
        $counter = 0;
        while($counter < $result->num_rows){
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
          while($row = mysqli_fetch_array($result)) {
            if($firstRow){
              $toPrint .= "<div class=\"item active\">
          <img src=\"".$row['PATH']."\" style=\"width:100%;\" class=\"img-thumbnail center-block img-responsive\"></div>";
              $firstRow = false;
            } else{
              $toPrint .= "<div class=\"item\">
          <img src=\"".$row['PATH']."\" style=\"width:100%;\" class=\"img-thumbnail center-block img-responsive\"></div>";
            }
            }
if($result->num_rows > 1){
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
echo $toPrint;
        }
        ?>


  </div>
</div>
</div>
</div>
</div>
 <!-- FOURTH FIELD END -->


   <!-- ABOUT ARTIST FIELD -->
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
          if($artistimg != "../../uploads/artists/"){
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
      <h2> <?php echo $otherdesc; ?> </h2>

      </div>
    </div>
  </div>
</div> <!-- Hiding div -->

    <!-- Other Fields END -->


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
          $otherfiles = $filerow['PATH'];
          echo '<h2><a href="'.$otherfiles.'">'.substr($otherfiles, 20).'</a></h2>';
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
