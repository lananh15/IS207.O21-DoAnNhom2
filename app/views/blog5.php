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
    <link rel="stylesheet" type="text/css" href="../../public/css/blog5.css" />
    <title>Blog 5</title>
    <link rel="icon" type="image/x-icon">
    <script src="../../public/js/sub-blog.js"></script>
<body>
    <?php require_once "header.php" ?>
    <div id="banner">
        <h1>Oops... Looks like this blog is still under construction.</h1>
    </div>
    <hr id="h1">
    <div id="comment-container">
        <div id="comment"> <div id="number">0</div> comment</div>
        <form class="comment-form" onsubmit="return false;">
            <img src="../../public/images&videos/Blog5/avatar.png" alt="Avatar" class="avatar">
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