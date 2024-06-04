<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . '/IS207.O21-DoAnNhom2/config/database.php';
    if(isset($_POST["submitBtn"]) && $_POST["submitBtn"]=="SUBMIT"){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $email=$_SESSION["email"];
        if($password!==""){
            try{
                $sql_check_email= "SELECT * FROM users WHERE email = :email";
                $stmt_check_email= $conn->prepare($sql_check_email);
                $stmt_check_email->bindParam(":email", $email,PDO::PARAM_STR);
                $stmt_check_email->execute();

                if($stmt_check_email->rowCount()>0){
                    $sql_update="UPDATE users SET username=:username, password=:password WHERE email=:email";
                    $stmt_update=$conn->prepare($sql_update);
                    $stmt_update->bindParam(":username",$username,PDO::PARAM_STR);
                    $stmt_update->bindParam(":password",$password,PDO::PARAM_STR);
                    $stmt_update->bindParam(":email",$email,PDO::PARAM_STR);
                    if ($stmt_update->execute()){
                        echo "<script>alert('Update successfully! Please login again to see your new profile.');</script>";
                    }
                    else{
                        echo "<script>alert('Update profile error!');</script>";
                    }
                }
            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
        else{
            echo "<script>alert('Please type the new password.');</script>";
        }
                
    }
?>