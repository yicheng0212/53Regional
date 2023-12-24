<?php
include './api/db.php'; // 引入数据库连接

$sql = "SELECT * FROM products ORDER BY id DESC LIMIT 4"; // 以 id 降序排列，限制获取的商品数量为 4
$result = $conn->query($sql);

$productCount = 0; // 用于计数已输出的产品数量

if ($result->num_rows > 0) {
    echo '<div class="row">'; // 开始一行
    while ($row = $result->fetch_assoc()) {
        // 每两个产品开始一个新行
        if ($productCount > 0 && $productCount % 2 == 0) {
            echo '</div><div class="row mt-4">'; // 结束当前行并开始新的一行
        }
        // 商品卡片
        echo '<div class="col-md-6">';
        echo '<div class="card">';
        echo '<img src="' . $row["image"] . '" class="card-img-top" alt="...">'; // 商品图片
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["name"] . '</h5>'; // 商品名称
        echo '<p class="card-text">' . $row["description"] . '</p>'; // 商品描述
        echo '<p class="card-text">价格: ' . $row["price"] . '</p>'; // 商品价格
        echo '</div>';
        echo '</div>';
        echo '</div>';

        $productCount++; // 增加计数
    }
    echo '</div>'; // 结束最后一行
} else {
    echo "没有商品";
}
$conn->close();