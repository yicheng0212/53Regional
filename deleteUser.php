<?php
include './api/db.php'; // 引入数据库连接

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
$username = $_POST['username'];

if ($username !== 'admin') {
$sql = "DELETE FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
if ($stmt->execute()) {
echo "用户删除成功";
} else {
echo "删除失败: " . $conn->error;
}
$stmt->close();
} else {
echo "管理员账户不能删除";
}
} else {
echo "无效请求";
}

$conn->close();
