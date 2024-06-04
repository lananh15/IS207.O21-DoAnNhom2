<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
    $username = $_SESSION['username'];
    try {
        $sql = "SELECT avatar FROM users WHERE username=:username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $oldAvatarPath = $stmt->fetchColumn();
        if (isset($_FILES['avatar'])) {
            $targetDirectory = $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/public/images&videos/Avatar/';
            $sql = "SELECT id FROM users WHERE username=:username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $targetFile = $targetDirectory . $id . "_" . basename($_FILES["avatar"]["name"]);
            if ($oldAvatarPath && file_exists($_SERVER["DOCUMENT_ROOT"] . $oldAvatarPath)) {
                unlink($_SERVER["DOCUMENT_ROOT"] . $oldAvatarPath);
            }
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                list($width, $height, $type) = getimagesize($targetFile);
                $newWidth = $newHeight = min($width, $height);
                switch ($type) {
                    case IMAGETYPE_JPEG:
                        $image = imagecreatefromjpeg($targetFile);
                        break;
                    case IMAGETYPE_PNG:
                        $image = imagecreatefrompng($targetFile);
                        break;
                    case IMAGETYPE_GIF:
                        $image = imagecreatefromgif($targetFile);
                        break;
                    default:
                        echo "<script>alert('Unsupported image format');</script>";
                        exit;
                }
                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                switch ($type) {
                    case IMAGETYPE_JPEG:
                        imagejpeg($newImage, $targetFile, 100);
                        break;
                    case IMAGETYPE_PNG:
                        imagepng($newImage, $targetFile, 9);
                        break;
                    case IMAGETYPE_GIF:
                        imagegif($newImage, $targetFile);
                        break;
                }
                imagedestroy($image);
                imagedestroy($newImage);

                echo "<script>alert('The file has been uploaded');</script>";
                $avatarPath = str_replace($_SERVER["DOCUMENT_ROOT"], "", $targetFile);
                $sql = "UPDATE users SET avatar = :avatarPath WHERE username=:username";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':avatarPath', $avatarPath, PDO::PARAM_STR);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->execute();
                echo "<script>alert('Please login again to see the updated avatar!');</script>";
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file');</script>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>