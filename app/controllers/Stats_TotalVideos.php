<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';


function get_number_of_movies($conn) {
    $select_movies = $conn->prepare("SELECT * FROM `movies`");
    $select_movies->execute();
    return $select_movies->rowCount();
}
function get_number_of_trailers($conn) {
    $select_trailers = $conn->prepare("SELECT * FROM `trailers`");
    $select_trailers->execute();
    return $select_trailers->rowCount();
}
?>




