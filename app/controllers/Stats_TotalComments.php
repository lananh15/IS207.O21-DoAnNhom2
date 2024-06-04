<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';

function get_number_of_post_comments($conn) {
    $select_post_comments = $conn->prepare("SELECT * FROM `post_comments`");
    $select_post_comments->execute();
    return $select_post_comments->rowCount();
}


function get_number_of_movie_comments($conn) {
    $select_movie_comments = $conn->prepare("SELECT * FROM `movie_comments`");
    $select_movie_comments->execute();
    return $select_movie_comments->rowCount();
}


function get_number_of_trailer_comments($conn) {
    $select_trailer_comments = $conn->prepare("SELECT * FROM `trailer_comments`");
    $select_trailer_comments->execute();
    return $select_trailer_comments->rowCount();
}
?>



