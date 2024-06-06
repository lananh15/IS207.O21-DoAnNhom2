<?php
    echo "<header>
        <nav>
            <input type='checkbox' id='check'>
            <label for='check' class='checkbtn'>
                <i class='fas fa-bars'></i>
            </label>
            <ul id='menu'>
                <li><a href='home'>Home</a></li>
                <li><a href='watch'>Watch</a></li>
                <li><a href='blog'>Blog</a></li>
                <li><a href='about'>About us</a></li>
                <li><a href='contact'>Contact us</a></li>
                <span></span>
            </ul>
            <div id='logo-container'>
                <img src='/IS207.O21-DoAnNhom2/public/images&videos/logo.png' id='logo'>
            </div>
            <div id='log-sign'>";
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }      

                if (isset($_SESSION['username']) && isset($_SESSION['avatar'])) {
                    $username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
                    echo "<p>" . $username . "</p>";
                    $avatar = htmlspecialchars($_SESSION['avatar'], ENT_QUOTES, 'UTF-8');

                    require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
                    $sql_check_admin=$conn->prepare("SELECT * FROM users WHERE username= :username");
                    $sql_check_admin->bindParam(":username", $username,PDO::PARAM_STR);
                    if($sql_check_admin->execute()>0 && $username==='admin123'){
                        echo "<a href='admin/dashboard.php' id='avt'><img src='" . $avatar . "'></a>";
                    }
                    else{
                        echo "<a href='profile' id='avt'><img src='" . $avatar . "'></a>";
                    }
                    $password = htmlspecialchars($_SESSION['password'], ENT_QUOTES, 'UTF-8');
                } 
                else {
                    echo '<button id="login-signup"><a href="login">Login</a></button>&nbsp;';
                    echo '<button id="login-signup"><a href="signup">Signup</a></button>';      
                }
            echo "</div>
        </nav>
    </header>";
?>