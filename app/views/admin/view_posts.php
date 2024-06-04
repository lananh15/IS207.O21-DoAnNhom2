<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/auth_check.php';

if(isset($_POST['delete'])){
    $p_id = $_POST['post_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $delete_post = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $delete_post->execute([$p_id]);  
    $delete_comments = $conn->prepare("DELETE FROM post_comments WHERE post_id = ?");
    $delete_comments->execute([$p_id]);
    $message[] = 'Post deleted successfully!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts Archive</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>
<section class="show-items">
    <h1 class="heading">Posts archive</h1>
    <div class="box-container">
            <?php
            // Code để lấy và hiển thị ảnh từ cơ sở dữ liệu
            $select_posts = $conn->prepare("SELECT * FROM posts WHERE status = 'active' OR status = 'deactive' ORDER BY date DESC");
            $select_posts->execute();
            if ($select_posts->rowCount() > 0) {
                while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {
                    $post_id = $fetch_posts['id'];
                    $count_post_comments = $conn->prepare("SELECT * FROM post_comments WHERE post_id = ?");
                    $count_post_comments->execute([$post_id]);
                    $total_post_comments = $count_post_comments->rowCount();

                    $image_data_base64 = $fetch_posts['imagedata'];
                    $imagedata = base64_decode($image_data_base64);
                    $image_src = 'data:image/jpeg;base64,' . base64_encode($imagedata);
                ?>
                    <form method="post" class="box">
                        <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                        <img src="<?= $image_src ?>" class="image" alt="">
                        <div class="status" style="background-color:<?php if($fetch_posts['status'] == 'active'){echo '#3DB23D'; }else{echo '#E17852';}; ?>;"><?= $fetch_posts['status']; ?></div>
                        <div class="title"><?= $fetch_posts['title']; ?></div>
                        <div class="posts-content"><?= $fetch_posts['content']; ?></div>
                        <div class="author"><?= $fetch_posts['author']; ?></div>
                        <div class="icons">
                            <div class="icons-format"><i class="fas fa-comment"></i><span><?= $total_post_comments; ?></span></div>
                        </div>
                        <div class="flex-btn">
                            <a href="edit_post.php?id=<?= $post_id; ?>" class="option-btn">edit</a>
                            <button type="submit" name="delete" class="delete-btn" onclick="return confirm('delete this post?');">delete</button>
                        </div>
                        <a href="read_post.php?post_id=<?= $post_id; ?>" class="btn">View Post</a>
                    </form>
                <?php
                }
            } else {
                echo '<p class="empty-blog">Oops... looks like this blog is still under construction. <a href="add_posts.php" class="btn" style="margin-top:1.5rem;">add post</a></p>';
            }
            ?>
    </div>
</section>
<script src="/IS207.O21-DoAnNhom2/public/js/admin_script.js"></script>
</body>
</html>