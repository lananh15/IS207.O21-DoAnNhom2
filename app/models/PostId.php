<?php
    require_once '../../config/database.php';

    function getPost($id) {
        global $conn;
        try {
            $sql = "SELECT * FROM posts WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
?>
