<?php
    require_once "../../config/database.php";
    try {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $userID = $user['id'];

        $sql_check_video = $conn->prepare("SELECT h.id_movie, h.id_trailer, 
                                                m.image_movie AS thumbnail_movie, 
                                                t.image AS thumbnail_trailer
                                        FROM history h
                                        LEFT JOIN movies m ON h.id_movie = m.id_movie
                                        LEFT JOIN trailers t ON h.id_trailer = t.id_trailer
                                        WHERE h.id IN (
                                            SELECT MAX(id) 
                                            FROM history 
                                            WHERE id_user = :userID 
                                            GROUP BY id_movie, id_trailer
                                        )
                                        ORDER BY h.date DESC");
        $sql_check_video->bindParam(":userID", $userID, PDO::PARAM_INT);
        $sql_check_video->execute();
        $watchedItems = $sql_check_video->fetchAll(PDO::FETCH_ASSOC);
        echo "<script>console.log('$userID');</script>";
        echo "<script>console.log('Watched Items: " . json_encode($watchedItems) . "');</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>