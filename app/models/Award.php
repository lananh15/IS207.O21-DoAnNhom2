<?php
    require_once '../../config/database.php';
    try{
        $sql = "SELECT * FROM awards";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo $row["name"] . '<br>';
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
?>