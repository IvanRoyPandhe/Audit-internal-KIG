<?php
// login_process.php - Handle login authentication
session_start();
require_once 'config.php';

$employee_id = $_POST['employee_id'];
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->execute([$employee_id, $password]);
    $user = $stmt->fetch();
    
    if ($user) {
        $_SESSION['logged_in'] = true;
        $_SESSION['employee_id'] = $user['username'];
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user_name'] = 'User ' . $user['username'];
        echo 'success';
    } else {
        echo 'error';
    }
} catch(PDOException $e) {
    echo 'error';
}
?>