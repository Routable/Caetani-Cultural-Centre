<?php
session_start();
if(isset($_SESSION['targetname'])) {
header("Location: ../../pages/main.php");
}

if($_SESSION['error']== true){
$tries = 5;
$current = $tries - $_SESSION['attempts'];
if($current <= 0) {
  $_SESSION['RESETREQUIRED']=true;
  header("Location: ../../pages/forgotpassword.php");
} else if($current <= 4) {
echo "<div class=\"alert alert-danger fade-in myitem\"><center><strong>Invalid email or password. $current attempt(s) remaining.</strong></center></div>";
      unset($_SESSION['error']);
      }
}
?>

 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Caetani Cultural Center - Exhibit Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/index.css">
  <link href="/res/img/favicon.png" rel="icon" type="image/png" sizes="16x16">
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
            <img class="img-responsive" src="res/img/logo.png"  </img>
            <p id="profile-name" class="profile-name-card"></p>

            <form class="form-signin" action="/scripts/php/login.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" name="user_email" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

                

                <button class="btn btn-lg btn-primary btn-block btn-signin" name="btn-login" type="submit">Sign in</button>
            </form><!-- /form -->

            <a href="pages/forgotpassword.php" class="forgot-password">
                Forgot your password?
            </a>

        </div><!-- End card-container -->
    </div><!-- End container -->




</body>
</html>
