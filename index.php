<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入頁面</title>
    <?php include_once "header.php"; ?>
    <style>
        .grid-cell {
            width: 33.33%;
            height: 100px;
            border: 1px solid black;
            cursor: pointer;
        }
        .selected {
            background-color: blue; /* 選中後的背景色 */
        }
        #grid {
            display: none; /* 初始隱藏九宮格 */
        }
    </style>
</head>
<body class="bg-warning">
<div class="d-flex justify-content-center align-items-center min-vh-100">
<div class="container">
    <form id="loginForm">
        <div class="col-4 offset-4">
        <img src="logo.png" alt="Logo" style="height: 50px;">
        <h2 class="text-center">頁面標題</h2>
        <div class="form-group">
            <label for="username">帳號:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">密碼:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="captcha">圖形驗證碼:</label>
            <img src="captcha.php" id="captchaImage" alt="驗證碼" />
            <button class="btn btn-sm btn-secondary" type="button" id="refresh_captcha">重新產生</button>
            <input type="text" class="form-control" id="captcha" name="captcha" required>
        </div>
        <button type="reset" class="btn btn-outline-secondary btn-lg btn-block">重設</button>
        <button type="submit" class="btn btn-secondary btn-lg btn-block">送出</button>
    </form>
    </div>
        <!-- 第二層驗證的九宮格 -->
<div class="col-6 offset-3" id="secondFactorAuth" style="display:none;">
        <div class="card p-5 text-center shadow">
        <div class="model-content">
            <h3>第二層驗證</h3>
            <p>請根據指示選擇格子</p>
            <div id="grid" class="d-flex flex-wrap mx-auto" style="width: 300px;">
                <?php for ($i = 0; $i < 9; $i++): ?>
                    <div class="grid-cell"></div>
                <?php endfor; ?>
            </div>
            <button class="btn btn-secondary btn-lg btn-block mt-5" id="confirmPattern">確定</button>
        </div>
        </div>
        </div>


    </div>

<script>
    $(document).ready(function() {
        // 第一層驗證：登入表單提交
        $('#loginForm').submit(function(event) {
            event.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();
            var captcha = $('#captcha').val();

            $.ajax({
                url: 'login.php',
                type: 'POST',
                data: {
                    username: username,
                    password: password,
                    captcha: captcha
                },
                success: function(response) {
                    if (response === 'success') {
                        $('#secondFactorAuth').show();// 顯示第二層驗證的九宮格
                        $('#loginForm').hide();
                    } else if (response === 'error_page') {
                        window.location.href = 'error_page.php'; // 登入嘗試過多
                    } else {
                        alert(response); // 顯示錯誤信息
                    }
                },
                error: function() {
                    alert('登入請求失敗，請稍後再試。');
                }
            });
        });
        $('#refresh_captcha').click(function() {
            $('#captchaImage').attr('src', 'captcha.php?' + new Date().getTime());
        });  //重新產生驗證碼

        // 九宮格選擇邏輯
        $('.grid-cell').click(function() {
            $(this).toggleClass('selected');
        });

        // 第二層驗證：九宮格提交
        $('#confirmPattern').click(function() {
            var selectedCells = $('.grid-cell.selected').map(function() {
                return $(this).index();
            }).get();

            $.ajax({
                url: 'captcha2.php',
                type: 'POST',
                data: { selectedCells: selectedCells },
                success: function(response) {
                    if (response === 'success') {
                        window.location.href = 'admin.php'; // 驗證通過
                    } else {
                        alert('驗證失敗，請重試。'); // 驗證失敗
                    }
                },
                error: function() {
                    alert('請求失敗，請稍後再試。');
                }
            });
        });
    });
</script>
</body>
</html>
