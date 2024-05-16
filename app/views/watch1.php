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
    <link rel="stylesheet" type="text/css" href="../../public/css/normalize.css" />
    <link rel="stylesheet" 
      href= "https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/header.css" />
    <link rel="stylesheet" type="text/css" href="../../public/css/watch1.css" />
    <title>Watch</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">

</head>

<body>
    <?php require_once "header.php" ?>
    <main>
        <div id="banner">
            <img id="poster" src="../../public/images&videos/Watch/Watch1/movie-poster-1.png" alt="moive-poster-1" id="poster">
            <button id="watch">WATCH</button>
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
                <p class="duration-content">95 minute</p>
            </div>
            <div id="tags">
                <div class="tag">Fantasy</div>
                <div class="tag">Comedy</div>
                <div class="tag">Action</div>
                <div class="tag">Animation</div>
                <div class="tag">Cartoon</div>
                <div class="tag">Adventure</div>
            </div>
        </div>
        <div id="movie-info">
            <div>Directed by:</div>
            <div>Peter Docter</div>
            <div>Country:</div>
            <div>United States</div>
            <div>Release dates:</div>
            <div>May 18, 2015</div>
        </div>
            <div id="movie-description">
                <p>
                    Growing up can be a bumpy road,
                    and it's no exception for Riley,
                    who is uprooted from her Midwest life when her father starts a new job in San Francisco.
                    Like all of us, Riley is guided by her emotions - Joy, Fear, Anger, Disgust and Sadness.
                    The emotions live in Headquarters, the control center inside Riley's mind,
                    where they help advise her through everyday life.
                    As Riley and her emotions struggle to adjust to a new life in San Francisco,
                    turmoil ensues in Headquarters.
                    Although Joy, Riley's main and most important emotion,
                    tries to keep things positive,
                    the emotions conflict on how best to navigate a new city, house and school.
                </p>
            </div>
            <p id="cast">cast</p>
            <div id="cast-infor">
                <div>
                    <div>
                        <img src="../../public/images&videos/Watch/Watch1/Amy Poehler.png" alt="Amy Poehler">
            
                        <p class="name-actor">Amy Poehler</p>
                        <p class="name-voice">Joy (voice)</p>
                    </div>
                </div>
                <div>
                    <div>
                        <img src="../../public/images&videos/Watch/Watch1/Mindy Karling.png" alt="Mindy Karling">
            
                        <p class="name-actor">Mindy Karling</p>
                        <p class="name-voice">Disgust (voice)</p>
                    </div>
                </div>
                <div>
                    <div>
                        <img src="../../public/images&videos/Watch/Watch1/Phyllis Smith.png" alt="Phyllis Smith">
            
                        <p class="name-actor">Phyllis Smith</p>
                        <p class="name-voice">Sadness (voice)</p>
                    </div>
                </div>
                <div>
                    <div>
                        <img src="../../public/images&videos/Watch/Watch1/Lewis Black.png" alt="Lewis Black">
            
                        <p class="name-actor">Lewis Black</p>
                        <p class="name-voice">Anger (voice)</p>
                    </div>
                </div>
                <div>
                    <div>
                        <img src="../../public/images&videos/Watch/Watch1/Bill Hader.png" alt="Bill Hader">
            
                        <p class="name-actor">Bill Hader</p>
                        <p class="name-voice">Fear (voice)</p>
                    </div>
                </div>
                
            </div>
            <p id="trailer">trailer</p>
            <div id="trailers">
                <a href="">
                    <img src="../../public/images&videos/Watch/Watch1/Trailer 3.png" alt="Trailer 3" id="trailer-link">
                </a>
                <a href="">
                    <img src="../../public/images&videos/Watch/Watch1/Trailer 2.png" alt="Trailer 2" id="trailer-link">
                </a>
                <a href="">
                    <img src="../../public/images&videos/Watch/Watch1/Trailer 1.png" alt="Trailer 1" id="trailer-link">
                </a>
            </div>
                
    </main>

    <?php require_once "footer.php" ?>
</body>

</html>