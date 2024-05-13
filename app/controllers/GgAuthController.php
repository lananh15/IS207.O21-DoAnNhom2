<?php
    require_once '../../../vendor/autoload.php';

    $clientID = '473840571616-rb0e5qkbqk3bp8v64ifngi7g6657vc5f.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = 'http://localhost/IS207.O21-DoAnWebNhom2-nhap-/app/views/login-signup/login.php';

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

        session_start();
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['avatar'] = $avatar;
        $_SESSION['password']='';
        
        require_once 'GgUserController.php';

        header('Location: ../home.php');
        exit;

    }

    
?>