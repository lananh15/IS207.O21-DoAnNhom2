<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/normalize.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/header.css" />
    <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/sub-blog.css?v=<?php echo time(); ?>">
    <title>Blog 2</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
    <script src="/IS207.O21-DoAnNhom2/public/js/sub-blog.js"></script>
</head>

<body>
<?php 
    require_once "header.php"; 
    require_once "../models/PostId.php"; 
    $postDetails = getPost(23);
?>
<div id="banner">
    <?php
    $select_posts = $conn->prepare("SELECT * FROM posts WHERE status = 'active' AND id=23 ORDER BY date DESC");
    $select_posts->execute();
    if ($select_posts->rowCount() > 0) {
        while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {
            $image_data_base64 = $fetch_posts['imagedata'];
            if ($image_data_base64 != '') {
                $imagedata = base64_decode($image_data_base64);
                $image_src = 'data:image/jpeg;base64,' . base64_encode($imagedata);
                echo '<img src="' . $image_src . '" class="image" alt="">';
            }
        }
    }
    ?>
</div>
<div id="Main-content">
    <h2><?php echo $postDetails['title'] ?></h2>
    <p id="content"><?php echo $postDetails['content'] ?></p>
    <div id="sign">
        <p id="author">By <?php echo $postDetails['author'] ?></p>
        <p id="date"><?php echo $postDetails['date'] ?></p>
    </div>
</div>
<br>
<hr id="h1">
    <div id="comment-container">
        <div id="comment">
            <?php
                $get_comment_count = $conn->prepare("SELECT post_id, COUNT(*) AS comment_count FROM post_comments GROUP BY post_id");
                $get_comment_count->execute();
                $comment_counts = $get_comment_count->fetchAll(PDO::FETCH_ASSOC);
                $comment_count_map = [];
                foreach ($comment_counts as $count) {
                    $comment_count_map[$count['post_id']] = $count['comment_count'];
                }
                $current_post_comment_count = isset($comment_count_map[$postDetails['id']]) ? $comment_count_map[$postDetails['id']] : 0;
            ?>
            <div id="number"><?php echo $current_post_comment_count; ?></div> comment<?php echo ($current_post_comment_count !== 1) ? 's' : ''; ?>
        </div>
        <form class="comment-form" method="post" action="" id="comment-form">
            <img src="/IS207.O21-DoAnNhom2/public/images&videos/user1.png" alt="Avatar" class="avatar">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($postDetails['id']); ?>">
            <textarea name="comment" placeholder="Leave a comment" class="comment-box" id="comment-box"></textarea>
            <button type="submit" id="send" name="send" class="button-blog">Send</button>
            <button type="reset" id="cancel" name="cancel" class="button-blog">Cancel</button>
        </form>
    </div>
    <div class="insert-comment">
    <?php
        $post_id = isset($postDetails['id']) ? $postDetails['id'] : null;
        if ($post_id) {
            $get_comments = $conn->prepare("SELECT pc.*, u.avatar, u.username AS username FROM post_comments pc INNER JOIN users u ON pc.user_id = u.id WHERE pc.post_id = ? ORDER BY pc.date DESC");
            $get_comments->execute([$post_id]);
            $comments = $get_comments->fetchAll();
        } else {
            die("Error: post_id is not set.");
        }

        function get_avatar_src($avatar) {
            if (filter_var($avatar, FILTER_VALIDATE_URL)) {
                return $avatar;
            }
            if (file_exists($_SERVER["DOCUMENT_ROOT"] . $avatar)) {
                return $avatar;
            }
            return '/IS207.O21-DoAnNhom2/public/images&videos/user1.png';
        }

        foreach ($comments as $comment) {
            $avatar_src = get_avatar_src($comment['avatar']);
            echo '<div class="comment-item">
                    <div class="comment-content">
                        <img src="' . htmlspecialchars($avatar_src) . '" alt="Avatar" class="comment-avatar" onerror="this.onerror=null; this.src=\'/IS207.O21-DoAnNhom2/public/images&videos/user1.png\';">
                        <div class="comment-details">
                            <span class="comment-username">' . htmlspecialchars($comment['username']) . '</span>
                            <p class="comment-text">' . htmlspecialchars($comment['comment']) . '</p>
                            <span class="comment-timestamp">' . htmlspecialchars($comment['date']) . '</span>
                        </div>
                    </div>
                </div>';
        }
    ?>
</div>

    <?php require_once "footer.php"; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/IS207.O21-DoAnNhom2/public/js/sub-blog.js"></script>
</html>
