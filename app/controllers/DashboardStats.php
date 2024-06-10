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

function get_number_of_deactive_posts($conn) {
    $select_deactive_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ?");
    $select_deactive_posts->execute(['deactive']);
    return $select_deactive_posts->rowCount();
}

function get_number_of_users($conn) {
    $select_users = $conn->prepare("SELECT * FROM `users`");
    $select_users->execute();
    return $select_users->rowCount();
}

function get_number_of_comments($conn) {
    $select_comments = $conn->prepare("SELECT * FROM `post_comments`");
    $select_comments->execute();
    return $select_comments->rowCount();
}

function get_number_of_likes($conn) {
    // Count likes from movie_reactions table
    $select_movie_likes = $conn->prepare("SELECT COUNT(*) FROM `movie_reactions` WHERE action = ? ");
    $select_movie_likes->execute(['like']);
    $movie_likes = $select_movie_likes->rowCount();

    // Count likes from trailer_reactions table
    $select_trailer_likes = $conn->prepare("SELECT COUNT(*) FROM `trailer_reactions` WHERE action = ? ");
    $select_trailer_likes->execute(['like']);
    $trailer_likes = $select_trailer_likes->rowCount();

    // Sum the likes from both tables
    $total_likes = $movie_likes + $trailer_likes;

    return $total_likes;
}
?>



