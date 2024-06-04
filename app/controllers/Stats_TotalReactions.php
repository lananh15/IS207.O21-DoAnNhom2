<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';


function get_number_of_movie_likes($conn) {
    // Count likes from movie_reactions table
    $select_movie_likes = $conn->prepare("SELECT * FROM `movie_reactions` WHERE action = ? ");
    $select_movie_likes->execute(['like']);
    return $select_movie_likes->rowCount();
}
function get_number_of_trailer_likes($conn) {
    // Count likes from trailer_reactions table
    $select_trailer_likes = $conn->prepare("SELECT * FROM `trailer_reactions` WHERE action = ? ");
    $select_trailer_likes->execute(['like']);
    return $select_trailer_likes->rowCount();

}
function get_number_of_movie_dislikes($conn) {
    // Count likes from movie_reactions table
    $select_movie_dislikes = $conn->prepare("SELECT * FROM `movie_reactions` WHERE action = ? ");
    $select_movie_dislikes->execute(['dislike']);
    return $select_movie_dislikes->rowCount();
}

function get_number_of_trailer_dislikes($conn) {
    // Count likes from trailer_reactions table
    $select_trailer_dislikes = $conn->prepare("SELECT * FROM `trailer_reactions` WHERE action = ? ");
    $select_trailer_dislikes->execute(['dislike']);
    return $select_trailer_dislikes->rowCount();

}
?>



