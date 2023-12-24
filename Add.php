<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>商品上架管理</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<h1>商品上架管理</h1>
<form id="addProductForm">
    <!-- 商品信息的输入字段 -->
    <input type="text" id="productName" placeholder="商品名稱" required>
    <input type="text" id="productDesc" placeholder="商品描述" required>
    <input type="number" id="productPrice" placeholder="價格" required>
    <button type="submit">上架商品</button>
</form>

<script>
    $(document).ready(function() {
        $('#addProductForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: AddProduct.php',
                type: 'POST',
                data: {
                    name: $('#productName').val(),
                    description: $('#productDesc').val(),
                    price: $('#productPrice').val()
                },
                success: function(response) {
                    alert(response);
                }
            });
        });
    });
</script>
</body>
</html>