<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('class.phpmailer.php');
include("class.smtp.php");

  require 'connect.php';
    if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
    }


$email = $_POST['emailconfirm'];
$status = $_POST['role'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$userpassword = generatePassword();
$newpass = password_hash($userpassword, PASSWORD_DEFAULT);

strtolower($email);
strtolower($status);
strtolower($firstname);
strtolower($lastname);



$sql = "INSERT INTO LOGIN (EMAIL, FIRST_NAME, LAST_NAME, PASSWORD, STATUS) VALUES ('".$email."', '".$firstname."', '".$lastname."', '".$newpass."', '".$status."')";

if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
$mysqli->close();

$mail = new PHPMailer();
$subject = "Account Information";
$content = "An account has been created for you at cosc.ga.<br><br>Your temporary password is: <b>".$userpassword."</b><br><br> Once you have logged in, it is recommended that you change your password for security reasons.<br><br> Regards,<br><br> The Caetani Cultural Center Team";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = 587;
$mail->Username = "secret";
$mail->Password = "secret";
$mail->Host     = "smtp.gmail.com";
$mail->Mailer   = "smtp";
$mail->SetFrom("secret", "secret");
$mail->AddReplyTo("secret", "secret");
$mail->AddAddress("$email");
$mail->Subject = $subject;
$mail->WordWrap   = 80;
$mail->MsgHTML($content);
$mail->IsHTML(true);

$_SESSION['NEW'] = true;

if(!$mail->Send()) {
  $_SESSION['WRONG'] = true;
  header("Location: ../../pages/settings.php");
} else {
header("Location: ../../pages/settings.php");
}
?>

<?php
function generatePassword() {
$str = 'ABCDEF0123456789';
$shuffled = str_shuffle($str);

return $shuffled;
}
?>
