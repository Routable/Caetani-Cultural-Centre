<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../scripts/php/logincheck.php");

require '../scripts/php/connect.php';

if(isset($_SESSION['ADDED'])){
echo "<div class=\"alert alert-success fade-in myitem\"><center><strong>Exhibit Created</strong></center></div>";
      unset($_SESSION['ADDED']);
      }

$sql = "SELECT * FROM ARTISTS ORDER BY LAST_NAME";
$loop = $mysqli->query($sql) or die;



$sql2 = "SELECT * FROM CATEGORY ORDER BY CATEGORY_NAME";
$loop2 = $mysqli->query($sql2) or die;
$row2 = mysqli_fetch_array($loop);

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
    <title>Add Exhibit</title>

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

      <style>
    .required1:after { content:" *"; color: red; }

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
                    <h1 class="page-header">Create Exhibit</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>



           <!-- Add Content Here -->



      <form action="../scripts/php/addexhibitscript.php" method="post" autocomplete="off" enctype="multipart/form-data">

       <div class="form-group ">
            <label for="exhibitTitle" class="required1">Exhibit Title</label>
            <input id="exTitle" type="text" name="exhibitTitle" class="form-control " placeholder="Enter a title for the exhibit..." maxlength="99" required onkeyup="validateCreateExhibit()">
            <label id="exTitle-error" class="alert alert-danger" style="display:none">Exhibit title must be filled out</label>
       </div>

        <div class="form-group">
          <label for="exhibitDesc" class="required1">Exhibit Description</label>
          <textarea  id="exDesc" name="exhibitDesc" rows="3" style="max-width:100%;" class="form-control" required placeholder="Enter a description regarding the exhibit..." maxlength="1999" onkeyup="validateCreateExhibit()"></textarea>
          <label id="exDesc-error" class="alert alert-danger" style="display:none">Exhibit description must be filled out</label>
        </div>

        <div class="form-group">
          <label for="fieldSelect">Add Optional Field</label> <a data-toggle="tooltip" title="This option will allow for the creation of a new, user viewable field."><small>what is this?</small></a>
          <select id="fieldSelect" name="fieldSelect" class="form-control" onchange="validateCreateExhibit(); java_script_:showother(this.options[this.selectedIndex].value)">
            <option value="none">None</option>
            <option value = "addnew" >Add New</option>
      </select>
  </div>


        <div id="hiddenDiv2" style="display:none" class="panel panel-primary">
       <div class="panel-heading">Add New Field</div>
       <div class="panel-body">
          <div class="form-group">
            <label for="fieldName" class="required1">Field Name</label>
            <input id="ofName" type="text" name="fieldName" class="form-control" placeholder="New Field Title..." maxlength="99" onkeyup="validateCreateExhibit()">
            <label id="ofName-error" class="alert alert-danger" style="display:none">Field title must be filled out</label>
         </div>
         <div class="form-group" class="required1">
          <label for="fieldContent"class="required1">Field Content</label>
          <textarea id="ofCont" name="fieldContent" rows="3" class="form-control" style="max-width:100%;" placeholder="Enter content for the field here..." maxlength="1999" onkeyup="validateCreateExhibit()"></textarea>
          <label id="ofCont-error" class="alert alert-danger" style="display:none">Field content must be filled out</label>
        </div>
    </div>
    </div>








        <div class="form-group">
            <label for="exhibitURL">Youtube URL</label> <a data-toggle="tooltip" title="Paste the full URL of the youtube video here."><small>what is this?</small></a>

            <input type="text" name="exhibitURL" class="form-control" placeholder="Enter Youtube URL here..." >
       </div>

  <div class="form-group">
          <label for="artistSelect">Artist</label> <a data-toggle="tooltip" title="Select the creator of the exhibit here. If the creator already exists, they can be selected from the down menu provided below. This will associate this author (and their biography, name, and picture) to this particular exhibit. If the author does not already exist, they can be added by selecting 'Add New'."><small>what is this?</small></a>
          <select id="artistSelect" name="artistSelect" class="form-control" onchange="validateCreateExhibit(); java_script_:show(this.options[this.selectedIndex].value)">

            <option value="none">None</option>
            <option value = "addnew" >Add New</option>
            <?php
            while($row = mysqli_fetch_array($loop)){
              if($row['FIRST_NAME'] != "None") {?>
            <option value = "<?php echo($row['ID'])?>">
            <?php echo($row['LAST_NAME'].", ".$row['FIRST_NAME']) ?></option>
            /* <?php echo($row['ID']." ".$row['LAST_NAME'].", ".$row['FIRST_NAME']) ?></option> */
            <?php }} ?>

      </select>
  </div>






       <div id="hiddenDiv" style="display:none" class="panel panel-primary">
       <div class="panel-heading">Add New Artist</div>
       <div class="panel-body">
          <div class="form-group">
            <label for="artistFName" class="required1">Artist First Name</label>
            <input id="arFName" type="text" name="artistFName" class="form-control" placeholder="Enter the first name of the artist..." maxlength="49" onkeyup="validateCreateExhibit()">
            <label id="arFName-error" class="alert alert-danger" style="display:none">First name must be filled out</label>
         </div>

       <div class="form-group">
            <label for="artistLName" class="required1">Artist Last Name</label>
            <input id="arLName" type="text" name="artistLName" class="form-control" placeholder="Enter the artists last name..." maxlength="49" onkeyup="validateCreateExhibit()">
            <label id="arLName-error" class="alert alert-danger" style="display:none">Last name must be filled out</label>
         </div>

         <div class="form-group">
          <label for="artistBio" class="required1">Enter a description regarding the artist.</label>
          <textarea id="arDesc" name="artistBio" rows="3" class="form-control" style="max-width:100%;" placeholder="Enter a description/biography of the artist here..." maxlength="1999" onkeyup="validateCreateExhibit()"></textarea>
          <label id="arDesc-error" class="alert alert-danger" style="display:none">Description must be filled out</label>
        </div>

        <div class="form-group">
          <label for="artistImage">Picture of Artist</label>
          <small>supported file types: JPEG, PNG, and GIF.</small>
          <input type="file" accept="image/png,image/GIF, image/JPEG" name="artistImage" id="artistImage" class="btn btn-default">
       </div>

    </div>
    </div>

       <div class="form-group">
          <label for="fileToUpload">Exhibit Images</label>
          <small>supported file types: JPEG, PNG, and GIF.</small>
          <input type="file" accept="image/png,image/GIF, image/JPEG" name="fileToUpload[]" id="fileToUpload" style="width:100%;" class="btn btn-default btn-lg" multiple>
       </div>

           <div class="form-group">
          <label for="otherFileToUpload">Additional Files</label>
          <small>supported file types: PDF, DOC, PNG, GIF, JPG, M4A </small>
          <input type="file" accept="application/pdf, application/msword, image/png,image/GIF, image/JPEG,audio/mp4 " name="otherFileToUpload[]" id="otherFileToUpload" style="width:100%;" class="btn btn-default btn-lg" multiple>
       </div>


            <div class="form-group">
          <label for="categorySelect">Add Category</label> <a data-toggle="tooltip" title="Select a category that this post is related to, or add a new category."><small>what is this?</small></a>
          <select id="categorySelect" name="categorySelect" class="form-control" onchange="validateCreateExhibit(); java_script_:showcategory(this.options[this.selectedIndex].value)">
            <option value="none">None</option>
              <option value = "addnew" >Add New</option>
            <?php
            while($row2 = mysqli_fetch_array($loop2)){
            if($row2['CATEGORY_NAME'] != "None") {?>
            <option value = "<?php echo($row2['CATEGORY_ID'])?>">
            <?php echo($row2['CATEGORY_NAME']) ?></option>
            <?php }} ?>

      </select>
  </div>

        <div id="hiddenDiv3" style="display:none" class="panel panel-primary">
       <div class="panel-heading">Add New Category</div>
       <div class="panel-body">
          <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input id="catName" type="text" name="categoryName" class="form-control" placeholder="Enter the name of this category..." maxlength="99" onkeyup="validateCreateExhibit()">
            <label id="catName-error" class="alert alert-danger" style="display:none">Category must be filled out</label>
         </div>
    </div>
    </div>

    <div class="form-group">
      <button id="addBtn" onclick="validateCreateExhibit()" type="submit" class="btn btn-primary btn-lg" disabled>Add Exhibit</button>
    </div>


      </form>




            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->


    <!-- /#wrapper -->




</body>

</html>
