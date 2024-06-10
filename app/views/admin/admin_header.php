<?php
if (isset($message) && is_array($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>' . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>


<header class="header">

   <a href="dashboard.php" class="logo"> <img src='/IS207.O21-DoAnNhom2/public/images&videos/logo.png' id='logo'></a>

   <nav class="navbar">
      <a href="dashboard.php"><span>Dashboard</span></a>
      <a href="add_posts.php"><span>Add Posts</span></a>
      <a href="view_posts.php"><span>View Posts</span></a>
      <a href="view_movies.php"><span>View Movies</span></a>
      <a href="view_trailers.php"><span>View Trailers</span></a>
      <a href="../home" onclick="return confirm('Return to home?');"><span>Return To Home</span></a>
      <a href="../logout.php" style="color:#FF6C58;" onclick="return confirm('Logout from the website?');"><span>Logout</span></a>
   </nav>

</header>

<div id="menu-btn" class="fas fa-bars"></div>