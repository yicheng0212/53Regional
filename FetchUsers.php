<?php
include './api/db.php'; // 数据库连接

$order = $_GET['order'] ?? 'ASC'; // 获取排序顺序，默认为升序

$sql = "SELECT * FROM users ORDER BY user_id " . $order;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td><button class='btn btn-sm btn-secondary'>編輯</button></td>";
        echo "<td><button class='btn btn-sm btn-danger'>刪除</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>沒有找到結果</td></tr>";
}
$conn->close();
?>