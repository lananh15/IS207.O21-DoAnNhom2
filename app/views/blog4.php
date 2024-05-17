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
    <link rel="stylesheet" type="text/css" href="../../public/css/blog4.css" />
    <title>Blog 4</title>
    <link rel="icon" type="image/x-icon">
    <script src="../../public/js/sub-blog.js"></script>
<body>
    <?php require_once "header.php" ?>
    <div id="banner">
        <h1>Riley's crew helps in creating Inside</h1>
        <h1>Out 2!</h1>
        <h3 >Published on April <span>17<sup>th</sup></span>, 2024</h3>
    </div>
    <div id="Riley">
        <h2>Riley's crew is a smart idea</h2>
        <p id="insideout2">In order to make sure Inside Out 2 captured the reality of being a teenage girl, the filmmakers created a focus group of girls ranging in age from 13 to 19. They dubbed the group “Riley’s Crew” and met with them every four months to show them the movie in progress.</p>
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
            <img src="../../public/images&videos/Blog4/avatar.png" alt="Avatar" class="avatar">
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