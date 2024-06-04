<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-...your-integrity-hash-here..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/normalize.css" />
    <link rel="stylesheet" 
      href= "https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/header.css" />
    <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/contact.css" />
    <title>Contact us</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">

</head>

<body>
    <?php include '../controllers/SendEmailContact.php'; ?>
    <!-- Alert messages start -->
    <?php echo $alert; ?>
    <!-- Alert messages end -->

    <?php require_once "header.php" ?>
    <section class="contact">
        <div class="content">
            <h2>Contact us</h2>
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><i class='fa-solid fa-map-location'></i></div>
                    <div class="text">
                        <h3>Address</h3>
                        <p> Ho Chi Minh University of Information Technology </p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class='fa-solid fa-envelope'></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p> insideoutwebsitevn@gmail.com </p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-phone"></i></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p> 0931-028-137 </p>
                    </div>
                </div>
            </div>
            <div class="contactForm">
                <span class="borderline"></span>
                <form method = "post" action = "" name = "emailContact">
                    <h2>Drop us a line </h2>
                    <div class="inputBox">
                        <input type="text" name ="userName" required="required">
                        <span>Your Name</span>
                    </div>
                    <div class="inputBox">
                        <input type="text" name ="userEmail" required="required">
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <textarea name = "userMessage" required="required"></textarea>
                        <span>Type your Message...</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="send" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="social">
        <div class="content">
            <h2>Social Media</h2>
            <p>Want to get up to date and communicate easier?</p>
            <p>Follow us on social media</p>    
        </div>
        <ul>
            <li><a href="https://youtube.com/@pixar?si=xeOZohnVZbSNMV5Z"><i class='fa-brands fa-youtube'></i></a></li>
            <li><a href="https://www.facebook.com/Pixar"><i class='fa-brands fa-facebook-f'></i></a></li>
            <li><a href="https://www.instagram.com/pixar?igsh=MWx4MWo4bHRlb3Y5MA=="><i class='fa-brands fa-instagram'></i></a></li>
            <li><a href="https://www.tiktok.com/@pixar?_t=8mHdGfcrKF8&_r=1"><i class='fa-brands fa-tiktok'></i></a></li>
        </ul>
    </section>
    
    <?php require_once "footer.php" ?>

    <script type="text/javascript">
    if(window.history.replaceState){
      window.history.replaceState(null, null, window.location.href);
    }
    </script>

</body>
</html>
