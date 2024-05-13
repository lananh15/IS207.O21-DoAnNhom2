<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="sha512-...your-integrity-hash-here..." crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="../../public/css/normalize.css" />
        <link rel="stylesheet" 
            href= "https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="icon" type="image/x-icon"
            href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
        <title>Dashboard</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                width: 80%;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-top: 50px;
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            p {
                text-align: center;
                font-size: 18px;
                color: #333;
            }

            #logout {
                display: block;
                width: 100px;
                margin: 20px auto;
                padding: 10px;
                text-align: center;
                color: #fff;
                background-color: #4caf50;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            #logout:hover {
                background-color: #45a049;
            }
            img{
                width:40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Hello, <?php echo $_SESSION['username']; ?></h2>
            <img src="<?php echo $_SESSION['avatar']?>">
            <p>Đây là trang dashboard của bạn.</p>
            <a id="logout" href="login-signup/logout.php">Log out</a>
        </div>
    </body>
</html>