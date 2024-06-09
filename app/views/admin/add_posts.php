<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/auth_check.php';

// Error handling
function handleError($message) {
    echo "<script>alert('Error: $message');</script>";
    error_log($message);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['publish']) || isset($_POST['draft']))) {
    try {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];
    

        $status = isset($_POST['publish']) ? 'active' : 'deactive';

        // Check if the image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_data = file_get_contents($image_tmp_name);
            $image_data_base64 = base64_encode($image_data);
        } else {
            // Handle no image upload
            $image_data_base64 = '';
            if (isset($_FILES['image']['error']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                handleError('File upload error: ' . $_FILES['image']['error']);
            }
        }

        // Insert post into the database
        $insert_post = $conn->prepare("INSERT INTO `posts` (title, content, author, imagedata, status) VALUES (?, ?, ?, ?, ?)");
        if ($insert_post->execute([$title, $content, $author, $image_data_base64, $status])) {
            $message = isset($_POST['publish']) ? 'Post published!' : 'Draft saved!';
            echo "<script>alert('$message');</script>";
        } else {
            handleError('Failed to insert post');
        }
    } catch (Exception $e) {
        handleError('Exception: ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="icon" type="image/x-icon" href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
</head>
<body>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>
<section class="post-editor">
    <h1 class="heading">Add a new memory</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <h1>POST TITLE <span>*</span></h1>
        <input type="text" name="title" maxlength="100" required placeholder="Add title" class="box">
        <h1>POST CONTENT <span>*</span></h1>
        <textarea name="content" id="content" ></textarea>
        
        <h1>POST AUTHOR <span>*</span></h1>
        <input type="text" name="author" maxlength="100" required placeholder="Add author" class="box">
        <h1>POST IMAGE</h1>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
        <div class="flex-btn">
            <input type="submit" value="Publish Post" name="publish" class="btn">
            <input type="submit" value="Save Draft" name="draft" class="option-btn">
        </div>
    </form>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
<script src="/IS207.O21-DoAnNhom2/public/js/admin_script.js"></script>

</body>
</html>