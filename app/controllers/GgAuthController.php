<?php
    require_once '../../vendor/autoload.php';

    $clientID = '473840571616-rb0e5qkbqk3bp8v64ifngi7g6657vc5f.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = 'https://insideout.io.vn/login';

    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;
        $avatar = $google_account_info->picture;

        require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';

        $sql_check_email = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql_check_email);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $name = $user['username'];
            $password = $user['password'];
            $avatar = $user['avatar'];
        } else {
            $password = '';
        }

        session_start();
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['avatar'] = $avatar;
        $_SESSION['password']=$password;
        
        require_once 'GgUserController.php';

        header('Location: home');
        exit;

    }

    
?>
