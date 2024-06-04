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
<?php require_once $_SERVER["DOCUMENT_ROOT"] .  '/IS207.O21-DoAnNhom2/app/controllers/Stats_TotalComments.php'; ?>
<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/controllers/auth_check.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">Total Comments</h1>

   <div class="box-container">

   <div class="box">
      <h3><?= get_number_of_post_comments($conn); ?></h3>
      <p>Post Comments</p>
      <a href="view_posts.php" class="btn">See Posts</a>
   </div>

   <div class="box">
      <h3><?= get_number_of_movie_comments($conn); ?></h3>
      <p>Movie Comments</p>
      <a href="view_movies.php" class="btn">See Movies</a>
   </div>

   <div class="box">
      <h3><?= get_number_of_trailer_comments($conn); ?></h3>
      <p>Trailer Comments</p>
      <a href="view_trailers.php" class="btn">See Trailers</a>
   </div>

   </div>

</section>
<!-- admin dashboard section ends -->

<!-- custom js file link  -->
<script src="/IS207.O21-DoAnNhom2/public/js/admin_script.js"></script>

</body>
</html>