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
    <link rel="stylesheet" type="text/css" href="../../public/css/blog3.css" />
    <title>Blog 3</title>
    <link rel="icon" type="image/x-icon">
    <script src="../../public/js/sub-blog.js"></script>
<body>
    <?php require_once "header.php" ?>
    <div id="banner">
        <h1>Meet the new emotions</h1>
        <h3 >Published on April <span>17<sup>th</sup></span>, 2024</h3>
    </div>
    <div id="character">
        <h2>Inside Out 2 is comming soon and we'll have some new faces in town</h2>
        <p class="insideout2">As described by Jason Deamer, production designer on Inside Out 2:</p>
        <p class="insideout2">“Anxiety is orange with electric shape language – tense and shaky. You always see the whites of her eyes and her feather-like hair betrays her constant movements.”</p>
        <p class="insideout2">“Embarrassment is pink like blush with a soft and round shape to evoke his reticence and timidness. He’s a gentle giant, and unfortunately for him, he wants to hide but he’s hard to miss.”</p>
        <p class="insideout2">“Ennui has the posture of a limp noodle. She’s rarely interested enough to lift her own head.”</p>
        <p class="insideout2">“Envy is teal in color, and a smaller, sprouting-mushroom shape to juxtapose against the rest of the cast. Naturally, she wishes she were taller and less childlike.”</p>
        <div id="sign">
            <p id="actor">By Muoidiemdoanweb</p>
            <p id="date">Updated on April <span>17<sup>th</sup></span> 2024</p>
       </div>
    </div>
    <br>
    <hr id="h1">
    <div id="comment-container">
        <div id="comment"> <div id="number">0</div> comment</div>
        <form class="comment-form" onsubmit="return false;">
            <img src="../../public/images&videos/Blog3/avatar.png" alt="Avatar" class="avatar">
            <input type="text" placeholder="Leave a comment" class="comment-box" id="comment-box">
        </form>  
    </div>
    <div class="button-container">
        <button type="submit" id="Cancel" class="button-blog" onclick="cancelComment()">Cancel</button>
        <button type="submit" id="Send" class="button-blog" onclick="insertComment()">Send</button>
    </div>
    <!-- comment -->
    <div class="insert-comment">
    </div>
        <?php require_once "footer.php" ?>
    </body>
</html>