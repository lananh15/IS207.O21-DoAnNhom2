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

/* Lấy giá trị các biến */
if (isset($_POST['action'])) {
    $id = intval($_POST['id']);
    $action = $_POST['action'];
    $type = $_POST['type']; // 'movie' or 'trailer
    $table = ($type === 'trailer') ? 'trailer_reactions' : 'movie_reactions';
    $idField = ($type === 'trailer') ? 'trailer_id' : 'movie_id';

switch ($action) {
    case 'like':
        $sql = "INSERT INTO $table (user_id, $idField, action) 
                VALUES (:user_id, :id, 'like') 
                ON DUPLICATE KEY UPDATE action='like'";
        break;
    case 'dislike':
        $sql = "INSERT INTO $table (user_id, $idField, action) 
                VALUES (:user_id, :id, 'dislike') 
                ON DUPLICATE KEY UPDATE action='dislike'";
        break;
    case 'unlike':
        $sql = "DELETE FROM $table WHERE user_id=:user_id AND $idField=:id AND action='like'";
        break;
    case 'undislike':
        $sql = "DELETE FROM $table WHERE user_id=:user_id AND $idField=:id AND action='dislike'";
        break;
    default:
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        exit();
}

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'id' => $id]);
    header('Content-Type: application/json');
    $response = [
        'likes' => getLikes($conn, $id, $type),
        'dislikes' => getDislikes($conn, $id, $type)
    ];
    echo json_encode($response);
}  catch (PDOException $e) {
    header('Content-Type: application/json');
    error_log("Database error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit();
}
}

/* Hàm lấy like từ cơ sở dữ liệu */
function getLikes($conn, $id, $type) {
    $table = ($type === 'trailer') ? 'trailer_reactions' : 'movie_reactions';
    $idField = ($type === 'trailer') ? 'trailer_id' : 'movie_id';
    $sql = "SELECT COUNT(*) FROM $table WHERE $idField = :id AND action='like'";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return (int)$stmt->fetchColumn();
}

/* Hàm lấy dislike từ cơ sở dữ liệu */
function getDislikes($conn, $id, $type) {
    $table = ($type === 'trailer') ? 'trailer_reactions' : 'movie_reactions';
    $idField = ($type === 'trailer') ? 'trailer_id' : 'movie_id';
    $sql = "SELECT COUNT(*) FROM $table WHERE $idField = :id AND action='dislike'";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return (int)$stmt->fetchColumn();
}

/* Hàm kiểm tra user đã like phim hay trailer chưa */
function userLiked($conn, $user_id, $id, $type)
{
    $table = ($type === 'trailer') ? 'trailer_reactions' : 'movie_reactions';
    $idField = ($type === 'trailer') ? 'trailer_id' : 'movie_id';
    
    $sql = "SELECT 1 FROM $table WHERE user_id = :user_id AND $idField = :id AND action = 'like'";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'id' => $id]);
    return $stmt->fetch() !== false;
}

/* Hàm kiểm tra user đã dislike phim hay trailer chưa */
function userDisliked($conn, $user_id, $id, $type)
{
    $table = ($type === 'trailer') ? 'trailer_reactions' : 'movie_reactions';
    $idField = ($type === 'trailer') ? 'trailer_id' : 'movie_id';
    
    $sql = "SELECT 1 FROM $table WHERE user_id = :user_id AND $idField = :id AND action = 'dislike'";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'id' => $id]);
    return $stmt->fetch() !== false;
}
?>
