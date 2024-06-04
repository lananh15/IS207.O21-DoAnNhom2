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
   <title>users accounts</title>

   <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="/IS207.O21-DoAnNhom2/public/css/admin.css?v=<?php echo time(); ?>">

</head>
<body>

<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/app/views/admin/admin_header.php'; ?>


<section class="accounts">

   <h1 class="heading">users account</h1>

   <div class="box-container">

   <?php
$select_account = $conn->prepare("SELECT * FROM `users`");
$select_account->execute();
if($select_account->rowCount() > 0){
   while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){ 
      $user_id = $fetch_accounts['id']; 

      // Đếm tổng số comment từ 3 bảng
      $query = "
         SELECT SUM(total) AS total_user_comments
         FROM (
            SELECT COUNT(*) AS total
            FROM movie_comments
            WHERE user_id = ?
            UNION ALL
            SELECT COUNT(*) AS total
            FROM trailer_comments
            WHERE user_id = ?
            UNION ALL
            SELECT COUNT(*) AS total
            FROM post_comments
            WHERE user_id = ?
         ) AS combined_counts
      ";

      $stmt_comments = $conn->prepare($query);
      $stmt_comments->execute([$user_id, $user_id, $user_id]);
      $total_user_comments = $stmt_comments->fetchColumn();

      $query = "
         SELECT SUM(total) AS total_user_likes
         FROM (
            SELECT COUNT(*) AS total
            FROM movie_reactions
            WHERE user_id = ? AND action = 'like'
            UNION ALL
            SELECT COUNT(*) AS total
            FROM trailer_reactions
            WHERE user_id = ? AND action = 'like'
         ) AS combined_likes
      ";

      $stmt_likes = $conn->prepare($query);
      $stmt_likes->execute([$user_id, $user_id]);
      $total_user_likes = $stmt_likes->fetchColumn();
?>
   <div class="box">
      <p> users id : <span><?= $user_id; ?></span> </p>
      <p> username : <span><?= $fetch_accounts['username']; ?></span> </p>
      <p> total comments : <span><?= $total_user_comments; ?></span> </p>
      <p> total likes : <span><?= $total_user_likes; ?></span> </p>
   </div>
<?php
   }
}else{
   echo '<p class="empty">no accounts available</p>';
}
?>

   </div>

</section>

<!-- users accounts section ends -->
<!-- custom js file link  -->
<script src="/IS207.O21-DoAnNhom2/public/js/admin_script.js"></script>


</body>
</html>