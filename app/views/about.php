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
    <link rel="stylesheet" type="text/css" href="/IS207.O21-DoAnNhom2/public/css/about.css" />
    <title>About us</title>
    <link rel="icon" type="image/x-icon"
        href="https://static.wixstatic.com/media/d31d8a_979fb0c69422459691a17a886e4c9c09~mv2.png">

</head>

<body>
    <?php require_once "header.php" ?>

    <main>
        <div id="top-container">
            <img src="/IS207.O21-DoAnNhom2/public/images&videos/About/Design-team bg.png" alt="">
            <h1>DESIGN TEAM</h1>
        </div>
        <div id="members">
            <p>Our team includes 6 members:</p>
            <br>
            <br>
            <?php 
                require_once "../models/Members.php"; ?>
        </div>
        <div id="anxiety">
            <img src="/IS207.O21-DoAnNhom2/public/images&videos/About/anxiety-picture.png" alt="Anixiety">
        </div>

        <div id="bottom-container">
            <p>
                We're thrilled to introduce you to our incredible team and our passion for the Inside Out movie. 
                Our dedicated team is committed to delivering top-notch experiences for viewers. We're putting 
                in the hard work to craft a flawless website, ensuring users enjoy seamless navigation and a delightful 
                experience while accessing our services. Our focus is on providing engaging products tailored for 
                children and young adults who adore Inside Out. Looking ahead, we're excited to expand our repertoire 
                to include more captivating films from Disney.
            </p>
            <br>
            <p>
                Special thanks to Fluffy for the Memory Orbs animated background. And everyone that has been supporting us along the way!
        </div>
    </main>

    <?php require_once "footer.php" ?>
</body>

</html>