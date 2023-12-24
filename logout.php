<?php
session_start();
include './api/db.php'; // 引入数据库连接文件

function recordLogoutActivity($conn) {
    if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['name'])) {
        $userId = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];

        $sql = "INSERT INTO login_records (user_id, username, name, timestamp, action, status) VALUES (?, ?, ?, NOW(), 'logout', 'success')";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return;
        }
        $stmt->bind_param("iss", $userId, $username, $name);
        $stmt->execute();
        $stmt->close();
    }
}

recordLogoutActivity($conn);
session_unset();
session_destroy();
$conn->close();

// 重定向到首页
header("Location: index.php");
exit();