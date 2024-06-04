<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/auth_check.php';

if (isset($_POST['publish']) || isset($_POST['draft'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $author = filter_var($_POST['author'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = isset($_POST['publish']) ? 'active' : 'deactive';

    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_data = file_get_contents($image_tmp_name);
    $image_data_base64 = base64_encode($image_data);

    $insert_post = $conn->prepare("INSERT INTO `posts`(title, content, author, imagedata, status) VALUES(?,?,?,?,?)");
    $insert_post->execute([$title, $content, $author, $image_data_base64, $status]);
    
    $message[] = isset($_POST['publish']) ? 'Post published!' : 'Draft saved!';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">
</head>
<body>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>
<section class="post-editor">
    <h1 class="heading">Add a new memory</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <p>POST TITLE <span>*</span></p>
        <input type="text" name="title" maxlength="100" required placeholder="Add title" class="box">
        <p>POST CONTENT <span>*</span></p>
        <textarea name="content" class="box" required maxlength="10000" placeholder="Write content..." rows="10"></textarea>
        <p>POST AUTHOR <span>*</span></p>
        <input type="text" name="author" maxlength="100" required placeholder="Add author" class="box">
        <p>POST IMAGE</p>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
        <div class="flex-btn">
            <input type="submit" value="Publish Post" name="publish" class="btn">
            <input type="submit" value="Save Draft" name="draft" class="option-btn">
        </div>
    </form>
</section>

<script src="/IS207.O21-DoAnNhom2/public/js/admin_script.js"></script>

</body>
</html>