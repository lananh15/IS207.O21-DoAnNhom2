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
    <link rel="stylesheet" type="text/css" href="../../public/css/watch2.css" />
    <title>Watch</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">

</head>

<body>
    <?php require_once "header.php" ?>

    <main>
        <img id="banner" src="../../public/images&videos/Watch/Watch2/movie-bg-2.png" alt="banner">
        <img id="poster" src="../../public/images&videos/Watch/Watch2/movie-poster-2.png" alt="moive-poster-2">

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
            <p class="duration-content">96 minutes</p>
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
            <div>Kelsey Mann</div>
            <div>Country:</div>
            <div>United States</div>
            <div>Release dates:</div>
            <div>June 14, 2024</div>
        </div>

        <div id="description">
            <p>
                Inside Out 2 returns to the mind of newly minted teenager Riley just as headquarters 
                is undergoing a sudden demolition to make room for something entirely unexpected: 
                new Emotions! Joy, Sadness, Anger, Fear and Disgust, who've long been running a successful 
                operation by all accounts, aren'r sure how to feel when Anxiety shows up. And it looks like 
                she's not alone.
            </p>
        </div>

        <p id="cast">cast</p>
        <div id="casts-info">
            <div>
                <img src="../../public/images&videos/Watch/Watch2/Amy Poehler.png" alt="Amy Poehler">
                <div>
                    <p class="name-actor">Amy Poehler</p>
                    <p class="name-voice">Joy (voice)</p>
                </div>
            </div>
            <div>
                <img src="../../public/images&videos/Watch/Watch2/Maya Hawke.png" alt="Maya Hawke">
                <div>
                    <p class="name-actor">Maya Hawke</p>
                    <p class="name-voice">Anxiety (voice)</p>
                </div>
            </div>
            <div>
                <img src="../../public/images&videos/Watch/Watch2/Ayo Edebiri.png" alt="Ayo Edibiri">
                <div>
                    <p class="name-actor">Ayo Edebiri</p>
                    <p class="name-voice">Envy (voice)</p>
                </div>
            </div>
            <div>
                <img src="../../public/images&videos/Watch/Watch2/Adele Exarchopoulos.png" alt="Adèle Exarchopoulos">
                <div>
                    <p class="name-actor" id="adele">Adèle Exarchopoulos</p>
                    <p class="name-voice">Ennui (voice)</p>
                </div>
            </div>
            <div>
                <img src="../../public/images&videos/Watch/Watch2/Paul Walter Hauser.png" alt="Paul Walter Hauser">
                <div>
                    <p class="name-actor">Paul Walter Hauser</p>
                    <p class="name-voice">Embarrassment (voice)</p>
                </div>
            </div>
        </div>
        
        <p id="trailer">Trailer</p>
        <div id="trailers">
            <a href=""><img id="trailer-link" src="../../public/images&videos/Watch/Watch2/Trailer 3.png" alt="Trailer 3"></a>
            <a href=""><img id="trailer-link" src="../../public/images&videos/Watch/Watch2/Trailer 2.png" alt="Trailer 2"></a>   
            <a href=""><img id="trailer-link" src="../../public/images&videos/Watch/Watch2/Trailer 1.png" alt="Trailer 1"></a>
        </div>
    </main>

    <?php require_once "footer.php" ?>
</body>

</html>