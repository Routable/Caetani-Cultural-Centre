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
$query  = "SELECT * FROM EXHIBITS WHERE ID = '" . $id . "'";
$result = mysqli_query($mysqli, $query);

while ($row = mysqli_fetch_array($result)) {
    $exdescription = $row['DESCRIPTION'];
    $extitle       = $row['TITLE'];
    $exurl         = $row['URL'];
    $exot          = $row['OTHERTITLE'];
    $exod          = $row['OTHERDESCRIPTION'];
}
$artistsql   = "SELECT * FROM ARTISTS, ARTISTS_EXHIBITS
WHERE ARTISTS.ID = ARTISTS_EXHIBITS.ARTIST_ID
AND ARTISTS_EXHIBITS.EXHIBIT_ID =" . $id;
$artistquery = mysqli_query($mysqli, $artistsql);
if (!$artistquery) {
    die('SQL error: ' . mysqli_error($mysqli));
}
while ($artistrow = mysqli_fetch_array($artistquery)) {
    $artistname = $artistrow['FIRST_NAME'] . " " . $artistrow['LAST_NAME'];
    $artistdesc = $artistrow['BIO'];
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

    <title>View Exhibit</title>

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
                    <h1 class="page-header">View Exhibit</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


    <div class="panel panel-primary">
      <div class="panel-heading">Exhibit Title</div>
      <div class="panel-body"><?php
echo $extitle;
?></div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">Exhibit Description</div>
      <div class="panel-body"><?php
echo $exdescription;
?></div>
    </div>

    <?php
      if($exot != "" || $exod != ""){
        echo '<div class="panel panel-primary">
              <div class="panel-heading">'.$exot.'</div>
              <div class="panel-body">'.$exod.'</div>
            </div>';
      }
     ?>

    <div class="panel panel-primary">
      <div class="panel-heading">Artist</div>
      <div class="panel-body"><?php
echo $artistname;
?></div>
    </div>

    <!-- VIDEOS FIELD -->
       <div class="panel panel-primary">
    <div class="panel-heading">
      <h2 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Images</a>
      </h2>
    </div>
    <div id="collapse2" class="panel-collapse collapse in">
<div class="img-thumbnail center-block img-responsive">
  <div id="exhibitImages" class="carousel slide" data-ride="carousel">

      <?php
$sql    = "SELECT * FROM IMAGES WHERE EXHIBIT_ID=" . $id;
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $toPrint = "<ol class=\"carousel-indicators\">";

    $firstRow = true;
    $counter  = 0;
    while ($counter < $result->num_rows) {
        if ($firstRow) {
            $toPrint .= "<li data-target=\"#exhibitImages\" data-slide-to=\"0\" class=\"active\"></li>";
            $firstRow = false;
        } else {
            $toPrint .= "<li data-target=\"#exhibitImages\" data-slide-to=\"" . $counter . "\"></li>";
        }
        $counter++;
    }

    $toPrint .= "</ol><div class=\"carousel-inner\">";
    $firstRow = true;
    while ($row = mysqli_fetch_array($result)) {
        if ($firstRow) {
            $toPrint .= "<div class=\"item active\">
        <img src=\"" . $row['PATH'] . "\" style=\"width:100%;\"></div>";
            $firstRow = false;
        } else {
            $toPrint .= "<div class=\"item\">
        <img src=\"" . $row['PATH'] . "\" style=\"width:100%;\"></div>";
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
} else {
  echo "</div></div>";
}
    echo $toPrint;
}
?>

</div>
</div>
    </div>
  </div>

 <!-- VIDEO FIELD END -->

      <!-- VIDEOS FIELD -->
  <?php
if ($exurl == NULL) {               //Check to see if URL is NULL
    echo "<div class = \"hide\">";  //If URL is NULL, video div will not show
} else {
    echo "<div>";                   //Else the video div will show
}
?>
     <div class="panel panel-primary">
    <div class="panel-heading">
      <h2 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Videos</a>
      </h2>
    </div>
    <div id="collapse3" class="panel-collapse collapse in">

       <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php
echo $exurl;
?>" allowfullscreen></iframe>
      </div>

    </div>
  </div>
</div>
 <!-- VIDEO FIELD END -->

<!--    <div class="panel panel-primary">
      <div class="panel-heading">Additional Files</div>
      <div class="panel-body"><center><h3>NOT YET IMPLEMENTED</h3></center></div>
    </div> -->


   <a href="" class="btn btn-primary" id="qrlink"">Generate QR Code</a>
    <a href="./editexhibit.php?id=<?php echo $id ?>" class="btn btn-primary">Edit Exhibit</a>

    <a href="../scripts/php/deleteexhibit.php?id=<?php echo $id ?>" class="btn btn-danger pull-right" onclick="if(!confirm('Are you sure you want to remove this exhibit? This action is not reversible, and will remove all files associated with this exhibit.')){return false;}">Remove Exhibit</a>





  <br>
  <br>
  <br>

                  <script>
                    window.onload = function() {
                      generateLink();
                    };

                    function generateLink(){
                      //var url = window.location.href
                      var url = "<?php
echo '../pages/qrcodeprint.php?id=' . $id;
?>";
                      var qrlink = document.getElementById("qrlink");
                      qrlink.setAttribute('href', url);
                    }
                  </script>

                </div>
                <!-- /.row -->
              </form>
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
    </body>
