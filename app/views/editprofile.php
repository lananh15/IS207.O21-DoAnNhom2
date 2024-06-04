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
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/header.css" />
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/editprofile.css" />
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/loading.css" />
        <link rel="stylesheet" 
            href= "https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="icon" type="image/x-icon"
            href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
        <title>Edit Profile</title>
    </head>
    <body>
        <?php require_once "header.php" ?>
        <div id="container">
            <form method="post" enctype="multipart/form-data" id="formAvt">
                <div id="editAvt">
                    <img src="<?php echo $_SESSION['avatar']?>">
                    <button type="submit" name="submitAvt" id="btnAvt" value="submitAvt" >CHANGE AVATAR</button>
                    <input type="file" accept="image/*" name="avatar" id="changeAvt">
                </div>
            </form>
            <?php
                require_once "../controllers/ChangeAvatar.php";
            ?>

            <form method="post" id="profileform">
                <div id="editprofile">
                    <h2>account setting</h2>
                    <div class="inputbox">
                        <input type="text" id="username" name= "username" value="<?php echo $_SESSION['username']?>" oninput="validateInput(this)" autocomplete="off">
                        <label for="username">Username</label>
                        <i class="fa-regular fa-pen-to-square"></i>
                    </div>
                    <div id="username-error" class="error-message"></div>
                    <div class="inputbox">
                        <input type="text" id="email" name="email" value="<?php echo $_SESSION['email']?>">
                        <label for="email">Email</label>
                    </div>
                    <div id="mail-error" class="error-message"></div>
                    <div class="inputbox">
                        <input type="password" id="password" name="password" autocomplete="off" required>
                        <i class="fa-regular fa-eye" style="display:none" onclick="showHidePassword()" id="hidepass"></i>
                        <i class="fa-regular fa-eye-slash" for="confirmpassword"
                            onclick="showHidePassword()" id="hidepass"></i>
                        <label for="password">Password</label>
                        <i class="fa-regular fa-pen-to-square"></i>
                    </div>
                    <div id="password-error" class="error-message"></div>
                    <input type="reset" id="cancel" class="button" value="CANCEL">
                    <input type="submit" id="submitBtn" class="button" value="SUBMIT" name="submitBtn">
                </div>
                <?php include 'loading.php'; ?>
            </form>
        </div>
        
        <?php require_once "../controllers/EditProfile.php"; ?>
        
        <script src="/IS207.O21-DoAnNhom2/public/js/editprofile.js"></script>
    </body>
</html>
