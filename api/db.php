<?php
// 数据库服务器名称
$servername = "localhost";

// 数据库用户名
$db_username = "yicheng";

// 数据库密码
$db_password = "20080212";

// 数据库名称
$dbname = "53regional";

// 创建与数据库的连接
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}