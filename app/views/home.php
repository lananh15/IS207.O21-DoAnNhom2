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
    <link rel="stylesheet" type="text/css" href="../../public/css/menu.css" />
    <link rel="stylesheet" type="text/css" href="../../public/css/home.css" />
    <script src="menu.js"></script>
    <!-- PC screen -->
    <!-- <link rel="stylesheet" type="text/css" media="(min-width:1024px)" href="home.css" /> -->
    <title>Home</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
</head>

<body>
    <header>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <ul id="menu">
                <li><a href="home.php">Home</a></li>
                <li>
                    <a href="watch.html">Watch</a>
                    <ul id="submenu">
                        <li><a href="trailer.html">Trailer</a></li>
                        <li><a href="movie.html">Movie</a></li>
                    </ul>
                </li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About us</a></li>
                <li><a href="contact.html">Contact us</a></li>
                <span></span>
            </ul>
            <div id="logo-container">
                <img src="../../public/images&videos/logo.png" id="logo">
            </div>
            <div id="log-sign">
                <button>
                    <a href="login.html">Log in</a>
                </button>
                <button>
                    <a href="signup.html">Sign up</a>
                </button>
            </div>
        </nav>
    </header>
    <div id="banner">
        <div id="text-banner">
            <h2>Welcome to the headquarters</h2>
                <h1 data-text="Inside Out">Inside Out</h1>
                <h3>Disney &nbsp;</h3>
                <h3 style="font-family: pixar !important;">Pixar</h3>        
        </div>     
    </div>
    <div id="short-about">
        <div>
            <h3>About inside out</h3>
            <p><br>
                Inside Out is an animated comedy about a girl named Riley, 
                who is uprooted from her life in the US Midwest when her father gets a new job in San Francisco. 
                Riley is largely guided by her emotions, each of which is shown as an actual character.
            </p>
        </div>
        <div>
            <img src="../../public/images&videos/Home/isslands 1.png" width="50%">
        </div>
    </div>
    <div id="short-gif">
        <br>
        <div>
            <h3>Meet the little voices</h3>
            <h3>inside your head ! !</h3>
        </div>
        <img src="../../public/images&videos/Home/insideout-bg.gif" width="100%">
    </div>
    <div id="char-container">
        <?php
            require_once '../models/Character.php';
        ?>
    </div>
    <div id="short-video">
        <h2>Get ready to feel!</h2>
        <h3>Inside Out 2 is coming to cinema on June 14th 2024!</h3>
        <div id="video-container">
            <video loop>
                <source src="../../public/images&videos/Home/video.mp4">
            </video>
        </div>
    </div>
    <div id="movie-available">
        <h3 style="padding-top:5vw">Haven't watched the movie yet?<br>
                                    Inside Out (2015) is now available on our website!
        </h3>
        <img src="../../public/images&videos/Home/INSIDEOUT1 2.png">
        <input type="button" value="Click here" id="watch-btn">
        <div id="award">
            <h2>Award</h2>
            <h4>The awards below are for Inside Out (2015)</h4>
            <p>
                BEST ANIMATED FEATURE<br><br>
                <?php
                    require_once '../models/Award.php';
                    mysqli_close($conn);
                ?>
            </p>
        </div>
    </div>
    <footer>
        <div id="footer-container">
            <img src="../../public/images&videos/logo.png">
            <section id="icon">
                <i class="fa-brands fa-youtube"></i>
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-tiktok"></i>
            </section>
            <div>
                <a href="about.html">About us</a>
                <a href="contact.html">Contact us</a>
            </div>
            <hr>
            <p>&copy;Disney&copy;Disney/Pixar&copy;&trade;Lucasfilm Ltd.&copy;Marvel, Disney Entertainment</p>
        </div>
        
    </footer>
    <script src="../../public/js/home.js"></script>
</body>

</html>