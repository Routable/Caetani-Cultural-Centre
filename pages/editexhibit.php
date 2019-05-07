<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../scripts/php/logincheck.php");

require '../scripts/php/connect.php';

$sql = "SELECT * FROM ARTISTS ORDER BY LAST_NAME";
$loop = $mysqli->query($sql) or die;
$row = mysqli_fetch_array($loop);


$id     = $_GET['id'];
$id     = mysqli_real_escape_string($mysqli, $id);
$query  = "SELECT * FROM EXHIBITS WHERE ID = '" . $id . "'";
$result = mysqli_query($mysqli, $query);

while ($exrow = mysqli_fetch_array($result)) {
    $exdescription = strip_tags($exrow['DESCRIPTION'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
    $extitle       = strip_tags($exrow['TITLE'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
    $exurl         = strip_tags($exrow['URL'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
    $exot          = strip_tags($exrow['OTHERTITLE'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
    $exod          = strip_tags($exrow['OTHERDESCRIPTION'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
}
$artistsql   = "SELECT * FROM ARTISTS, ARTISTS_EXHIBITS
WHERE ARTISTS.ID = ARTISTS_EXHIBITS.ARTIST_ID
AND ARTISTS_EXHIBITS.EXHIBIT_ID = ". $id;
$artistquery = mysqli_query($mysqli, $artistsql);
if (!$artistquery) {
    die('SQL error: ' . mysqli_error($mysqli));
}
while ($artistrow = mysqli_fetch_array($artistquery)) {
    $artistfname = strip_tags($artistrow['FIRST_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
    $artistlname = strip_tags($artistrow['LAST_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
    $artistdesc = strip_tags($artistrow['BIO'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
    $artistid = strip_tags($artistrow['ARTIST_ID'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
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

    <title>Edit Exhibit</title>

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
      <script>
    function generateQRCode(){
      //var url = document.getElementById("url").value;
      var url = window.location.href //gets URL of current page
      var googleapi = "https://chart.googleapis.com/chart?cht=qr";
      var imglink = googleapi + "&chl=" + url + "&chs=300x300&choe=UTF-8";
      console.log(imglink);
      var oImg = document.getElementById("qrcode");
      oImg.setAttribute('src', imglink);
    }

    //show function is called everytime the listbox item is changed. If the user selects the new option, we show the hidden div displaying artist information.
    function show(option) {
    if (option == "addnew") {
    hiddenDiv.style.display='inherit';
    Form.fileURL.focus();
    }
    else{
    hiddenDiv.style.display='none';
    }
}

     function showother(option) {
    if (option == "addnew") {
    hiddenDiv2.style.display='inherit';
    Form.fileURL.focus();
    }
    else{
    hiddenDiv2.style.display='none';
    }
}

   function showcategory(option) {
    if (option == "addnew") {
    hiddenDiv3.style.display='inherit';
    Form.fileURL.focus();
    }
    else{
    hiddenDiv3.style.display='none';
    }
}


$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});


  </script>

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
                    <h1 class="page-header">Edit Exhibit</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>



           <!-- Add Content Here -->



      <form action="../scripts/php/editexhibitscript.php?id=<?php echo $id ?>" method="post" autocomplete="off" enctype="multipart/form-data">

       <div class="form-group">
            <label for="exhibitTitle">Exhibit Title</label>
            <input type="text" id="exhibitTitle" name="exhibitTitle" class="form-control" maxlength="99" onkeyup="validateEditExhibit()" value="<?php echo $extitle ?>">
            <label id="exTitle-error" class="alert alert-danger" style="display:none">Exhibit title must be filled out</label>
       </div>

        <div class="form-group">
          <label for="exhibitDesc">Exhibit Description</label>
          <textarea  id="exhibitDesc" name="exhibitDesc" rows="3" style="max-width:100%;" class="form-control" maxlength="1999" onkeyup="validateEditExhibit()"><?php echo $exdescription ?></textarea>
          <label id="exDesc-error" class="alert alert-danger" style="display:none">Exhibit description must be filled out</label>
        </div>

          <div class="form-group">
            <label for="fieldName">Extra Field Name (Optional)</label>
            <input type="text" id="fieldName" name="fieldName" class="form-control" maxlength="99" onkeyup="validateEditExhibit()" value="<?php echo $exot ?>">

         </div>
         <div class="form-group">
          <label for="fieldContent">Extra Field Content (Optional)</label>
          <textarea id="fieldContent" name="fieldContent" rows="3" style="max-width:100%;" class="form-control" maxlength="1999" onkeyup="validateEditExhibit()"><?php echo $exod ?></textarea>
          <label id="ofCont-error" class="alert alert-danger" style="display:none">Field content must be filled out if you have an optional field</label>
        </div>


        <div class="form-group">
            <label for="exhibitURL">Youtube URL</label> <a data-toggle="tooltip" title="If you want to have a Youtube movie linked to this exhibit, place the last eleven characters found in a Youtube URL into this field. For example, if your link was https://www.youtube.com/watch?v=8XiqrERZo_8 you would put all of the letters past the equals sign (In this example, 8XiqrERZo_8) in the field below. "><small>what is this?</small></a>

            <input type="text" name="exhibitURL" class="form-control" value="<?php echo $exurl ?>" >
       </div>
  <div class="form-group">
          <label for="artistSelect">Artist</label> <a data-toggle="tooltip" title="Select the creator of the exhibit here. If the creator already exists, they can be selected from the down menu provided below. This will associate this author (and their biography, name, and picture) to this particular exhibit. If the author does not already exist, they can be added by selecting 'Add New'."><small>what is this?</small></a>
          <select id="artistSelect" name="artistSelect" class="form-control" onchange="validateEditExhibit(); java_script_:show(this.options[this.selectedIndex].value)">
            <option value="none">None</option>
            <option value = "addnew" >Add New</option>
            <?php
            while($row = mysqli_fetch_array($loop)){
              if($row['FIRST_NAME'] != "None") {
                if($row['ID'] != $artistid){
                  echo '<option value="'.strip_tags($row['ID'], "<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>").'">'.strip_tags($row['LAST_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').', '.strip_tags($row['FIRST_NAME'], "<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>").'</option>';
                } else {
                  echo '<option selected value="'.strip_tags($row['ID'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'">'.strip_tags($row['LAST_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').", ".strip_tags($row['FIRST_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'</option>';
                }
              }
            }
            ?>
      </select>
  </div>

       <div id="hiddenDiv" style="display:none" class="panel panel-primary">
       <div class="panel-heading">Add New Artist</div>
       <div class="panel-body">
          <div class="form-group">
            <label for="artistFName">Artist First Name</label>
            <input type="text" id="artistFName" name="artistFName" class="form-control" placeholder="Enter the first name of the artist." maxlength="49" onkeyup="validateEditExhibit()">
            <label id="arFName-error" class="alert alert-danger" style="display:none">First name must be filled out</label>
         </div>

       <div class="form-group">
            <label for="artistLName">Artist Last Name</label>
            <input type="text" id="artistLName" name="artistLName" class="form-control" placeholder="Enter the artists last name." maxlength="49" onkeyup="validateEditExhibit()">
            <label id="arLName-error" class="alert alert-danger" style="display:none">Last name must be filled out</label>
         </div>

         <div class="form-group">
          <label for="artistBio">Enter a description regarding the artist.</label>
          <textarea id="artistBio" name="artistBio" rows="3" class="form-control" placeholder="Enter a description/biography of the artist here." maxlength="1999" onkeyup="validateEditExhibit()"></textarea>
          <label id="arDesc-error" class="alert alert-danger" style="display:none">Description must be filled out</label>
        </div>

        <div class="form-group">
          <label for="artistImage">Picture of Artist</label>
          <small>supported file types: JPEG, PNG, and GIF.</small>
          <input type="file" name="artistImage" id="artistImage" style="max-width:100%;" class="btn btn-default" multiple>
       </div>

    </div>
    </div>

       <div class="form-group">
          <label for="fileToUpload">Exhibit Images</label>
          <small>supported file types: JPEG, PNG, and GIF.</small>
          <input type="file" accept="image/png,image/GIF, image/JPEG" name="fileToUpload[]" id="fileToUpload" style="width:100%;" class="btn btn-default btn-lg" multiple>
       </div>
          <?php
          $sql = "SELECT * FROM IMAGES WHERE EXHIBIT_ID=".$id;
          $result = $mysqli->query($sql);
          if (!$result) {
              die('SQL error: ' . mysqli_error($mysqli));
          }
          if($result->num_rows > 0){
            while($row = mysqli_fetch_array($result)) {
              echo '<div class="panel panel-primary"><img src="'.strip_tags($row['PATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'" width="300" height="200" class="img-thumbnail img-responsive">
              <input type="checkbox" name="imgdel[]" value="'.strip_tags($row['PATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'"> Delete Image</div><br>';
            }
          }
          ?>

          <div class="form-group">
         <label for="otherFileToUpload">Additional Files</label>
         <small>supported file types: PDF, WAV, MP3, DOC, DOCX.</small>
         <input type="file" accept="application/pdf, application/msword, image/png,image/GIF, image/JPEG,audio/mp3, audio/wav" name="otherFileToUpload[]" id="otherFileToUpload" style="width:100%;" class="btn btn-default btn-lg" multiple>
       </div>



  <div class="panel panel-default">
    <div class="panel-heading">Other Files</div>

    <?php
    $sql = "SELECT * FROM FILES WHERE EXHIBIT_ID=".$id;
    $result = $mysqli->query($sql);
    if (!$result) {
        die('SQL error: ' . mysqli_error($mysqli));
    }
    if($result->num_rows > 0){
      while($row = mysqli_fetch_array($result)) {
        $file = strip_tags($row['PATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>');
        echo '<div class="panel-body"><a href="'.$file.'">'.substr($file, 20).'  </a>';
        echo '<input type="checkbox" name="otherfiledel[]" value="'.strip_tags($row['PATH'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'">    Delete File</div><br>';
      }
    } else{
      echo '<div class="panel-body">No Files</div>';
    }
    ?>
  </div>

          <div class="form-group">
        <label for="categorySelect">Edit Category</label> <a data-toggle="tooltip" title="Select a category that this post is related to, or add a new category."><small>what is this?</small></a>
        <select id="categorySelect" name="categorySelect" class="form-control" onchange="validateEditExhibit(); java_script_:showcategory(this.options[this.selectedIndex].value)">
          <option value="none">None</option>
            <option value = "addnew" >Add New</option>
            <?php
            $catsql = "SELECT * FROM CATEGORY";
            $catloop = $mysqli->query($catsql) or die;
            $findcat = "SELECT CATEGORY_ID FROM CATEGORY_EXHIBITS WHERE EXHIBIT_ID=".$id;
            $findcatloop = $mysqli->query($findcat) or die;
            while($findcatrow = mysqli_fetch_array($findcatloop)){
              $excat = strip_tags($findcatrow['CATEGORY_ID'], "<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>");
            }
            while($catrow = mysqli_fetch_array($catloop)){
              if($catrow['CATEGORY_ID'] != -1) {
                if($catrow['CATEGORY_ID'] != $excat){
                  echo '<option value="'.strip_tags($catrow['CATEGORY_ID'], "<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>").'">'.strip_tags($catrow['CATEGORY_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'</option>';
                } else {
                  echo '<option selected value="'.strip_tags($catrow['CATEGORY_ID'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'">'.strip_tags($catrow['CATEGORY_NAME'], '<h1><h2><h3><h4></h1></h2></h3></h4></p><p><br></br><img><a>').'</option>';
                }
              }
            }
            ?>
          </select>
        </div>

      <div id="hiddenDiv3" style="display:none" class="panel panel-primary">
     <div class="panel-heading">Add New Category</div>
     <div class="panel-body">
        <div class="form-group">
          <label for="categoryName">Category Name</label>
          <input id="catName" type="text" name="categoryName" class="form-control" placeholder="Enter the name of this category" maxlength="99" onkeyup="validateEditExhibit()">
          <label id="catName-error" class="alert alert-danger" style="display:none">Category must be filled out</label>
       </div>
  </div>
  </div>

    <div class="form-group">
      <button id="saveButton" type="submit" class="btn btn-primary btn-lg">Save Edits</button>
    </div>


      </form>

	    		<script>
				function generateQRCode(){
					//var url = document.getElementById("url").value;
					var url = window.location.href //gets URL of current page
					var googleapi = "https://chart.googleapis.com/chart?cht=qr";
					var imglink = googleapi + "&chl=" + url + "&chs=300x300&choe=UTF-8";
					console.log(imglink);
					var oImg = document.getElementById("qrcode");
					oImg.setAttribute('src', imglink);
				}

        //show function is called everytime the listbox item is changed. If the user selects the new option, we show the hidden div displaying artist information.
        function show(option) {
        if (option == "addnew") {
        hiddenDiv.style.display='inherit';
        Form.fileURL.focus();
        }
        else{
        hiddenDiv.style.display='none';
        }
  }

         function showother(option) {
        if (option == "addnew") {
        hiddenDiv2.style.display='inherit';
        Form.fileURL.focus();
        }
        else{
        hiddenDiv2.style.display='none';
        }
  }


$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});


			</script>

            </div>
            <!-- /.row -->


        <!-- /#page-wrapper -->
</div>

    <!-- /#wrapper -->




</body>

</html>
