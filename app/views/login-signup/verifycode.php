<?php
    session_start(); // Start the session

    $verificationTime = $_SESSION['verificationTime'];
    $verificationCode = $_SESSION['verificationCode'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $hashedPassword = $_SESSION['hashedPassword'];
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Verify</title>
        <link rel="icon" type="image/x-icon"
            href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
        <style>
            *{
                margin:0;
                padding:0;
                box-sizing: border-box;
            }
            body{
                background-image: url(../../../public/images&videos/log-sign.jpg);
                background-size: cover;
                display:flex;
                align-items: center;
                justify-content: center;
                height:100vh;
            }
            section{
                display:grid;
                grid-template-columns: 1fr;
                position: relative;
                width: 80vw;
                max-width: 500px; /* Add a max-width for larger screens */
                height: auto; /* Change height to auto for responsiveness */
                background-color: #222222;
                border: 2px solid rgb(255, 255, 255,0.5);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px, rgb(17, 17, 26) 0px 8px 24px, rgb(17, 17, 26) 0px 16px 48px;
            }
            form{
                display:flex;
                flex-direction: column;
                align-items: center;
            }
            h1{
                font-size: 2.5rem;
                color: #33adff;
            }
            h3{
                font-size: 1rem;
                color:white;
                margin: 1rem 0;
            }
            #vcode{
                display: grid;
                place-items: center;
                width: 100%;
                max-width: 300px; 
                height: 3rem;
                font-size: 1.2rem;
                outline: none;
                margin: 1rem;
            }
            #submit{
                outline:none;
                border:none;
                font-size: 1rem;
                width: 6.5rem;
                height: 2.5rem;
                border-radius: 20px;
                background-color: #33adff;
                color:white;
                cursor: pointer;
            }
            #submit:hover{
                background-color: #13a0ff;
            }

            @media (max-width: 768px) {
                section {
                    width: 90vw;
                    padding: 15px;
                }
                h1 {
                    font-size: 2rem;
                }
                h3 {
                    font-size: 0.9rem;
                }
                #vcode {
                    height: 2.5rem;
                    font-size: 1rem;
                }
                #submit {
                    font-size: 0.9rem;
                    width: 6rem;
                    height: 2rem;
                }
            }

            @media (max-width: 480px) {
                section {
                    width: 95vw;
                    padding: 10px;
                }
                h1 {
                    font-size: 1.8rem;
                }
                h3 {
                    font-size: 0.8rem;
                }
                #vcode {
                    height: 2rem;
                    font-size: 0.9rem;
                }
                #submit {
                    font-size: 0.8rem;
                    width: 5rem;
                    height: 1.8rem;
                }
            }
        </style>
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
        if (isset($_POST['submit']) && $_POST['submit'] == "Submit") {
            $vcode = $_POST['vcode'];
            $currentTime=time();
            try {
                if ($vcode == $verificationCode && ($currentTime - $verificationTime) <= (3 * 60)) {
                    $username = $_SESSION['username'];
                    $email = $_SESSION['email'];
                    $hashedPassword = $_SESSION['hashedPassword'];
                    $avatar = "../../public/images&videos/avt-user.png";
                    $stmt_insert = $conn->prepare("INSERT INTO users (username, email, password, avatar) VALUES (:username, :email, :password, :avatar)");

                    $stmt_insert->bindParam(":username", $username, PDO::PARAM_STR);
                    $stmt_insert->bindParam(":email", $email, PDO::PARAM_STR);
                    $stmt_insert->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
                    $stmt_insert->bindParam(":avatar", $avatar, PDO::PARAM_STR);
                    $stmt_insert->execute();

                    echo "<script>alert('Sign up successful!'); window.location.href='login.php';</script>";
                    unset($_SESSION['username']);
                    unset($_SESSION['email']);
                    unset($_SESSION['hashedPassword']);
                    unset($_SESSION['verificationCode']);
                } 
                else if ($vcode !== $verificationCode && ($currentTime - $verificationTime) <= (3 * 60)) {
                    echo "<script>alert('Error verification code. Try again!');</script>";
                }
                else{
                    echo "<script>alert('The verification code is expired!');
                                  window.location.href='signup.php';  
                            </script>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ?>
    </body>
</html>
