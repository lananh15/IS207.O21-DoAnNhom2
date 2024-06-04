<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/vendor/phpmailer/phpmailer/src/Exception.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['send'])){
  $userName = $_POST['userName'];
  $userEmail = $_POST['userEmail'];
  $userMessage = $_POST['userMessage'];

  try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'insideoutwebsitevn@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'xyfovwdccutohzlp'; // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = '465';

    $mail->setFrom('insideoutwebsitevn@gmail.com'); 
    $mail->addAddress('insideoutwebsitevn@gmail.com'); 

    $mail->isHTML(true);
    $mail->Subject = 'Message Received (Contact Page)';
    $mail->Body = "<h3>Name : $userName <br>Email: $userEmail <br>Message : $userMessage</h3>";

    $mail->send();
    echo "<script>alert('Message Sent! Thank you for contacting us.');</script>";
    } 
    catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>