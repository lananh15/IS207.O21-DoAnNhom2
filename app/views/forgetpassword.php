<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Forget Password</title>
        <link rel="icon" type="image/x-icon"
            href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/forgetpassword.css">
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/loading.css" />

    </head>
    <body>
        <section>
            <form method="post" id="form" action="forgetpassword.php">
                <h1>RESET YOUR PASSWORD</h1>
                <div class="inputbox">
                    Email of your account: 
                    <input type="text" name="email" id="email" autocomplete="off" oninput="validateInput(this)" required>              
                </div>
                <div id="mail-error" class="error-message"></div>
                
                <div class="inputbox">
                    New password: 
                    <input type="password" name="newpassword" id="newpassword" autocomplete="off" required >
                    <i class="fa-regular fa-eye" style="right:20px;display:none" onclick="showHidePassword()"></i>
                    <i class="fa-regular fa-eye-slash" for="newpassword" style="right:20px;display:none"
                        onclick="showHidePassword()"></i>
                </div>
                <div id="password-error" class="error-message"></div>
                
                <div class="inputbox">
                    Confirm new password: 
                    <input type="password" name="confirmnewpassword" id="confirmnewpassword" autocomplete="off" required>
                    <i class="fa-regular fa-eye" style="right:20px;display:none" onclick="showHideCFPassword()"></i>
                    <i class="fa-regular fa-eye-slash" for="confirmnewpassword" style="right:20px;display:none"
                        onclick="showHideCFPassword()"></i>
                </div>
                <div id="confirmpassword-error" class="error-message"></div>
                <input type="submit" name="submitBtn" value="Submit" id="submitBtn">
            </form>
        </section>
        <?php include 'loading.php'; ?>
        
        <?php
            if (isset($_POST['submitBtn']) && $_POST['submitBtn'] == "Submit") {
                session_start();
                $email = $_POST['email'];
                $hashedNewPassword = $_POST['newpassword'];
                require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/SendVerificationCode.php';
            }
        ?>
        <script src="/IS207.O21-DoAnNhom2/public/js/forgetpassword.js"></script>
    </body>
</html>