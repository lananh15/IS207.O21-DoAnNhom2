<?php
    require_once "Movie.php";
    require_once "Trailer.php";
    require_once "View.php";

    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $videoUrl = '';

    if ($type == 'movie') {
        $movieDetails = getMovie($id);
        if ($movieDetails) {
            $videoUrl = $movieDetails['video'];
            increaseViewCount('movie', $id); 
        }
    } elseif ($type == 'trailer') {
        $trailerDetails = getTrailer($id);
        if ($trailerDetails) {
            $videoUrl = $trailerDetails[0]['video'];
            increaseViewCount('trailer', $id); 
        }
    }

    if (empty($videoUrl)) {
        echo "Not found videos.";
        exit;
    }

    $viewCount = getViewCount($type, $id);
?>