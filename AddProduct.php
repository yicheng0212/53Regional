<?php
// AddProduct.php
include './api/db.php'; // 引入数据库连接

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imagePath = '/image'; // 这里应该是上传图片后的路径


    $sql = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssds", $name, $description, $price, $imagePath);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "商品上架成功";
    } else {
        echo "上架失败";
    }
    $stmt->close();
    $conn->close();
}