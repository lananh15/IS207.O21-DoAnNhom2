<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';

function get_number_of_posts($conn) {
    $select_posts = $conn->prepare("SELECT * FROM `posts`");
    $select_posts->execute();
    return $select_posts->rowCount();
}

function get_number_of_active_posts($conn) {
    $select_active_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ?");
    $select_active_posts->execute(['active']);
    return $select_active_posts->rowCount();
}

function get_number_of_videos($conn) {
    $select_movies = $conn->prepare("SELECT * FROM `movies` WHERE `video` IS NOT NULL AND `video` <> ''");
    $select_movies->execute();
    $movies = $select_movies->rowCount();

    $select_trailers = $conn->prepare("SELECT * FROM `trailers` WHERE `video` IS NOT NULL AND `video` <> ''");
    $select_trailers->execute();
    $trailers = $select_trailers->rowCount();

    $total_videos = $movies + $trailers;
    return $total_videos;
}

function get_number_of_users($conn) {
    $select_users = $conn->prepare("SELECT * FROM `users`");
    $select_users->execute();
    return $select_users->rowCount();
}

function get_number_of_comments($conn) {
    $select_post_comments = $conn->prepare("SELECT * FROM `post_comments`");
    $select_post_comments->execute();
    $posts = $select_post_comments->rowCount();

    $select_movie_comments = $conn->prepare("SELECT * FROM `movie_comments`");
    $select_movie_comments->execute();
    $movies = $select_movie_comments->rowCount();

    $select_trailer_comments = $conn->prepare("SELECT * FROM `trailer_comments`");
    $select_trailer_comments->execute();
    $trailers = $select_trailer_comments->rowCount();

    $total_comments = $posts + $movies + $trailers;

    return $total_comments;
}

function get_number_of_reactions($conn) {
    // Count likes from movie_reactions table
    $select_movie_reactions = $conn->prepare("SELECT * FROM `movie_reactions` ");
    $select_movie_reactions->execute();
    $movie_reactions = $select_movie_reactions->rowCount();

    // Count likes from trailer_reactions table
    $select_trailer_reactions = $conn->prepare("SELECT * FROM `trailer_reactions` ");
    $select_trailer_reactions->execute();
    $trailer_reactions = $select_trailer_reactions->rowCount();

    // Sum the likes from both tables
    $total_reactions = $movie_reactions + $trailer_reactions;

    return $total_reactions;
}
?>



