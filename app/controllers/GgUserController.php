<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnWebNhom2-nhap-/config/database.php';

    // Check if the session has been established
    if (isset($_SESSION['username'], $_SESSION['email'], $_SESSION['avatar'])) {
        // Get value from session
        $username = $_SESSION['username'];
        $password=$_SESSION['password'];
        $email = $_SESSION['email'];
        $avatar = $_SESSION['avatar'];

        try {
            // Check email exists
            $sql_check_email = "SELECT * FROM users WHERE email = :email";
            $stmt_check_email = $conn->prepare($sql_check_email);
            $stmt_check_email->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt_check_email->execute();

            if ($stmt_check_email) {
                // If exist, update information
                if ($stmt_check_email->rowCount() > 0) {
                    $sql_update = "UPDATE users SET username = :email, avatar = :avatar WHERE email = :email";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt_update->bindParam(':avatar', $avatar, PDO::PARAM_STR);
                    $stmt_update->bindParam(':email', $email, PDO::PARAM_STR);

                    if (!$stmt_update->execute()) {
                        // Xử lý lỗi khi thực hiện truy vấn UPDATE
                        // Ví dụ: ghi log, hiển thị thông báo cho người dùng
                    }
                } else {
                    // If doesn't exist, insert new user
                    $sql_insert = "INSERT INTO users (username, password, email, avatar) VALUES (:email, :password, :email, :avatar)";
                    $stmt_insert = $conn->prepare($sql_insert);
                    $stmt_insert->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt_insert->bindParam(':password', $password, PDO::PARAM_STR);
                    $stmt_insert->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt_insert->bindParam(':avatar', $avatar, PDO::PARAM_STR);

                    if (!$stmt_insert->execute()) {
                        // Handle errors when executing INSERT query
                        // Example: write log, notify to user
                    }
                }
            } else {
                // Handle error when executing SELECT query
                // Example: write log, notify to user
            }
        } catch (PDOException $e) {
            // Handle error when executing query
            // Example: write log, notify to user
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Handle when session doesn't exist
        // Example: write log, notify to user
    }
?>

