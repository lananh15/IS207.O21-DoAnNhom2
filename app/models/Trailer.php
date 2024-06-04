<?php
    require_once '../../config/database.php';

    function getTrailer($id_trailer) {
        global $conn;

        try {
            $sql = "SELECT * FROM trailers WHERE id_trailer = :id_trailer";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_trailer', $id_trailer, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getTrailerImages($id_movie) {
        global $conn;
    
        // try {
        //     $sql = "SELECT * FROM trailers";
        //     $stmt = $conn->query($sql);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // } catch (PDOException $e) {
        //     echo "Error: " . $e->getMessage();
        // }
        try {
            $sql = "SELECT * FROM trailers WHERE id_movie = :id_movie";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
?>