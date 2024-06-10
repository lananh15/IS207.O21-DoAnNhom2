<?php
// Start session và set error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';

if (isset($_POST['send'])) {
    if (!empty($_POST['comment'])) {
        $comment_text = $_POST['comment'];
        $post_id = $_POST['post_id'];
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            if ($user) {
                $user_id = $user['id'];
                $insert_comment = $conn->prepare("INSERT INTO post_comments (post_id, user_id, username, comment, date) VALUES (?, ?, ?, ?, DATE(UTC_TIMESTAMP()))");
                $insert_comment->execute([$post_id, $user_id, $username, $comment_text]);
            } else {
                echo "Error: User not found.";
            }
        } else {
            echo "Error: User not logged in.";
        }
    } else {
        echo "Error: Comment not set.";
    }
}

// Ensure $postDetails['id'] is set
$post_id = isset($postDetails['id']) ? $postDetails['id'] : null;

if ($post_id) {
    $get_comments = $conn->prepare("SELECT pc.*, u.avatar, u.username AS username FROM post_comments pc INNER JOIN users u ON pc.user_id = u.id WHERE pc.post_id = ?");
    $get_comments->execute([$post_id]);
    $comments = $get_comments->fetchAll();
} else {
    die("Error: post_id is not set.");
}

function get_avatar_src($avatar) {
    if (is_url($avatar)) {
        return $avatar;
    }

    if (is_local_file($avatar)) {
        return $avatar;
    }

    // Default avatar path if the provided avatar is not valid
    return '/IS207.O21-DoAnNhom2/public/images&videos/user1.png';
}

function is_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

function is_local_file($path) {
    return file_exists($_SERVER["DOCUMENT_ROOT"] . $path);
}
?>

<div class="insert-comment">
    <?php foreach ($comments as $comment): ?>
        <div class="comment-item">
            <div class="comment-content">
                <?php 
                $avatar_src = get_avatar_src($comment['avatar']);
                ?>
                <img src="<?php echo htmlspecialchars($avatar_src); ?>" alt="Avatar" class="comment-avatar" onerror="this.onerror=null; this.src='/IS207.O21-DoAnNhom2/public/images&videos/user1.png';">
                <div class="comment-details">
                    <span class="comment-username"><?php echo htmlspecialchars($comment['username']); ?></span>
                    <p class="comment-text"><?php echo htmlspecialchars($comment['comment']); ?></p>
                    <span class="comment-timestamp"><?php echo htmlspecialchars($comment['date']); ?></span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
