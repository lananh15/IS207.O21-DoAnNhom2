<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/auth_check.php';

if (isset($_POST['save'])) {
    $post_id = $_GET['id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $author = filter_var($_POST['author'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $update_post = $conn->prepare("UPDATE `posts` SET title = ?, content = ?, status = ?, author = ? WHERE id = ?");
    $update_post->execute([$title, $content, $status, $author, $post_id]);

    $message[] = 'Post updated!';

    if (!empty($_FILES['image']['tmp_name'])) {
        // Lấy dữ liệu ảnh từ file tải lên
        $image_data = file_get_contents($_FILES['image']['tmp_name']);

        // Mã hóa dữ liệu ảnh thành chuỗi base64
        $image_data_base64 = base64_encode($image_data);

        // Lưu chuỗi base64 vào cơ sở dữ liệu
        $update_image = $conn->prepare("UPDATE `posts` SET imagedata = ? WHERE id = ?");
        $update_image->execute([$image_data_base64, $post_id]);

        $message[] = 'Image updated!';
    }
}

if (isset($_POST['delete_post'])) {
    $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $delete_post = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
    $delete_post->execute([$post_id]);
    $delete_comments = $conn->prepare("DELETE FROM `post_comments` WHERE post_id = ?");
    $delete_comments->execute([$post_id]);

    $message[] = 'Post deleted successfully!';
}

if (isset($_POST['delete_image'])) {
   $empty_image = '';
   $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $unset_image = $conn->prepare("UPDATE `posts` SET imagedata = ? WHERE id = ?");
   $unset_image->execute([$empty_image, $post_id]);

   $message[] = 'Image deleted successfully!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS File Link -->
    <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">
</head>
<body>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>

<section class="post-editor">
    <h1 class="heading">Edit Post</h1>

    <?php
    $post_id = $_GET['id'];
    $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
    $select_posts->execute([$post_id]);
    if ($select_posts->rowCount() > 0) {
        $fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC);
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="post_id" value="<?= $fetch_posts['id']; ?>">
            <p>POST STATUS <span>*</span></p>
            <select name="status" class="box" required>
                <option value="<?= $fetch_posts['status']; ?>" selected><?= $fetch_posts['status']; ?></option>
                <option value="active">active</option>
                <option value="deactive">deactive</option>
            </select>
            <p>POST TITLE <span>*</span></p>
            <input type="text" name="title" maxlength="100" required placeholder="add post title" class="box" value="<?= $fetch_posts['title']; ?>">
            <p>POST CONTENT <span>*</span></p>
            <textarea name="content" class="box" required maxlength="10000" placeholder="write your content..." cols="30" rows="10"><?= $fetch_posts['content']; ?></textarea>
            <p>POST AUTHOR <span>*</span></p>
            <input type="text" name="author" maxlength="100" required placeholder="Add author" class="box" value="<?= $fetch_posts['author']; ?>">
            <p>POST IMAGE</p>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
            <?php
if (!empty($fetch_posts['imagedata'])) {
    $image_data_base64 = $fetch_posts['imagedata'];
    $image_data = base64_decode($image_data_base64);
    $image_src = 'data:image/jpeg;base64,' . base64_encode($image_data);
    echo '<img src="' . $image_src . '" class="image" alt="">';
    echo '<div class="delete-btn-container"><input type="submit" value="Delete Image" class="inline-delete-btn" name="delete_image"></div>';
} else {
    echo '<p>No image uploaded yet.</p>';
}
?>
            <div class="flex-btn">
                <input type="submit" value="save post" name="save" class="btn">
                <a href="view_posts.php" class="option-btn">go back</a>
                <input type="submit" value="delete post" class="delete-btn" name="delete_post" onclick="return confirm('delete this post?');">
            </div>
        </form>
        <?php
    } else {
        echo '<p class="empty">no posts found!</p>';
        ?>
        <div class="flex-btn">
            <a href="view_posts.php" class="option-btn">view posts</a>
            <a href="add_posts.php" class="option-btn">add posts</a>
        </div>
        <?php
    }
    ?>
</section>

<!-- Custom JS File Link -->
<script src="/IS207.O21-DoAnNhom2/public/js/admin_script.js"></script>

</body>
</html>