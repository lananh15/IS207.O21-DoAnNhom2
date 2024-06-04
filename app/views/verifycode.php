<?php
    session_start();

    $verificationTime = $_SESSION['verificationTime'];
    $verificationCode = $_SESSION['verificationCode'];
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/verifycode.css" />
        <title>Verify</title>
        <link rel="icon" type="image/x-icon"
            href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
    </head>
    <body>
        <section>
            <form method="post">
                <h1>VERIFICATION</h1>
                <h3>Enter the verification code to complete the Sign-up process</h3>
                <input type="text" name="vcode" id="vcode" placeholder="Enter your verification code..." autocomplete="off">
                <input type="submit" name="submit" id="submit" value="Submit">
            </form>
        </section>
        <?php
            require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
            require_once "../controllers/VerifyCode.php";
        ?>
    </body>
</html>
