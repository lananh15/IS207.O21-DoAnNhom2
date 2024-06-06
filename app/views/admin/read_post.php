<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/auth_check.php';

$get_id = $_GET['post_id'];


if(isset($_POST['delete_comment'])){

   $comment_id = $_POST['comment_id'];
   $comment_id = filter_var($comment_id, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $delete_comment = $conn->prepare("DELETE FROM `post_comments` WHERE id = ?");
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
   <title>Post Comments</title>
   <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">

</head>
<body>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>

<section class="read-post">

   <?php
      $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
      $select_posts->execute([$get_id]);
      if($select_posts->rowCount() > 0){
         while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
            $post_id = $fetch_posts['id'];

            $count_post_comments = $conn->prepare("SELECT * FROM `post_comments` WHERE post_id = ?");
            $count_post_comments->execute([$post_id]);
            $total_post_comments = $count_post_comments->rowCount();

   ?>
   <form method="post">
      <input type="hidden" name="post_id" value="<?= $post_id; ?>">
      <div class="status" style="background-color:<?php if($fetch_posts['status'] == 'active'){echo 'limegreen'; }else{echo 'coral';}; ?>;"><?= $fetch_posts['status']; ?></div>
      <?php
   $image_data_base64 = $fetch_posts['imagedata'];
   if($image_data_base64 != ''){
      $imagedata = base64_decode($image_data_base64);
      $image_src = 'data:image/jpeg;base64,' . base64_encode($imagedata);
?>
   <img src="<?= $image_src ?>" class="image" alt="">
<?php
   }
?>
      <div class="title"><?= $fetch_posts['title']; ?></div>
      <div class="content"><?= $fetch_posts['content']; ?></div>
      <div class="author"><?= $fetch_posts['author']; ?></div>
      <div class="icons">
         <div class="comments"><i class="fas fa-comment"></i><span><?= $total_post_comments; ?></span></div>
      </div>
      <div class="flex-btn">
         <a href="edit_post.php?id=<?= $post_id; ?>" class="inline-option-btn">edit</a>
        
         <a href="view_posts.php" class="inline-goback-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no posts added yet! <a href="add_posts.php" class="btn" style="margin-top:1.5rem;">add post</a></p>';
      }
   ?>

</section>

<section class="comments" style="padding-top: 0;">
   
   <p class="comment-title">Post comments</p>
   <div class="box-container">
   <?php
      $select_comments = $conn->prepare("SELECT pc.*, u.avatar FROM `post_comments` pc JOIN `users` u ON pc.user_id = u.id WHERE pc.post_id = ?");
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