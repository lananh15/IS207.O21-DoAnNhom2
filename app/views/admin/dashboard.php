<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/auth_check.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">

</head>
<body>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>
<?php require_once $_SERVER["DOCUMENT_ROOT"] .  '/IS207.O21-DoAnNhom2/app/controllers/Stats_Dashboard.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
      <h3><?= get_number_of_posts($conn); ?></h3>
      <p>Posts Added</p>
      <a href="add_posts.php" class="btn">Add new post</a>
   </div>

   <div class="box">
      <h3><?= get_number_of_active_posts($conn); ?></h3>
      <p>Published Posts</p>
      <a href="view_posts.php" class="btn">See posts</a>
   </div>

   <div class="box">
      <h3><?= get_number_of_videos($conn); ?></h3>
      <p>Videos</p>
      <a href="total_videos.php" class="btn">See videos</a>
   </div>

   <div class="box">
      <h3><?= get_number_of_users($conn); ?></h3>
      <p>Users Account</p>
      <a href="users_accounts.php" class="btn">See users</a>
   </div>
   
   <div class="box">
      <h3><?= get_number_of_comments($conn); ?></h3>
      <p>Comments Added</p>
      <a href="total_comments.php" class="btn">See comments</a>
   </div>

   <div class="box">
      <h3><?= get_number_of_reactions($conn); ?></h3>
      <p>Total Reactions</p>
      <a href="total_reactions.php" class="btn">See reactions</a>
   </div>


   </div>

</section>
<!-- admin dashboard section ends -->

<!-- custom js file link  -->
<script src="/IS207.O21-DoAnNhom2/public/js/admin_script.js"></script>

</body>
</html>