<?php require_once '../models/feedback_processor.php'?>
<?php require_once '../models/Watch-video.php'?>
<?php require_once '../models/View.php' ?>
<?php require_once '../models/Comment-video.php' ?>
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
    <link rel="stylesheet" type="text/css" href="../../public/css/watch-coiphim.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Watch</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
        <script src="../../public/js/watch-coiphim.js"></script>  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <?php require_once "header.php" ?>
    <main>
        <div id="video">
            <video id="movie-screen" controls autoplay>
                <source src="<?php echo $videoUrl; ?>" type="video/mp4">
                
                Your browser does not support the video tag.
            </video>
        </div>
        <div id="view">View:  <span id="view-count"><?php echo $viewCount; ?></span></div>
        <h1>inside out</h1>
        <div id="feedback" id="feedback" data-logged-in="<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>">
            <?php
                $isLiked = userLiked($conn, $user_id, $id, $type);
                $isDisliked = userDisliked($conn, $user_id, $id, $type);
            ?>
            <span class="like-count"><?php echo getLikes($conn, $id, $type); ?></span>
            <i id="like" class="bi <?php echo $isLiked ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up'; ?> like-btn" data-id="<?php echo htmlspecialchars($id); ?>" data-type="<?php echo htmlspecialchars($type); ?>"></i>
            <span class="dislike-count"><?php echo getDislikes($conn, $id, $type); ?></span>
            <i id="dislike" class="bi <?php echo $isDisliked ? 'bi-hand-thumbs-down-fill' : 'bi-hand-thumbs-down'; ?> dislike-btn" data-id="<?php echo htmlspecialchars($id); ?>" data-type="<?php echo htmlspecialchars($type); ?>"></i>
        </div>
        
        <hr>
        <div id="comment-container" data-id="<?php echo htmlspecialchars($id); ?>" data-type="<?php echo htmlspecialchars($type); ?>" data-logged-in="<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>" data-username="<?php if(isset($_SESSION['username'])) {echo htmlspecialchars(($_SESSION['username']));} ?>">
            <div id="comment"> <div id="number"><?php echo $comment_count ?></div> comment</div>
                <form class="comment-form" onsubmit="return false;">
                <img src="<?php echo isset($avatar) ? $avatar : '../../public/images&videos/user1.png'; ?>" alt="Avatar" class="avatar">
                <input type="text" placeholder="Leave a comment" class="comment-box" id="comment-box">
                </form>  
            </div>
            <div class="button-container">
                <button type="submit" id="Cancel" class="button-blog" onclick="cancelComment()">Cancel</button>
                <button type="submit" id="Send" class="button-blog" onclick="insertComment()">Send</button>
            </div>
            <!-- comment -->
            <div class="insert-comment">
            <?php
                if(isset($comments) && !empty($comments)): 
                    foreach ($comments as $comment): 
            ?>
                <div class="comment-item">
                    <div class="comment-content">
                        <?php if(isset($comment['avatar'])): ?>
                            <img src="<?php echo htmlspecialchars($comment['avatar']); ?>" alt="Avatar" class="comment-avatar">
                        <?php endif; ?>
                        <div class="comment-details">
                            <?php if(isset($comment['username'])): ?>
                                <span class="comment-username"><?php echo htmlspecialchars($comment['username']); ?></span>
                            <?php endif; ?>
                            <?php if(isset($comment['comment'])): ?>
                                <p class="comment-text"><?php echo htmlspecialchars($comment['comment']); ?></p>
                            <?php endif; ?>
                            <?php if(isset($comment['date'])): ?>
                            <?php
                                $date = new DateTime($comment['date']);
                                $formattedDate = $date->format('d-m-Y H:i:s');
                            ?>
                            <span class="comment-timestamp"><?php echo htmlspecialchars($formattedDate); ?></span>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                    <?php endforeach; ?>
                        <?php endif; ?>
            </div>
    </main>
    <?php require_once "footer.php" ?>
</body>
</html>