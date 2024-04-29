<?php
    require_once 'config.php';

    $servername = "localhost";
    $conn = mysqli_connect($servername, $db_username, $db_password, $db_name);

    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
?>