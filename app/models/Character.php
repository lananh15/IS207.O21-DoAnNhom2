<?php
    require_once '../../config/database.php';
    try{
        $sql = "SELECT * FROM characters";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="card">';
            echo '    <div class="image-box">';
            echo '        <img src="../../public/images&videos/Home/' . $row["name"] . '.png" />';
            echo '    </div>';
            echo '    <div class="content">';
            echo '        <p>' . $row["description"] . '<br><br>VA: ' . $row["voice_actors"] . '</p>';
            echo '    </div>';
            echo '</div>';
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
?>