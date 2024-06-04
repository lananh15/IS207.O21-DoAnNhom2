<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/vendor/phpmailer/phpmailer/src/Exception.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/vendor/phpmailer/phpmailer/src/SMTP.php';

    if (isset($_POST['signup']) || (isset($_POST['submitBtn']))) {
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
        if(isset($username)){
            $mail->Body = "<h3 style='display:block;text-align:center;font-size:18px;'> Sign up to Inside Out Website </h3>
                        <p>Thank you for signing up. Your verification code is:
                            <strong style='display:block;text-align:center;font-size:25px;'>$verificationCode</strong>
                        </p>
                        <p>This verification code is only valid for 3 minutes. Please use this code to complete the sign-up process.</p>
                        <p>Regards,<br>Inside Out Website.</p>";
        }
        else{
            $mail->Body = "<h3 style='display:block;text-align:center;font-size:18px;'> Set new password of your account </h3>
                        <p>Your verification code is:
                            <strong style='display:block;text-align:center;font-size:25px;'>$verificationCode</strong>
                        </p>
                        <p>This verification code is only valid for 3 minutes. Please use this code to complete the process.</p>
                        <p>Regards,<br>Inside Out Website.</p>";
        }

        if ($mail->send()) {
            $_SESSION['verificationTime'] = $verificationTime;
            $_SESSION['verificationCode'] = $verificationCode;
            $_SESSION['email'] = $email;
            if(isset($username)){
                $_SESSION['username'] = $username;
                $_SESSION['hashedPassword'] = $password;
            }
            else{
                $_SESSION['hashedNewPassword'] = $hashedNewPassword;
            }
            
            echo "<script>alert('The verification code is sent to your email. Please check it!');
                        window.location.href='verifycode.php'; </script>";
        } else {
            echo "Error: " . $mail->ErrorInfo;
        }
    }