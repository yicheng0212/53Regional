<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>咖啡商品展示</title>
    <?php include_once "header.php"; ?>
</head>
<body>
<nav class="navbar navbar-dark bg-dark shadow">
    <a class="navbar-brand" href="#">咖啡商品展示</a>
    <button id="logoutButton" class="btn btn-danger">登出</button>
</nav>
<div class="container-fluid">
    <div class="row min-vh-100">
        <div class="col-2 bg-warning shadow">
            <h2 class="pt-5">會員管理</h2>
            <h2 class="pt-2">商品展示</h2>
        </div>
        <div class="col-10 p-5">
            <?php include_once "UserList.php";?>
            <?php include_once "ProductList.php";?>
        </div>
        <div id="timerSection" class="position-fixed bottom-0 end-0 p-3" style="right: 0; bottom: 0;">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">倒数计时器</h5>
                    <p id="timerDisplay" class="card-text">剩余时间: <span id="timer">30</span> 秒</p>
                    <div class="input-group mb-3">
                        <input type="number" id="timerInput" class="form-control" min="1" value="30">
                        <button class="btn btn-secondary" id="setTimer">设置时间</button>
                        <button class="btn btn-outline-secondary" id="resetTimer">重新计时</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        $(document).ready(function() {
            // 加载产品
            function loadProducts() {
                $.ajax({
                    url: 'GetProducts.php',
                    type: 'GET',
                    success: function(response) {
                        $('#productDisplay').html(response);
                    }
                });
            }
            loadProducts();

            // 添加用户表单提交
            $('#addUserForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'AddUser.php',
                    type: 'POST',
                    data: {
                        username: $('#username').val(),
                        password: $('#password').val(),
                        name: $('#name').val(),
                        role: $('#role').val()
                    },
                    success: function(response) {
                        alert(response);
                        loadUsers();
                    },
                    error: function() {
                        alert('请求失败，请稍后再试。');
                    }
                });
            });

            // 加载用户
            function loadUsers() {
                $.ajax({
                    url: 'GetUserList.php',
                    type: 'GET',
                    success: function(response) {
                        $('#userTableBody').html(response);
                    }
                });
            }
            loadUsers();

            // 处理排序按钮点击
            $('#sortAsc, #sortDesc').click(function() {
                var order = $(this).data('order');
                $.ajax({
                    url: 'FetchUsers.php',
                    type: 'GET',
                    data: { order: order },
                    success: function(data) {
                        $('#userTableBody').html(data);
                    },
                    error: function() {
                        alert('无法加载数据');
                    }
                });
            });

            // 处理搜索表单提交
            $('#searchForm').submit(function(e) {
                e.preventDefault();
                var searchQuery = $('#searchInput').val();
                $.ajax({
                    url: 'SearchUsers.php',
                    type: 'GET',
                    data: { query: searchQuery },
                    success: function(response) {
                        $('#userTableBody').html(response);
                    },
                    error: function() {
                        alert('搜索请求失败');
                    }
                });
            });

            // 登出按钮点击
            $('#logoutButton').click(function() {
                $.ajax({
                    url: 'logout.php',
                    type: 'POST',
                    success: function(response) {
                        console.log(response)
                        alert('您已成功登出');
                        window.location.href = 'index.php';
                    },
                    error: function(response) {
                        console.log(response)
                        alert('登出请求失败，请稍后再试。');
                    }
                });
            });
            $(document).ready(function() {
                // 加载登录记录
                function loadLoginRecords() {
                    $.ajax({
                        url: 'GetLoginRecords.php', // 指向 GetLoginRecords.php 文件的路径
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (!data.error) {
                                var html = '';
                                $.each(data, function(index, record) {
                                    html += '<tr>';
                                    html += '<td>' + record.user_id + '</td>';
                                    html += '<td>' + record.username + '</td>';
                                    html += '<td>' + record.name + '</td>';
                                    html += '<td>' + record.timestamp + '</td>';
                                    html += '<td>' + record.action + '</td>';
                                    html += '<td>' + record.status + '</td>';
                                    html += '</tr>';
                                });
                                $('#loginRecordsTable tbody').html(html);
                            } else {
                                alert(data.error);
                            }
                        },
                        error: function() {
                            alert('无法加载登录记录');
                        }
                    });
                }

                // 加载登录记录的初始化调用
                loadLoginRecords();

                // 当点击“登入紀錄”按钮时重新加载登录记录
                $('#loginRecordsButton').click(function() {
                    loadLoginRecords();
                });
            });

            // 计时器功能
            var timer;
            var countdown;
            function startTimer(duration) {
                clearInterval(timer);
                countdown = duration;
                timer = setInterval(function() {
                    $('#timer').text(countdown);
                    countdown -= 1;
                    if (countdown < 0) {
                        clearInterval(timer);
                        askToContinue();
                    }
                }, 1000);
            }

            function askToContinue() {
                var userResponse = confirm("是否继续操作？");
                if (userResponse) {
                    startTimer(parseInt($('#timerInput').val()));
                } else {
                    setTimeout(function() {
                        window.location.href = 'logout.php';
                    }, 5000);
                }
            }

            $('#setTimer').click(function() {
                var newTime = parseInt($('#timerInput').val());
                startTimer(newTime);
            });

            $('#resetTimer').click(function() {
                startTimer(parseInt($('#timerInput').val()));
            });

            startTimer(30);
        });
        $(document).ready(function() {
            // 处理 "下一步" 按钮的点击事件
            $('.next-step').click(function() {
                var $currentStep = $(this).closest('.wizard-step');
                var $nextStep = $currentStep.next('.wizard-step');

                $currentStep.addClass('d-none'); // 隐藏当前步骤
                $nextStep.removeClass('d-none'); // 显示下一步骤
            });

            // 处理 "上一步" 按钮的点击事件
            $('.prev-step').click(function() {
                var $currentStep = $(this).closest('.wizard-step');
                var $prevStep = $currentStep.prev('.wizard-step');

                $currentStep.addClass('d-none'); // 隐藏当前步骤
                $prevStep.removeClass('d-none'); // 显示前一步骤
            });

            // 处理 "提交商品" 按钮的点击事件
            $('#submitProduct').click(function(event) {
                event.preventDefault(); // 阻止表单默认提交

                // 收集商品信息
                var productName = $('#productName').val();
                var productDescription = $('#productDescription').val();
                var productPrice = $('#productPrice').val();
                var productImage = $('#productImage')[0].files[0]; // 假设只上传一个文件
                var template = $('#templateSelect').val();

                // 创建 FormData 对象来发送文件
                var formData = new FormData();
                formData.append('name', productName);
                formData.append('description', productDescription);
                formData.append('price', productPrice);
                formData.append('template', template);
                formData.append('image', productImage);

                // 发送 AJAX 请求
                $.ajax({
                    url: 'AddProduct.php', // 处理添加商品的 PHP 文件
                    type: 'POST',
                    data: formData,
                    contentType: false, // 不设置内容类型
                    processData: false, // 不处理数据
                    success: function(response) {
                        // 处理响应
                        alert('商品添加成功');
                        $('#productPreview').html(response); // 显示预览
                    },
                    error: function() {
                        alert('添加商品失败，请稍后再试。');
                    }
                });
            });
        });



        $(document).ready(function() {
            // 编辑和删除按钮事件绑定
            $(document).on('click', '.editUserButton', function() {
                var username = $(this).data('username');
                // TODO: 显示编辑用户的模态框或表单，并预填充用户数据
            });

            $(document).on('click', '.deleteUserButton', function() {
                var username = $(this).data('username');
                if (confirm("确定要删除 " + username + " 吗？")) {
                    $.ajax({
                        url: 'deleteUser.php',
                        type: 'POST',
                        data: { username: username },
                        success: function(response) {
                            alert(response);
                            loadUsers(); // 重新加载用户列表
                        },
                        error: function() {
                            alert('请求失败，请稍后再试。');
                        }
                    });
                }
            });

            // 加载用户的函数
            function loadUsers() {
                $.ajax({
                    url: 'GetUserList.php',
                    type: 'GET',
                    success: function(response) {
                        $('#userTableBody').html(response);
                    },
                    error: function() {
                        alert('无法加载数据');
                    }
                });
            }

            loadUsers(); // 初始加载用户列表
        });


        $(document).ready(function() {
            // 显示编辑用户模态框并填充数据
            $(document).on('click', '.editUserButton', function() {
                var username = $(this).data('username');
                var name = $(this).data('name');
                var role = $(this).data('role');

                $('#editUsername').val(username).prop('readonly', true); // 将用户名设置为只读
                $('#editName').val(name);
                $('#editRole').val(role);

                $('#editUserModal').modal('show');
            });

            // 提交编辑用户表单
            $('#editUserForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: 'editUser.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert(response);
                        $('#editUserModal').modal('hide');
                        // 这里添加重新加载用户列表的代码
                    },
                    error: function() {
                        alert('请求失败，请稍后再试。');
                    }
                });
            });
        });


    </script>
</body>
</html>