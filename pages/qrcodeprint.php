
<?php
  include("../scripts/php/logincheck.php");
  require '../scripts/php/visitorexhibiturl.php';
  require '../scripts/php/connect.php';
  if ($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
  }
  $id = $_GET['id'];
  $id = mysqli_real_escape_string($mysqli,$id);
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

    <title>QR Code Print</title>


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
    <img imgsrc="" id="qrcode"></img>
    <br>
    <br>
    <div class="btn-toolbar" style="padding-left:2.2em;">
     <button onclick="goBack()" class="btn btn-primary">Go Back</button>
     <button class="btn btn-primary" onclick="generateQRCodeLarger()">Make QR Larger</button>
        <button class="btn btn-primary" onclick="generateQRCodeSmaller()">Make QR Smaller</button>
    <button class="btn btn-danger" onclick="callPrint()">Print</button>
        
    </div>
  </body>

<script>
  var qrSize = 300;
  var qrIncrement = 50;
  
  window.onload = function() {
    generateQRCode();
  };

  function generateQRCode(){
    //var url = window.location.href
    var url = "<?php echo $visitorexhibiturl ?>";
    url = url + "<?php echo $id ?>";
    var googleapi = "https://chart.googleapis.com/chart?cht=qr";
    var imglink = googleapi + "&chl=" + url + "&chs=300x300&choe=UTF-8";
    console.log(imglink);
    var oImg = document.getElementById("qrcode");
    oImg.setAttribute('src', imglink);
  }
  
  function callPrint() {
  javascript:window.print();
  }
  
  function generateQRCodeLarger() {
  if(qrSize < 500) 
    qrSize = qrSize + qrIncrement;
    
    //var url = window.location.href
    var url = "<?php echo $visitorexhibiturl ?>";
    url = url + "<?php echo $id ?>";
    var googleapi = "https://chart.googleapis.com/chart?cht=qr";
    var imglink = googleapi + "&chl=" + url + "&chs=" + qrSize + "x" + qrSize + "&choe=UTF-8";
    console.log(imglink);
    var oImg = document.getElementById("qrcode");
    oImg.setAttribute('src', imglink);
  
  }
  
    function generateQRCodeSmaller() {
    if(qrSize > 50)
    qrSize = qrSize - qrIncrement;
    
    //var url = window.location.href
    var url = "<?php echo $visitorexhibiturl ?>";
    url = url + "<?php echo $id ?>";
    var googleapi = "https://chart.googleapis.com/chart?cht=qr";
    var imglink = googleapi + "&chl=" + url + "&chs=" + qrSize + "x" + qrSize + "&choe=UTF-8";
    console.log(imglink);
    var oImg = document.getElementById("qrcode");
    oImg.setAttribute('src', imglink);
  
  }
</script>



<script>
function goBack() {
    window.history.back();
}
</script> 



