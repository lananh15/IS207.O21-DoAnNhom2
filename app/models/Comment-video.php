<?php
require_once '../../config/database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

global $user_id ;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    try {
        $query = "SELECT id FROM users WHERE username=:username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $result['id'];
    
        $_SESSION['user_id'] = $user_id;
    
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }}
    

$comments = []; 
$comment_count = 0; 


/* Kiểm tra tồn tại của các biến */
if (isset($_POST['comment'])) {
    $comment = trim($_POST['comment']);
    $id = intval($_POST['id']);
    $type = $_POST['type'];

    /* Kiểm tra biến rỗng*/
    if (empty($comment)) {
        echo json_encode(['status' => 'error', 'message' => 'Comment cannot be empty.']);
        exit;
    }
    if (empty($id) || empty($type)) {
        echo json_encode(['status' => 'error', 'message' => 'ID or Type is missing.']);
        exit;
    }

    $table = ($type === 'movie') ? 'movie_comments' : 'trailer_comments';
    $idField = ($type === 'trailer') ? 'trailer_id' : 'movie_id';


    /* Thêm vào CSDL */
    try {
        $stmt = $conn->prepare("INSERT INTO $table ($idField, user_id, comment, date) VALUES (:id, :user_id, :comment, UTC_TIMESTAMP())");

        if (!$stmt) {
            throw new Exception('Failed to prepare statement.');
        }
        if (!$stmt->execute([':id' => $id, ':user_id' => $user_id, ':comment' => $comment])) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception('Failed to save comment. Error: ' . $errorInfo[2]);
        }
        $comments = getComments($conn, $id, $type);
        
        /* Lấy avatar từ bảng users*/
        $stmt = $conn->prepare("SELECT avatar FROM users WHERE id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $avatar = $user['avatar'] ?? '../../public/images&videos/user1.png';

        // Send the updated comments back as JSON
        echo json_encode([
            'status' => 'success',
            'comments' => $comments,
            'comment_count' => $comment_count,
            'avatar' => $avatar
        ]);
        exit;

    } catch (Exception $e) {
        // Log the error
        error_log($e->getMessage());
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit;
    }
}

/* Hàm lấy comment từ cơ sở dữ liệu ứng với mỗi trailer hay movie */
function getComments($conn, $id, $type) {
    $table = ($type === 'movie') ? 'movie_comments' : 'trailer_comments';
    $idField = ($type === 'trailer') ? 'trailer_id' : 'movie_id';

    $stmt = $conn->prepare("SELECT c.comment, c.date, u.username, u.avatar 
                           FROM $table c 
                           JOIN users u ON c.user_id = u.id 
                           WHERE c.$idField = :id
                           ORDER BY c.date DESC");
    $stmt->execute([':id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = intval($_GET['id']);
    $type = $_GET['type'];
    $comments = getComments($conn, $id, $type);
}

// Định nghĩa hàm lấy số lượng comment 
function getCommentCount($conn, $id, $type) {
    $table = ($type === 'movie') ? 'movie_comments' : 'trailer_comments';
    $idField = ($type === 'trailer') ? 'trailer_id' : 'movie_id';

    $stmt = $conn->prepare("SELECT COUNT(*) as comment_count 
                           FROM $table 
                           WHERE $idField = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['comment_count'];
}

// Sử dụng hàm getCommentCount để lấy số lượng comment cho mỗi video
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = intval($_GET['id']);
    $type = $_GET['type'];
    $comment_count = getCommentCount($conn, $id, $type);
   
}


?>
