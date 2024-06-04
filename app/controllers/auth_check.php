<?php
session_start();

// Kiểm tra nếu user_id tồn tại trong session và có giá trị là 5
if(!isset($_SESSION['username']) || $_SESSION['username'] != "admin123") {
    // Nếu user_id không tồn tại hoặc khác 5, chuyển hướng về trang đăng nhập
    header('Location:/IS207.O21-DoAnNhom2/app/views/login.php');
    exit();
}