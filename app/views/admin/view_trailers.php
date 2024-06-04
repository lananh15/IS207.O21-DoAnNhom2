<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/auth_check.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trailers Archive</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>
<section class="show-items">
    <h1 class="heading">Trailers archive</h1>
    <div class="box-container">
            <?php
            // Code để lấy và hiển thị ảnh từ cơ sở dữ liệu
            $select_trailers = $conn->prepare("SELECT * FROM trailers");
            $select_trailers->execute();
            if ($select_trailers->rowCount() > 0) {
                while ($fetch_trailers = $select_trailers->fetch(PDO::FETCH_ASSOC)) {
                    $trailer_id = $fetch_trailers['id_trailer'];

                    $count_trailers_views = $conn->prepare("SELECT view FROM trailers WHERE id_trailer = ?");
                    $count_trailers_views->execute([$trailer_id]);
                    $total_trailers_views = $count_trailers_views->fetchColumn(); 

                    $count_trailers_comments = $conn->prepare("SELECT * FROM trailer_comments WHERE trailer_id = ?");
                    $count_trailers_comments->execute([$trailer_id]);
                    $total_trailers_comments = $count_trailers_comments->rowCount();
                
                    $count_trailers_likes = $conn->prepare("SELECT * FROM `trailer_reactions` WHERE action = 'like' AND trailer_id = ?");
                    $count_trailers_likes->execute([$trailer_id]);
                    $total_trailers_likes = $count_trailers_likes->rowCount();

                    $count_trailers_dislikes = $conn->prepare("SELECT * FROM `trailer_reactions` WHERE action = 'dislike' AND trailer_id = ?");
                    $count_trailers_dislikes->execute([$trailer_id]);
                    $total_trailers_dislikes = $count_trailers_dislikes->rowCount();

                ?>
                    <form method="post" class="box">
                        <input type="hidden" name="trailer_id" value="<?= $trailer_id; ?>">
                        <?php if($fetch_trailers['image'] != ''){ ?>
                            <img src="<?= $fetch_trailers['image']; ?>" class="image" alt="">
                            <?php 
                        } 
                        ?>
                        <div class="icons">
                        <div class="icons-format"><i class="fa-solid fa-eye"></i><span><?= $total_trailers_views; ?></span></div>
                        <div class="icons-format"><i class="fas fa-comment"></i><span><?= $total_trailers_comments; ?></span></div>
                        <div class="icons-format"><i class="fa-solid fa-thumbs-up"></i><span><?= $total_trailers_likes; ?></span></div>
                        <div class="icons-format"><i class="fa-solid fa-thumbs-down"></i><span><?= $total_trailers_dislikes; ?></span></div>
                        </div>
                        <a href="show_trailers.php?trailer_id=<?= $trailer_id; ?>" class="btn">View Trailer</a>
                    </form>
                <?php
                }
            } else {
                echo '<p class="empty-blog">Oops.. Looks like our memories are in the memory dump. <a href="add_posts.php" class="btn" style="margin-top:1.5rem;">add post</a></p>';
            }
            ?>
    </div>
</section>
<script src="/IS207.O21-DoAnNhom2/public/js/admin_script.js"></script>
</body>
</html>