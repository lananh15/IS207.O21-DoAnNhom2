<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'])) {
        $username = $_POST['username'];
        $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        try {
            $sql_check_username = "SELECT * FROM users WHERE username = :username";
            $stmt_check_username = $conn->prepare($sql_check_username);
            $stmt_check_username->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt_check_username->execute();

            if ($stmt_check_username->rowCount() > 0) {
                echo '<i class="fa-solid fa-circle-exclamation"></i> Username available';
            } else {
                echo ''; // Username available
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>
