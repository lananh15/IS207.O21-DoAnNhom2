<?php
require_once '../controllers/GetUserId.php'; 
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-...your-integrity-hash-here..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/normalize.css" />
    <link rel="stylesheet" 
      href= "https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/header.css" />
    <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/watch2.css" />
    <title>Watch</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        <?php if (isset($_SESSION['user_id'])): ?>
            var userId = <?php echo json_encode($_SESSION['user_id']); ?>;
            console.log("User ID:", userId); 
        <?php else: ?>
            var userId = null;
            console.log("User ID is null"); 
        <?php endif; ?>
    </script>

</head>

<body>
    <?php 
        require_once "header.php" ;

        require_once "../models/Movie.php";
        $movieDetails = getMovie(2);

        require_once "../models/Cast.php"; 
        $castDetails = getCast(2);

        require_once "../models/Trailer.php";
        $trailerDetails = getTrailerImages(2);
    ?>

    <main>
        <img id="banner" src="/IS207.O21-DoAnNhom2/public/images&videos/Watch/Watch2/movie-bg-2.png" alt="banner">
        <img id="poster" src="<?php echo $movieDetails['image_movie'];?>" alt="moive-poster-2">

        <div id="duration">
            <div class="duration">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M31.9999 58.6668C46.7275 58.6668 58.6666 46.7278 58.6666 32.0002C58.6666 17.2726 46.7275 5.3335 31.9999 5.3335C17.2723 5.3335 5.33325 17.2726 5.33325 32.0002C5.33325 46.7278 17.2723 58.6668 31.9999 58.6668Z"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M32 16V32L42.6667 37.3333" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <p class="duration-content"><?php echo $movieDetails['duration'] ?> minutes</p>
        </div>
        
        <div id="tags">
            <div class="tag">Fantasy</div>
            <div class="tag">Comedy</div>
            <div class="tag">Action</div>
            <div class="tag">Animation</div>
            <div class="tag">Cartoon</div>
            <div class="tag">Adventure</div>
        </div>

        <button id="comming-soon">COMING SOON</button>

        <div id="info">
            <div>Directed by:</div>
            <div><?php echo $movieDetails['director']; ?></div>
            <div>Country:</div>
            <div><?php echo $movieDetails['country'] ?></div>
            <div>Release dates:</div>
            <div><?php echo $movieDetails['release_date'] ?></div>
        </div>

        <div id="description">
            <p><?php echo $movieDetails['description'] ?></p>
        </div>

        <p id="cast">cast</p>
        <div id="casts-info">
            <?php 
                foreach ($castDetails as $cast): ?>
                    <div>
                        <div>
                            <img src="<?php echo $cast['image']; ?>" alt="<?php echo $cast['name']; ?>">
                            <p class="name-actor" id="<?php echo str_replace(' ', '-', $cast['name']); ?>"><?php echo $cast['name']; ?></p>
                            <p class="name-voice" ><?php echo $cast['role']; ?></p>
                        </div>
                    </div>
                <?php endforeach;
            ?>
        </div>
        
        <p id="trailer">Trailer</p>
        <div id="trailers">
            <?php 
                foreach ($trailerDetails as $trailer): ?>
                    <img src="<?php echo $trailer['image']; ?>" alt="Trailer <?php echo $trailer['id_trailer']; ?>" onclick="showTrailer(<?php echo $trailer['id_trailer']; ?>)" id="trailer-link">
                <?php endforeach;
            ?>
        </div>
    </main>

    <?php require_once "footer.php" ?>
    <script src="/IS207.O21-DoAnNhom2/public/js/watch-video.js"></script>
</body>

</html>