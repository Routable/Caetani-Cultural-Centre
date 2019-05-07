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
    $artistname       = $row['FIRST_NAME'].' '.$row['LAST_NAME'];
    $artistimage         = $row['IMGPATH'];
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

    <title>View Artist</title>

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
                    <h1 class="page-header">View Artist</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

    <div class="panel panel-primary">
      <div class="panel-heading">Artist</div>
      <div class="panel-body"><?php
echo $artistname;
?></div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">Artist Bio</div>
      <div class="panel-body"><?php
echo $artistbio;
?></div>
    </div>

    <!-- IMAGES FIELD -->
       <div class="panel panel-primary">
    <div class="panel-heading">
      <h2 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Images</a></h2>
    </div>

    <div id="collapse2" class="panel-collapse collapse in">
    <div class="panel-body">
      <?php
      if($artistimage != "" && strcmp($artistimage, "../../uploads/artists/") !== 0){
        echo "<img src=\"". $artistimage . "\" alt=\"". $artistimage ."\" class=\"img-thumbnail center-block img-responsive\">";
      } else {
        echo "No Image";
      }
      ?>
  </div>
  </div>
</div>

    <a href="./editartist.php?id=<?php echo $id ?>" class="btn btn-primary">Edit Artist</a>


    <a href="../scripts/php/deleteartist.php?id=<?php echo $id ?>" class="btn btn-danger pull-right" onclick="if(!confirm('Are you sure you want to remove this artist? This action is not reversible, and will remove all files associated with this artist.')){return false;}">Remove Artist</a>

    <br>
    <br>
 <!-- IMAGE FIELD END -->
</body>
</html>
