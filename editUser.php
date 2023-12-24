<?php
include './api/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($username == "admin") {
        echo "管理员账户不能被编辑";
        $conn->close();
        exit();
    }

    // 更新用户信息
    $sql = "UPDATE users SET name=?, password=?, role=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $password, $role, $username);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "用户信息已更新";
    } else {
        echo "更新失败或无更改";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "无效请求";
}