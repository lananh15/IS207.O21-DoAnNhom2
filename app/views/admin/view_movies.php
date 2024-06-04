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
    <title>Movies Archive</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>
<section class="show-items">
    <h1 class="heading">Movies archive</h1>
    <div class="box-container">
            <?php
            // Code để lấy và hiển thị ảnh từ cơ sở dữ liệu
            $select_movies = $conn->prepare("SELECT * FROM movies");
            $select_movies->execute();
            if ($select_movies->rowCount() > 0) {
                while ($fetch_movies = $select_movies->fetch(PDO::FETCH_ASSOC)) {
                    $movie_id = $fetch_movies['id_movie'];

                    $count_movies_views = $conn->prepare("SELECT view FROM movies WHERE id_movie = ?");
                    $count_movies_views->execute([$movie_id]);
                    $total_movies_views = $count_movies_views->fetchColumn(); 

                    $count_movies_comments = $conn->prepare("SELECT * FROM movie_comments WHERE movie_id = ?");
                    $count_movies_comments->execute([$movie_id]);
                    $total_movies_comments = $count_movies_comments->rowCount();
                
                    $count_movies_likes = $conn->prepare("SELECT * FROM `movie_reactions` WHERE action = 'like' AND movie_id = ?");
                    $count_movies_likes->execute([$movie_id]);
                    $total_movies_likes = $count_movies_likes->rowCount();

                    $count_movies_dislikes = $conn->prepare("SELECT * FROM `movie_reactions` WHERE action = 'dislike' AND movie_id = ?");
                    $count_movies_dislikes->execute([$movie_id]);
                    $total_movies_dislikes = $count_movies_dislikes->rowCount();

                ?>
                    <form method="post" class="box">
                        <input type="hidden" name="move_id" value="<?= $movie_id; ?>">
                        <?php if($fetch_movies['image_movie'] != ''){ ?>
                            <img src="<?= $fetch_movies['image_movie'];?>" class="image" alt="">
                            <?php 
                        } 
                        ?>
                        <div class="icons">
                        <div class="icons-format"><i class="fa-solid fa-eye"></i><span><?= $total_movies_views; ?></span></div>
                        <div class="icons-format"><i class="fas fa-comment"></i><span><?= $total_movies_comments; ?></span></div>
                        <div class="icons-format"><i class="fa-solid fa-thumbs-up"></i><span><?= $total_movies_likes; ?></span></div>
                        <div class="icons-format"><i class="fa-solid fa-thumbs-down"></i><span><?= $total_movies_dislikes; ?></span></div>
                        </div>
                        <a href="show_movies.php?movie_id=<?= $movie_id; ?>" class="btn">View Movie</a>
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