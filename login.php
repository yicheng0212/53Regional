<?php
session_start();
include './api/db.php'; // 引入数据库配置

function recordLoginAttempt($conn, $userId, $username, $name, $action, $status) {
    $sql = "INSERT INTO login_records (user_id, username, name, timestamp, action, status) VALUES (?, ?, ?, NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $userId, $username, $name, $action, $status);
    $stmt->execute();
    $stmt->close();
}

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $captcha = $_POST['captcha'];

    if (isset($_SESSION['captcha']) && strtolower($captcha) === strtolower($_SESSION['captcha'])) {
        $stmt = $conn->prepare("SELECT user_id, role, name FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['user_id'];
            $role = $row['role'];
            $name = $row['name'];

            // 设置用户的会话信息
            $_SESSION['user_id'] = $userId; // 添加用户ID的会话变量
            $_SESSION['login_attempts'] = 0;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['name'] = $name;
            recordLoginAttempt($conn, $userId, $username, $name, 'login', 'success');
            echo 'success';
        } else {
            $_SESSION['login_attempts']++;
            recordLoginAttempt($conn, null, $username, null, 'login', 'fail');
            if ($_SESSION['login_attempts'] >= 3) {
                echo 'error_page';
            } else {
                echo "帳號或密碼錯誤";
            }
        }
        $stmt->close();
    } else {
        recordLoginAttempt($conn, null, $username, null, 'login', 'captcha_fail');
        echo "圖形驗證碼錯誤";
    }
} else {
    echo "invalid_request";
}

$conn->close();