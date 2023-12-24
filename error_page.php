<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入失敗</title>
    <?php include_once "header.php"; ?>
    <style>
        .error-container {
            margin-top: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container error-container">
    <h1>登入失敗</h1>
    <p>您已經連續三次輸入錯誤的登入資訊。出於安全原因，我們暫時鎖定了您的登入嘗試。</p>
    <a href="index.php" class="btn btn-primary">返回首頁</a>
</div>
</body>
</html>
