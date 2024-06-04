<?php
    require_once '../../config/database.php';

    function getMovie($id_movie) {
        global $conn;
        try {
            $sql = "SELECT * FROM movies WHERE id_movie = :id_movie";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
?>
