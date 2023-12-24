<?php
include './api/db.php'; // 引入数据库连接文件

// 生成用户ID的函数
function generateUserId($conn) {
    $sql = "SELECT MAX(CAST(user_id AS UNSIGNED)) as max_id FROM users WHERE user_id <> '00000'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $maxId = (int)$row["max_id"];
        $newId = str_pad($maxId + 1, 5, '0', STR_PAD_LEFT);
        return $newId;
    } else {
        return '00001'; // 如果表是空的，开始从 '00001'
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // 注意：应该使用更安全的密码处理方式
    $name = $_POST['name'];
    $role = $_POST['role'];

    // 生成用户ID
    $userId = generateUserId($conn);

    // 插入用户数据到数据库
    $sql = "INSERT INTO users (user_id, username, password, name, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $userId, $username, $password, $name, $role);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "用户添加成功";
    } else {
        echo "添加用户失败";
    }
    $stmt->close();
    $conn->close();
}