<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../../../public/css/signup.css" />
    <link rel="stylesheet" type="text/css" href="../../../public/css/loading.css" />
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php
        require_once '../../controllers/GgAuthController.php';
        session_start();
        if (!isset($_GET['code'])){
    ?>
    <section>
        <form method="post">
            <h1>SIGN UP</h1>
            <a href="<?php echo $client->createAuthUrl(); ?>" class="google-login-btn">
                <span class="icon"><i class="fa-brands fa-google"></i></span>
                <span>Continue with Google</span>
            </a>
            <br><br>
            <div class="or-container">
                <hr>
                <span class="or">or</span>
            </div>
            <div class="inputbox">
                <input type="text" id="username" name="username" required autocomplete="off" oninput="validateInput(this)">
                <label for="username" id="labelusername">Username</label>
                <i class="fa-solid fa-user"></i>
            </div>
            <div id="username-error" class="error-message"></div>
            <div class="inputbox">
                <input type="text" id="email" name="email" required autocomplete="off" oninput="validateInput(this)">
                <label for="email" id="labelmail">Email</label>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div id="mail-error" class="error-message"></div>

            <div class="inputbox">
                <input type="password" id="password" style="width:85%;" name="password" required autocomplete="off">
                <i class="fa-regular fa-eye" style="right:40px;display:none" onclick="showHidePassword()"></i>
                <i class="fa-regular fa-eye-slash" for="password" style="right:40px;display:none"
                    onclick="showHidePassword()"></i>
                <label for="password" id="labelpassword">Password</label>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div id="password-error" class="error-message"></div>
            <div class="inputbox">
                <input type="password" id="confirmpassword" name="confirmpassword" style="width:85%;" required autocomplete="off">
                <i class="fa-regular fa-eye" style="right:40px;display:none" onclick="showHideCFPassword()"></i>
                <i class="fa-regular fa-eye-slash" for="confirmpassword" style="right:40px;display:none"
                    onclick="showHideCFPassword()"></i>
                <label for="confirmpassword" require>Confirm Password</label>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div id="confirmpassword-error" class="error-message"></div>
            <input type="submit" id="signup-btn" name="signup" value="SIGN UP">
            <div class="login">
                <p>Have an account?
                    <a href="login.php">LOG IN</a>
                </p>
            </div>
        </form>
    </section>
    
    <?php include '../loading.php'; ?>

    <?php 
        if (isset($_POST['signup']) && $_POST['signup']=="SIGN UP"){
            $username=$_POST['username'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/VerifyCodeController.php';
        }}
    ?>
    <script src="../../../public/js/signup.js"></script>
</body>

</html>
