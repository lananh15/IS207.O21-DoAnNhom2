<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['id_user'];
    $type = $_POST['type'];
    $id = $_POST['id'];

    $id_trailer = null;
    $id_movie = null;

    if ($type == 'trailer') {
        $id_trailer = $id;
    } else if ($type == 'movie') {
        $id_movie = $id;
    }

    try {
        $query = "INSERT INTO history (id_user, id_trailer, id_movie, date) VALUES (:id_user, :id_trailer, :id_movie, NOW())";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':id_trailer', $id_trailer, PDO::PARAM_INT);
        $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to execute statement']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
