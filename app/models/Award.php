<?php
    require_once '../../config/database.php';
    $sql = "SELECT * FROM awards";
    $result1 = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result1)) {
        echo $row["name"] . '<br>';
    }
?>