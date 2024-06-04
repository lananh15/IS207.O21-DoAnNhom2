<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        try {
            $sql_check_email = "SELECT * FROM users WHERE email = :email";
            $stmt_check_email = $conn->prepare($sql_check_email);
            $stmt_check_email->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt_check_email->execute();

            if ($stmt_check_email->rowCount() > 0) {
                echo '<i class="fa-solid fa-circle-exclamation"></i> Email available';
            } else {
                echo '<i class="fa-solid fa-circle-exclamation"></i> Email is not registered in this website';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>
