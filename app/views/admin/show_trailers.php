<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/auth_check.php';

$get_id = $_GET['trailer_id'];


if(isset($_POST['delete_comment'])){

   $comment_id = $_POST['comment_id'];
   $comment_id = filter_var($comment_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $delete_comment = $conn->prepare("DELETE FROM `trailer_comments` WHERE id = ?");
   $delete_comment->execute([$comment_id]);
   $message[] = 'Comment Deleted!';

}

?>
<?php
function get_avatar_src($avatar) {
    if (is_url($avatar) || is_local_file($avatar)) {
        return $avatar;
    }
    return '/IS207.O21-DoAnNhom2/public/images&videos/user1.png';
}

function is_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}
function is_local_file($path) {
    return file_exists($_SERVER["DOCUMENT_ROOT"] . $path);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trailer Comments</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
   <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">

</head>
<body>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>

<section class="read-post">

   <?php
      $select_trailers = $conn->prepare("SELECT * FROM `trailers` WHERE id_trailer = ?");
      $select_trailers->execute([$get_id]);
      if($select_trailers->rowCount() > 0){
         while($fetch_trailers = $select_trailers->fetch(PDO::FETCH_ASSOC)){
            $trailer_id = $fetch_trailers['id_trailer'];
            $count_trailer_comments = $conn->prepare("SELECT * FROM `trailer_comments` WHERE trailer_id = ?");
            $count_trailer_comments->execute([$trailer_id]);
            $total_trailer_comments = $count_trailer_comments->rowCount();

   ?>
   <form method="post">
      <input type="hidden" name="trailer_id" value="<?= $trailer_id; ?>">
      <?php if($fetch_trailers['image'] != ''){ ?>
                            <img src="<?= $fetch_trailers['image']; ?>" class="image" alt="">
                            <?php 
                        } 
                        ?>
      <div class="icons">
         <div class="icons-format"><i class="fas fa-comment"></i><span><?= $total_trailer_comments; ?></span></div>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no videos added yet!</p>';
      }
   ?>

</section>

<section class="comments" style="padding-top: 0;">
   
   <p class="comment-title">Trailer comments</p>
   <div class="box-container">
   <?php
      $select_comments = $conn->prepare("SELECT pc.*, u.avatar, u.username FROM `trailer_comments` pc JOIN `users` u ON pc.user_id = u.id WHERE pc.trailer_id = ?");
      $select_comments->execute([$get_id]);
      if($select_comments->rowCount() > 0){
         while($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)){
            $avatar_src = get_avatar_src($fetch_comments['avatar']);
      ?>
   <div class="box">
      <div class="user">
         <img src="<?= $avatar_src ?>" alt="Avatar" class="avatar">
         <div class="user-info">
            <span><?= $fetch_comments['username']; ?></span>
            <div><?= $fetch_comments['date']; ?></div>
         </div>
      </div>
      <div class="text"><?= $fetch_comments['comment']; ?></div>
      <form action="" method="POST">
         <input type="hidden" name="comment_id" value="<?= $fetch_comments['id']; ?>">
         <button type="submit" class="inline-delete-btn" name="delete_comment" onclick="return confirm('delete this comment?');">delete comment</button>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no comments added yet!</p>';
      }
   ?>
   </div>

</section>
<!-- custom js file link  -->
<script src="/IS207.O21-DoAnNhom2/public/js/admin_script.js"></script>


</body>
</html> 