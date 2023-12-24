<?php
include './api/db.php'; // 引入数据库连接文件

$sql = "SELECT * FROM users ORDER BY user_id ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";

        // 管理员账户不显示编辑和删除按钮
        if ($row["username"] !== "admin") {
            echo "<td><button class='btn btn-sm btn-secondary editUserButton' data-username='" . $row['username'] . "'>編輯</button></td>";
            echo "<td><button class='btn btn-sm btn-danger deleteUserButton' data-username='" . $row['username'] . "'>刪除</button></td>";
        } else {
            echo "<td>---</td><td>---</td>"; // 空占位符
        }

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>沒有找到結果</td></tr>";
}
$conn->close();