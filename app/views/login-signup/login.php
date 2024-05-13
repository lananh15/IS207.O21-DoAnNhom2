<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../../../public/css/login.css" />
    <title>Log In</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
    
</head>
<body>
    <?php
        require_once '../../controllers/GgAuthController.php';
        if (!isset($_GET['code'])){
    ?>
        <section>
            <form method="post">
                <h1>LOG IN</h1>
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
                    <label for="username">Username</label>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="inputbox">
                    <input type="password" id="password" name="password" style="width:85%;" required autocomplete="off">
                    <i class="fa-regular fa-eye" style="right:40px;display:none" onclick="showHidePassword()"></i>
                    <i class="fa-regular fa-eye-slash" for="password" style="right:40px;display:none" onclick="showHidePassword()"></i>
                    <label for="password">Password</label>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="forget">
                    <a href="forgetpassword.php">Forget password?</a>
                </div>
                <div id="message-container"></div>
                <input type="submit" name="submit" value="LOG IN" id="login-btn">
                <div class="register">
                    <p>Don't have an account?
                        <a href="signup.php">SIGN UP</a>
                    </p>
                </div>
            </form>
        </section>
        <script src="../../../public/js/login.js"></script>
    <?php 
        require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnWebNhom2-nhap-/config/database.php';
        session_start();
        if(isset($_POST['submit']) && $_POST['submit']=="LOG IN"){
            $_SESSION['username']= $_POST['username'];;
            $_SESSION['password'] = hash('sha256', trim($_POST['password']));
            try{
                $stmt_select=$conn->prepare("SELECT * FROM users WHERE username= :username");
                $stmt_select->bindParam(":username", $_SESSION['username'], PDO::PARAM_STR);
                $stmt_select->execute();

                $user = $stmt_select->fetch(PDO::FETCH_ASSOC);
                if($stmt_select->rowCount()>0 && $_SESSION['password'] === $user['password']){
                    $_SESSION['email']=$user['email'];
                    $_SESSION['avatar']=$user['avatar'];
                    header('Location: ../home.php');
                    exit;
                }
                else{
                                    echo "<script> console.log(" . $stmt_select->rowCount() . ");</script>";

                    echo "<script>alert('Username or password is incorrect!');</script>";
                }
            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            
        }

    }    
    ?>
</body>
</html>
