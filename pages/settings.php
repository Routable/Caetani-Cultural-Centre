<?php
  include("../scripts/php/logincheck.php");

  if(isset($_SESSION['NEW'])){
  echo "<div class=\"alert alert-success fade-in myitem\"><center><strong>User Account Created - A password will be sent to the users email address.</strong></center></div>";
        unset($_SESSION['NEW']);
      }elseif (isset($_SESSION['PASS'])) {
        echo "<div class=\"alert alert-success fade-in myitem\"><center><strong>Password Updated</strong></center></div>";
        unset($_SESSION['PASS']);
      }elseif (isset($_SESSION['EMA'])) {
        echo "<div class=\"alert alert-success fade-in myitem\"><center><strong>Email Updated</strong></center></div>";
        unset($_SESSION['EMA']);
      }elseif (isset($_SESSION['DIS'])) {
        echo "<div class=\"alert alert-success fade-in myitem\"><center><strong>User Account Deleted</strong></center></div>";
        unset($_SESSION['DIS']);
      } elseif (isset($_SESSION['WRONG'])) {
        echo "<div class=\"alert alert-danger fade-in myitem\"><center><strong>Incorrect password. Please try again.</strong></center></div>";
        unset($_SESSION['WRONG']);
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
    <script src="../scripts/js/validation.js"></script>

    <title>Settings</title>

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

    <!-- VALIDATION -->

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>

<style>
    .required:after { content:" *"; color: red; }
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
                    <h1 class="page-header">Settings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


           <!-- Add Content Here -->

           <?php
           $sql3 = "SELECT *
                    FROM LOGIN
                    WHERE STATUS = '2'
                    AND EMAIL = '".$_SESSION['targetname']."'";

           require '../scripts/php/connect.php';

           $query2 = mysqli_query($mysqli, $sql3);
           if($query2->num_rows == 0){
             echo "<div class = \"hide\">";
           } else {
             echo '<div class="panel-group" id="accordion">';
           }
            ?>

 <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
      <h2 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Create New User</a>
      </h2>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">
      <!-- FORM FIELD -->

  <form name="createUser" action="../scripts/php/createuser.php" method="post" autocomplete="off">
  <div class="form-group">
    <label for="email" class="required">Email address</label>
    <input type="email" class="form-control" name="email" placeholder="name@example.com" maxlength="99" onkeyup="validateCreateUser()">
    <label id="email-error" class="alert alert-danger" style="display:none">Email must be valid</label>
    <br>
    <label for="emailConfirm" class="required">Confirm Email address</label>
    <input type="email" class="form-control"  name="emailconfirm" placeholder="name@example.com" maxlength="99" onkeyup="validateCreateUser()">
    <label id="cemail-error" class="alert alert-danger" style="display:none">Emails must match</label>
    <br>
    <label for="firstName" class="required">First Name</label>
    <input type="text" class="form-control" name="firstname" placeholder="Enter first name of user" maxlength="29" onkeyup="validateCreateUser()" required>
        <br>
    <label for="lastName" class="required">Last Name</label>
    <input type="text" class="form-control" name="lastname" placeholder="Enter last name of user" maxlength="29" onkeyup="validateCreateUser()" required>
  </div>
  <div class="form-group">
    <label for="role" class="required">Account Role</label>
    <select onchange="validateCreateUser()" class="form-control" name="role">
       <option value="" disabled selected>Account Privilege Level</option>
      <option value="1">Staff</option>
      <option value="2">Administrator</option>
    </select>
  </div>


  <button id=createButton type="submit" class="btn btn-primary mb-2" disabled>Create User</button>
</form>

      <!-- FORM FIELD END -->

    </div>
      </div>
    </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
      <h2 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Update Password</a>
      </h2>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
     <form name="updatePassword" action = "../scripts/php/newpassword.php" method="post" autocomplete="off">
    <label for="currentPassword" class="required">Current Password</label>
    <input type="password" class="form-control"  name="currentPassword" placeholder="***********" maxlength="300" onkeyup="validateUpdatePassword()">
    <br>
    <label for="newPassword" class="required">Enter New Password</label>
    <input type="password" class="form-control"  name = "newPassword" placeholder="***********" maxlength="300" onkeyup="validateUpdatePassword()">
    <label id="pass-error" class="alert alert-danger" style="display:none">Password must contain at least 1 upper case letter, 1 lower case letter, 1 number and be a minimum of 8 characters in length. </label>
    <br>
    <label for="passwordConfirm" class="required">Confirm New Password</label>
    <input type="password" class="form-control"  name = "passwordConfirm" placeholder="***********" maxlength="300" onkeyup="validateUpdatePassword()">
    <label id="cpass-error" class="alert alert-danger" style="display:none">Passwords must match</label>
  </div>
   <button id=updatePass type="submit" class="btn btn-primary mb-2" disabled>Update Password</button>
   </form>
      </div>
    </div>
  </div>



    <div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
      <h2 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Update Email</a>
      </h2>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="form-group">
     <form name="updateEmail" action = "../scripts/php/newemail.php" method="post" autocomplete="off">
    <label for="currentPassword" class="required">Current Password</label>
    <input type="password" class="form-control" id="currentPassword" name = "currentPassword" placeholder="name@example.com" maxlength="99" onkeyup="validateUpdateEmail()">
    <br>
    <label for="newEmail" class="required">Enter New Email</label>
    <input type="email" class="form-control" id="newEmail"  name = "newEmail" placeholder="name@example.com" maxlength="99" onkeyup="validateUpdateEmail()">
    <label id="uemail-error" class="alert alert-danger" style="display:none">Email must be valid</label>
    <br>
    <label for="emailConfirm" class="required">Confirm New Email</label>
    <input type="email" class="form-control" id="emailConfirm" name = "emailConfirm" placeholder="name@example.com" maxlength="99" onkeyup="validateUpdateEmail()">
    <label id="ucemail-error" class="alert alert-danger" style="display:none">Emails must match</label>
  </div>
   <button id=updateEmail type="submit" class="btn btn-primary mb-2" disabled>Update Email</button>
   </form>
      </div>
    </div>
  </div>

  <?php
  $sql1 = "SELECT *
           FROM LOGIN
           WHERE STATUS = '2'
           AND EMAIL = '".$_SESSION['targetname']."'";

  require '../scripts/php/connect.php';

  $query1 = mysqli_query($mysqli, $sql1);
  if($query1->num_rows == 0){
    echo "<div class = \"hide\">";
  } else {
    echo '<div class="panel panel-default">';
  }
   ?>

    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
      <h2 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Delete User Account</a>
      </h2>
    </div>

    <div id="collapse3" class="panel-collapse collapse">
         <div class="alert alert-danger" role="alert">
      <center>Warning: This will allow you to delete a user account. Deleted accounts are unable to login, add, or edit exhibits. This is not reversible!</center>
      </div>
      <div class="panel-body">
      <form name="deactivateUser" action ="../scripts/php/disableaccount.php" onSubmit="if(!confirm('Are you sure you want to delete this account? This action is not reversible!')){return false;}" method="post" autocomplete="off">
       <label for="accountSelect">User Account</label>
          <select onchange="validateDisableAccount()" name="accountSelect" class="form-control" onchange="java_script_:show(this.options[this.selectedIndex].value)">
            <option value="select">Select</option>
            <?php

            require '../scripts/php/connect.php';
            if ($mysqli->connect_error){
              die("Connection failed: " . $mysqli->connect_error);
            }
            $sql = "SELECT *
                    FROM LOGIN
                    WHERE NOT EMAIL = '".$_SESSION['user']."'";
            $query = mysqli_query($mysqli, $sql);
            if(!$query){
              die('SQL error: ' . mysqli_error($mysqli));
            }
            while($row = mysqli_fetch_array($query)){
              echo "<option value=".$row['EMAIL'].">".$row['FIRST_NAME']." ".$row['LAST_NAME']."   ".$row['EMAIL']."</option>";
            }
            ?>
      </select>
      <div class="checkbox">
      <label class="required"><input id=confChk type="checkbox" value="" onchange="validateDisableAccount()">Are you sure you want to delete this account?</label>
    </div>
            <br>
               <button id=deactBtn type="submit" class="btn btn-danger" disabled>Delete User</button>
               </form>
      </div>
    </div>
  </div>
  </div>
</div>
















            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


</div>
</body>

</html>
