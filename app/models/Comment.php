<?php
// Start session and set error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';

$response = ['success' => false, 'message' => ''];

if (isset($_POST['comment']) && isset($_POST['post_id'])) {
    $comment_text = $_POST['comment'];
    $post_id = $_POST['post_id'];

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $stmt = $conn->prepare("SELECT id, avatar FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            $user_id = $user['id'];
            $avatar = $user['avatar'];

            $insert_comment = $conn->prepare("INSERT INTO post_comments (post_id, user_id, username, comment, date) VALUES (?, ?, ?, ?, NOW())");
            $insert_comment->execute([$post_id, $user_id, $username, $comment_text]);

            $response['success'] = true;
            $response['username'] = $username;
            $response['avatar'] = $avatar ? $avatar : '/IS207.O21-DoAnNhom2/public/images&videos/user1.png';
            $response['comment'] = htmlspecialchars($comment_text);
            $response['date'] = date('Y-m-d H:i:s');
        } else {
            $response['message'] = 'Error: User not found.';
        }
    } else {
        $response['message'] = 'Error: User not logged in.';
    }
} else {
    $response['message'] = 'Error: Comment not set or post_id missing.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
