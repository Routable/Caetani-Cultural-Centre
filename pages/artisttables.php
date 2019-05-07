<?php
  include("../scripts/php/logincheck.php");
?>
<?php
  include_once("../scripts/php/analyticstracking.php");

  if(isset($_SESSION['DELETE'])){
   echo "<div class=\"alert alert-success fade-in myitem\"><center><strong>Artist Deleted</strong></center></div>";
   unset($_SESSION['DELETE']);
} elseif(isset($_SESSION['FAILED'])) {
echo "<div class=\"alert alert-danger fade-in myitem\"><center><strong>This artist is still associated with an exhibit. This artist cannot be deleted until they have been removed from all other exhibits.</strong></center></div>";
   unset($_SESSION['FAILED']);
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

    <title>Artists</title>

    <!-- Latest compiled and minified CSS. This is not local to the server, we are pulling this from the Bootstrap repo directly. -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

     <!-- FAVICON -->
    <link href="../res/img/favicon.png" rel="icon" type="image/png" sizes="16x16">

    <!-- Custom CSS for the page(s). Any CSS changes to the primary site should be done in this file location -->
    <link href="../css/basewebsite.css" rel="stylesheet">

    <!-- Custom Fonts and Emoticons - look up Font Awesome for information on how to use.  -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

     <!-- JQUERY  -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

     <!-- DATA TABLES -->

     <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>


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
                    <h1 class="page-header">Artists</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


                        <div class="panel-body">
                          <?php
                            ini_set('display_errors', 1);
                            ini_set('display_startup_erros', 1);
                            error_reporting(E_ALL);
                            require '../scripts/php/connect.php';
                            if ($mysqli->connect_error){
                              die("Connection failed: " . $mysqli->connect_error);
                            }
                            $sql = 'SELECT *
                                    FROM ARTISTS';
                            $query = mysqli_query($mysqli, $sql);

                            if(!$query){
                              die('SQL error: ' . mysqli_error($mysqli));
                            }
                           ?>

                           <script>
                           $(document).ready(function() {
                             $('#example').DataTable();
                           } );
                           </script>

                           <table id = "example" class="table table-striped table-bordered" style="width:100%">
                             <thead>
                               <tr>
                                 <th>ID</th>
                                 <th>Artist</th>
                               </tr>
                             </thead>
                             <tbody>
                               <?php
                               while($row = mysqli_fetch_array($query))
                               {
                                 if($row['ID'] != -1){
                                 echo '<tr>
                                         <td><a href = "/pages/viewartist.php?id='.$row['ID'].'">'.$row['ID'].'</td>
                                         <td><a href = "/pages/viewartist.php?id='.$row['ID'].'">'.strip_tags($row['FIRST_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').' '.strip_tags($row['LAST_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'</td>
                                      </tr>';
                                    }
                               }
                               ?>
                             </tbody>
                           </table>
                        </div>





                </div>
                <!-- /.col-lg-6 -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->




    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

	</body>

</html>
