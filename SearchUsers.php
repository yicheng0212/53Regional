<?php
include './api/db.php'; // 数据库连接

$query = $_GET['query'] ?? ''; // 获取搜索输入

$sql = "SELECT * FROM users WHERE username LIKE ? OR name LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = '%' . $query . '%';
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$output = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $output .= "<tr>";
        $output .= "<td>" . $row["user_id"] . "</td>";
        $output .= "<td>" . $row["username"] . "</td>";
        $output .= "<td>" . $row["name"] . "</td>";
        $output .= "<td><button class='btn btn-sm btn-secondary'>編輯</button></td>";
        $output .= "<td><button class='btn btn-sm btn-danger'>刪除</button></td>";
        $output .= "</tr>";
    }
} else {
    $output = "<tr><td colspan='5'>沒有找到結果</td></tr>";
}

echo $output;

$stmt->close();
$conn->close();