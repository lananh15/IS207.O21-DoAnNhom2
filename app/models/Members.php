<?php
    require_once '../../config/database.php';
    try {
        $sql = "SELECT * FROM members";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<p>{$row['fullname']} - {$row['id']}";
            if (!empty($row['role'])) {
                echo " - {$row['role']}";
            }
            echo "</p>";
        }
        echo "</div>";
    }

    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
?>