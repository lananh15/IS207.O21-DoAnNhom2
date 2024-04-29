<?php
    require_once '../../config/database.php';
    $sql = "SELECT * FROM characters";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card">';
        echo '    <div class="image-box">';
        echo '        <img src="../../public/images&videos/Home/' . $row["name"] . '.png" />';
        echo '    </div>';
        echo '    <div class="content">';
        echo '        <p>' . $row["description"] . '<br><br>VA: ' . $row["voice_actors"] . '</p>';
        echo '    </div>';
        echo '</div>';
    }
?>