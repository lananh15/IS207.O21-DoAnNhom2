<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnWebNhom2-nhap-/vendor/PHPMailer-master/src/Exception.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnWebNhom2-nhap-/vendor/PHPMailer-master/src/PHPMailer.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnWebNhom2-nhap-/vendor/PHPMailer-master/src/SMTP.php';



if (isset($_POST['signup'])) {
    $verificationCode = rand(100000, 999999);
    $verificationTime = time();

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'insideoutwebsitevn@gmail.com';
    $mail->Password = 'wtudzeoqyolkvakc';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('insideoutwebsitevn@gmail.com');

    $mail->addAddress($email);

    $mail->isHTML(true);

    $mail->Subject = "[Inside Out Website] Verification code";

    $mail->Body = "<h3 style='display:block;text-align:center;font-size:18px;'> Sign up to Inside Out Website </h3>
                    <p>Thank you for signing up. Your verification code is:
                        <strong style='display:block;text-align:center;font-size:25px;'>$verificationCode</strong>
                    </p>
                    <p>This verification code is only valid for 3 minutes. Please use this code to complete the sign-up process.</p>
                    <p>Regards,<br>Inside Out Website.</p>";

    if ($mail->send()) {
        $_SESSION['verificationTime'] = $verificationTime;
        $_SESSION['verificationCode'] = $verificationCode;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['hashedPassword'] = $password;
        echo "<script>alert('The verification code is sent to your email. Please check it!');
                    window.location.href='verifycode.php'; </script>";
    } else {
        echo "Error: " . $mail->ErrorInfo;
    }
}