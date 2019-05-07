<?php
  include("../scripts/php/logincheck.php")
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

    <title>Dashboard</title>

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
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

     <!-- DATA TABLES -->

     <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
<style>
.panel-body {
margin-top:10px;
margin-bottom:10px;
}
</style>
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


<!-- QUERIES -->


<div class="row">
    <!--Panel-->
    <div class="col-sm-12 col-md-4">
        <div class="card border border-dark">
            <div class="card-body">
             <div class="panel panel-primary">
                <div class="panel-heading"><center>Total Exhibits</center></div>
                <div class="panel-body"> <center><?php
                  require '../scripts/php/connect.php';
                    if ($mysqli->connect_error) { die("Connection failed: " . $mysqli->connect_error); } else {
                      $sql = 'SELECT COUNT(ID) AS TOTAL FROM EXHIBITS';
                      $result = mysqli_query($mysqli, $sql);
                    if(mysqli_num_rows($result) > 0){ $data=mysqli_fetch_assoc($result); echo strip_tags($data['TOTAL'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>'); } mysqli_close($mysqli);} //QUERY FOR TOTAL EXHIBITS
                  ?></div></div></center>
            </div>
        </div>
    </div>
    <!--/.Panel-->

    <!--Panel-->
    <div class="col-sm-12 col-md-4">
        <div class="card border">
            <div class="card-body">
             <div class="panel panel-primary">
                <div class="panel-heading"><center>Last Exhibit Created</center></div>
                  <div class="panel-body"> <center><?php
                  require '../scripts/php/connect.php';
                    if ($mysqli->connect_error) { die("Connection failed: " . $mysqli->connect_error); } else {
                      $sql2 = 'SELECT * FROM EXHIBITS AS MAXDATE WHERE DATE_ADDED = (SELECT MAX(DATE_ADDED) FROM EXHIBITS)';
                      $result = mysqli_query($mysqli, $sql2);
                    if(mysqli_num_rows($result) > 0){ $data=mysqli_fetch_assoc($result); echo strip_tags($data['TITLE'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>'); } mysqli_close($mysqli);} //QUERY FOR TOTAL EXHIBITS
                  ?></div></div></center>
            </div>
        </div>
    </div>
    <!--/.Panel-->

      <!--Panel-->
    <div class="col-sm-12 col-md-4">
        <div class="card border">
            <div class="card-body">
             <div class="panel panel-primary">
                <div class="panel-heading"><center>Oldest Exhibit</center></div>
                <div class="panel-body"> <center><?php
                  require '../scripts/php/connect.php';
                    if ($mysqli->connect_error) { die("Connection failed: " . $mysqli->connect_error); } else {
                      $sql2 = 'SELECT * FROM EXHIBITS AS MAXDATE WHERE date_added = (SELECT MIN(date_added) FROM EXHIBITS)';
                      $result = mysqli_query($mysqli, $sql2);
                    if(mysqli_num_rows($result) > 0){ $data=mysqli_fetch_assoc($result); echo strip_tags($data['TITLE'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>'); } mysqli_close($mysqli);} //QUERY FOR TOTAL EXHIBITS
                  ?></div></div></center>
            </div>
        </div>
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
                FROM EXHIBITS
                ORDER BY VIEWS DESC';
        $query = mysqli_query($mysqli, $sql);

        if(!$query){
          die('SQL error: ' . mysqli_error($mysqli));
        }
       ?>
       <script>
       $(document).ready(function() {
         $('#example').DataTable();
       } );



       $('#example').dataTable( {
    "order": [[ 0, 'asc' ], [ 1, 'asc' ]]
} );
       </script>

       <table id = "example" class="table table-striped table-bordered" style="width:100%">
         <thead><br>
           <tr>
             <th>ID</th>
             <th>Title</th>
             <th>Views</th>
           </tr>
         </thead>
         <tbody>
           <?php
           while($row = mysqli_fetch_array($query))
           {
             echo '<tr>
                     <td><a href = "/pages/viewexhibit.php?id='.strip_tags($row['ID'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'">'.strip_tags($row['ID'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'</td>
                      <td><a href = "/pages/viewexhibit.php?id='.strip_tags($row['ID'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'">'.strip_tags($row['TITLE']).'</td>
                     <td>'.strip_tags($row['VIEWS'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'</td>
                  </tr>';
           }?>
         </tbody>
       </table>
    </div>

    <!--/.Panel-->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
