<?php
    $hashedNewPassword = $_SESSION['hashedNewPassword'];
    $sql_check_email = "SELECT * FROM users WHERE email=:email";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt_check_email->execute();

    if ($stmt_check_email->rowCount() > 0) {
        $sql_update_pass = "UPDATE users SET password=:password WHERE email=:email";
        $stmt_update_pass = $conn->prepare($sql_update_pass);
        $stmt_update_pass->bindParam(":password", $hashedNewPassword, PDO::PARAM_STR);
        $stmt_update_pass->bindParam(":email", $email, PDO::PARAM_STR);
        if ($stmt_update_pass->execute()) {
            echo "<script>alert('Set new password successfully!');window.location.href='login.php';</script>";
        } else {
            echo "<script>console.log('Error updating password. Please try again.');</script>";
        }
            unset($_SESSION['email']);
            unset($_SESSION['hashedNewPassword']);
            unset($_SESSION['verificationCode']);
    } 
    else {
        echo "<script>console.log('Email is not found in the database');</script>";
    }
?>