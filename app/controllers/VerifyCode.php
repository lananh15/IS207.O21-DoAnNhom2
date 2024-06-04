<?php
    if (isset($_POST['submit']) && $_POST['submit'] == "Submit") {
        $vcode = $_POST['vcode'];
        $currentTime=time();
        try {
            if ($vcode == $verificationCode && ($currentTime - $verificationTime) <= (3 * 60)) {
                $email = $_SESSION['email'];
                if (isset($_SESSION['username']) && isset($_SESSION['hashedPassword']) ){
                    require_once "AddNewUser.php";
                }
                else{
                    require_once "SetNewPassword.php";
                }
                    
            } 
            else if ($vcode !== $verificationCode && ($currentTime - $verificationTime) <= (3 * 60)) {
                echo "<script>alert('Error verification code. Try again!');</script>";
            }
            else{
                if (isset($_SESSION['username']) && isset($_SESSION['hashedPassword']) && isset($_SESSION['email']) ){
                    unset($_SESSION['username']);
                    unset($_SESSION['email']);
                    unset($_SESSION['hashedPassword']);
                    unset($_SESSION['verificationCode']);
                    echo "<script>alert('The verification code is expired!');
                            window.location.href='signup.php';  
                        </script>";
                }
                else{
                    unset($_SESSION['email']);
                    unset($_SESSION['hashedNewPassword']);
                    unset($_SESSION['verificationCode']);
                    echo "<script>alert('The verification code is expired!');
                            window.location.href='forgetpassword.php';  
                        </script>";
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>