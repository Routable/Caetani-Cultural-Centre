<?php
  include("../scripts/php/logincheck.php");
?>
<?php

  if(isset($_POST['submit'])){
    require '../scripts/php/connect.php';
    $numofdeletions = sizeof($_POST['catdel']);
    foreach($_POST['catdel'] as $cattodelete){
      //$pathtodelete is the path of the image to delete
      $deletesql = "DELETE FROM CATEGORY WHERE CATEGORY_ID=".$cattodelete;
      $mysqli->query($deletesql);
      $updatecatsql = "UPDATE CATEGORY_EXHIBITS SET CATEGORY_ID=-1 WHERE CATEGORY_ID=".$cattodelete;
      $_SESSION['DELETE'] = true;
    }
  }


  if(isset($_SESSION['DELETE'])){
    if($numofdeletions > 1){
      echo "<div class=\"alert alert-success fade-in myitem\"><center><strong>Categories Deleted</strong></center></div>";
    } else{
      echo "<div class=\"alert alert-success fade-in myitem\"><center><strong>Category Deleted</strong></center></div>";
    }
   unset($_SESSION['DELETE']);
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

    <title>Categories</title>

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
                    <h1 class="page-header">Categories</h1>
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
                                    FROM CATEGORY';
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
                           <form action="categorytables.php" method="post" autocomplete="off" enctype="multipart/form-data">
                           <table id = "example" class="table table-striped table-bordered" style="width:100%">
                             <thead>
                               <tr>
                                 <th>Category</th>
                                 <th>Delete?</th>
                               </tr>
                             </thead>
                             <tbody>
                               <?php
                               while($row = mysqli_fetch_array($query))
                               {
                                 if($row['CATEGORY_ID'] != -1){
                                 echo '<tr>
                                         <td>'.strip_tags($row['CATEGORY_NAME'], "<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>").'</td>
                                         <td><input type="checkbox" name="catdel[]" value="'.$row['CATEGORY_ID'].'"></td>
                                      </tr>';
                                    }
                               }
                               ?>
                             </tbody>
                           </table>
                           <div class="form-group">
                             <button type="submit" class="btn btn-primary btn-lg" name="submit">Save Deletions</button>
                           </div>
                         </form>
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
