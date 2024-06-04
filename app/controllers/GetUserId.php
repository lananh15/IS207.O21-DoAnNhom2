<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../../config/database.php';

if (isset($_SESSION['username'])) {
$username = $_SESSION['username'];

try {
    $query = "SELECT id FROM users WHERE username=:username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $userId = $result['id'];

    $_SESSION['user_id'] = $userId;

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}}
?>
