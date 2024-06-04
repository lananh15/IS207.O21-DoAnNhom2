<?php
require_once '../../config/database.php';
require_once 'Watch-video.php';

function increaseViewCount($type, $id) {
    global $conn; // Sử dụng biến toàn cục

    $id = intval($id);
    
    if ($type == 'movie') {
        $sql = "UPDATE movies SET view = view + 1 WHERE id_movie = :id";
    } elseif ($type == 'trailer') {
        $sql = "UPDATE trailers SET view = view + 1 WHERE id_trailer = :id";
    } else {
        return;
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function getViewCount($type, $id) {
    global $conn; // Sử dụng biến toàn cục

    $id = intval($id);

    if ($type == 'movie') {
        $sql = "SELECT view FROM movies WHERE id_movie = :id";
    } elseif ($type == 'trailer') {
        $sql = "SELECT view FROM trailers WHERE id_trailer = :id";
    } else {
        return 0;
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['view'] : 0;
}
?>
