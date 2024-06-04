<?php
    $username = $_SESSION['username'];
    $hashedPassword = $_SESSION['hashedPassword'];
    $avatar = "/IS207.O21-DoAnNhom2/public/images&videos/user1.png";

    $stmt_insert = $conn->prepare("INSERT INTO users (username, email, password, avatar) VALUES (:username, :email, :password, :avatar)");

    $stmt_insert->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt_insert->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt_insert->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
    $stmt_insert->bindParam(":avatar", $avatar, PDO::PARAM_STR);
    $stmt_insert->execute();

    echo "<script>alert('Sign up successfully!'); window.location.href='login.php';</script>";
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['hashedPassword']);
    unset($_SESSION['verificationCode']);
?>
