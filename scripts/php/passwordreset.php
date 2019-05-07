<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('class.phpmailer.php');
include("class.smtp.php");

$email = $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

require 'connect.php';
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$sql = "SELECT FIRST_NAME FROM LOGIN WHERE EMAIL = LOWER('".$email."')";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $name = $row['FIRST_NAME'];
    $userpassword = generatePassword();
    $newpass = password_hash($userpassword, PASSWORD_DEFAULT);
    $_SESSION['RESETREQUIRED']=false;
    }

$mysqli->close();

$mail = new PHPMailer();
$subject = "Password Reset";
$content = "Hi ".$name.", <br><br> We got a request to reset your password. <br><br>Your temporary password is <b>".$userpassword."</b><br><br>If you didn't request a password reset, please let us know.";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;
$mail->Username = "secret";
$mail->Password = "secret";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";
$mail->SetFrom("secret", "secrety");
$mail->AddReplyTo("secret", "secret");
$mail->AddAddress("$email");
$mail->Subject = $subject;
$mail->WordWrap   = 80;
$mail->MsgHTML($content);
$mail->IsHTML(true);

if(!$mail->Send()) {
	echo "Problem on sending mail";
} else {
$_SESSION['reset']= true;
header("Location: ./reset.php");

require 'connect.php';
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "UPDATE LOGIN SET PASSWORD = '".$newpass."' WHERE EMAIL = '".$email."'";
if ($mysqli->query($sql) === TRUE) {
    unset($_SESSION['attempts']);
    header("Location: ../../pages/forgotpassword.php");
}
$mysqli->close();
}
} else {
    $_SESSION['reset']= true;
    header("Location: ../../pages/forgotpassword.php");
    }

?>

<?php
function generatePassword() {
$str = 'ABCDEF0123456789';
$shuffled = str_shuffle($str);


return $shuffled;
}
?>
