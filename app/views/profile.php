<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="sha512-...your-integrity-hash-here..." crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/header.css" />
        <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/profile.css" />
        <link rel="stylesheet" 
            href= "https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="icon" type="image/x-icon"
            href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
        <title>Profile</title>
        <script src="/IS207.O21-DoAnNhom2/public/js/watch-video.js"></script>
    </head>
    <body>
        <?php require_once "header.php" ?>
        <div class="container">
            <video id="leftvideo" muted autoplay loop>
                <source src="https://dl.dropboxusercontent.com/scl/fi/3bzwjf5gfkuylocwhs86b/62d007ed-6e13-42cb-bc9b-28051f4eac27.mp4?rlkey=jviz8t2eylqt3ya5nmvegtcbz&st=e0vpwis5&dl=0">
            </video>
            <div id="editprofile">
                <img src="<?php echo $_SESSION['avatar']?>" id="avatar">
                <script>
                    let avatar=document.getElementById("avatar");
                    avatar.style.width="176px";
                    avatar.style.height="176px";
                </script>
                <h2><?php echo $_SESSION['username']; ?></h2>
                <button id="edit">EDIT PROFILE</button>
                <button id="logout">LOGOUT</button>
            </div>
            <video id="rightvideo" muted autoplay loop>
                <source src="https://dl.dropboxusercontent.com/scl/fi/3bzwjf5gfkuylocwhs86b/62d007ed-6e13-42cb-bc9b-28051f4eac27.mp4?rlkey=jviz8t2eylqt3ya5nmvegtcbz&st=e0vpwis5&dl=0">
            </video>
        </div>
        <?php require_once "../controllers/CheckRecentWatched.php" ?>

        <h2 style="display:block;background-color: #3d3d3d55;padding-top:10px">Recent Watched</h2>
            <div id="watched">
            <?php
                if (!empty($watchedItems)) {
                    foreach ($watchedItems as $item) {
                        if (!empty($item['id_movie']) && !empty($item['thumbnail_movie'])) {
                            echo "<img class='video-link' src='" . $item['thumbnail_movie'] . "' alt='movie thumbnail' onclick='showMovie(" . $item['id_movie'] . ")' >";
                        }
                        if (!empty($item['id_trailer']) && !empty($item['thumbnail_trailer'])) {
                            echo "<img class='video-link' src='" . $item['thumbnail_trailer'] . "' alt='trailer thumbnail' onclick='showTrailer(" . $item['id_trailer'] . ")'>";
                        }
                    }
                }
            ?>
        </div>
        <script src="/IS207.O21-DoAnNhom2/public/js/profile.js"></script>
        
    </body>
</html>