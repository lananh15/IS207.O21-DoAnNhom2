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
    <link rel="stylesheet" type="text/css" href="../../public/css/blog2.css" />
    <title>Blog</title>
    <link rel="icon" type="image/x-icon"

</head>
<body>
    <?php require_once "header.php" ?>
    <div id="banner">
        <h2>Feature</h2>
        <h1>Anxiety - The new</h1>
        <h1>leader of Riley’s mind</h1>
        <h3 >Published on April <span>17<sup>th</sup></span>, 2024</h3>
    </div>
    <div id="Anxiety">
        <h2>This blog is devoted to Anxiety - our leading emotion when making this website.</h2>
        <p id="first">I honestly love Anxiety's design and her being a workaholic so much.</p>
        <p id="second">We often joke around saying that she looks so ugly, yet we do keep in mind that when you devote yourself to work 24/7, you won't have time to take care of yourself.</p>
       <center><img src="../../public/images&videos/Blog2/anxiety-concept-art.png" id="anxiety-concept-art"></center>
       <div id="ending">
            <center><p id="third" >Anxiety’s concept art</p> </center> 
            <p id="four">Tensed and shaky.</p>
       </div>
       <div id="sign">
        <p id="actor">By Muoidiemdoanweb</p>
        <p id="date">Updated on April <span>17<sup>th</sup></span> 2024</p>
       </div>
    </div>
    <br>
    <hr id="h1">
    <div id="comment-container">
        <div id="comment"> <div id="number"> </div> comment</div>
        <form class="comment-form">
           <img src="../../public/images&videos/Blog2/avatar.png" alt="Avatar" class="avatar">
            <input type="text" placeholder="Leave a comment" class="comment-box">
        </form>  
    </div>
    <div class="button-container">
        <button type="submit" id="Cancel" class="button-blog">Cancel</button>
        <button type="submit" id="Send" class="button-blog" onclick="insertcomment()">Send</button>
    </div>
    <div class="insert-comment">

    </div>
    <?php require_once "footer.php" ?>
</body>
<script>
    
</script>
</html>