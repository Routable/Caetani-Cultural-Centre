<?php
session_start();
if($_SESSION['reset']){
echo "<div class=\"alert alert-success fade-in myitem\"><center><strong>If the email you specified exists in our system, we've sent a password reset link to it. <a href=\"..\index.php\">Click here to login.</a></strong></center></div>";
      unset($_SESSION['reset']);
      }


if($_SESSION['RESETREQUIRED']) {
echo "<div class=\"alert alert-danger fade-in myitem\"><center>Your account has been flagged for suspicious activity. Please reset your password to continue.</center></div>";
 unset($_SESSION['RESETREQUIRED']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Caetani Cultural Center - Exhibit Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/index.css">
  <link href="../res/img/favicon.png" rel="icon" type="image/png" sizes="16x16">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="carousel slide carousel-fade" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
        </div>
        <div class="item">
        </div>
        <div class="item">
        </div>
		 <div class="item">
        </div>
    </div>

	</div>

	<script>
		$('.carousel').carousel({interval: 7000});
	</script>

    <div class="container"> <!-- Start Container -->
        <div class="card card-container"> <!-- Start Card Container -->
            <a href="../index.php"><img class="img-responsive" src="../res/img/logo.png"  </img></a>
            <p id="profile-name" class="profile-name-card"></p>

            <form class="form-signin" action="../scripts/php/passwordreset.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
                <button class="btn btn-lg btn-primary btn-block btn-signin" name="btn-login" type="submit">Reset my password</button>
            </form><!-- /form -->


        </div><!-- End card-container -->
    </div><!-- End container -->




</body>
</html>
