<?php
session_start();
include './api/db.php'; // 引入数据库配置

header('Content-Type: application/json');

// 检查是否为管理员
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $sql = "SELECT * FROM login_records ORDER BY timestamp DESC";
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'user_id' => $row["user_id"],
                'username' => $row["username"],
                'name' => $row["name"],
                'timestamp' => $row["timestamp"],
                'action' => $row["action"],
                'status' => $row["status"]
            );
        }
    }
    echo json_encode($data);
} else {
    echo json_encode(array("error" => "无权限访问此数据"));
}

$conn->close();
?>
