<?php
    echo "<header>
        <nav>
            <input type='checkbox' id='check'>
            <label for='check' class='checkbtn'>
                <i class='fas fa-bars'></i>
            </label>
            <ul id='menu'>
                <li><a href='home.php'>Home</a></li>
                <li><a href='watch.php'>Watch</a></li>
                <li><a href='blog.php'>Blog</a></li>
                <li><a href='about.php'>About us</a></li>
                <li><a href='contact.php'>Contact us</a></li>
                <span></span>
            </ul>
            <div id='logo-container'>
                <img src='../../public/images&videos/logo.png' id='logo'>
            </div>
            <div id='log-sign'>";
                session_start();

                if (isset($_SESSION['username']) && isset($_SESSION['avatar'])) {
                    $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
                    echo "<p>" . "Welcome, $username!" . "</p>";
                    $avatar = htmlspecialchars($_SESSION['avatar'], ENT_QUOTES, 'UTF-8');
                    echo "<a href='account.php' id='avt'><img src='" . $avatar . "'></a>";
                } 
                else {
                    echo '<button><a href="login-signup/login.php">Log in</a></button>&nbsp;';
                    echo '<button><a href="login-signup/signup.php">Sign up</a></button>';      
                }
            echo "</div>
        </nav>
    </header>";
?>