<div class="d-flex justify-content-between">
    <h3 class="navbar-brand">會員管理</h3>
    <form class="form-inline" id="searchForm">
        <input class="form-control mr-sm-2" type="search" id="searchInput" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
</div>
<div class="d-flex justify-content-end">
    <button class="btn btn-outline-secondary mr-sm-2" id="sortAsc" data-order="ASC">升冪</button>
    <button class="btn btn-outline-secondary" id="sortDesc" data-order="DESC">降冪</button>
</div>

<button class="btn btn-warning" data-toggle="modal" data-target="#addUserModal">新增會員</button>
<button class="btn btn-outline-warning" data-toggle="modal" data-target="#loginRecordsModal">登入紀錄</button>
<!--  新增會員燈箱  -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">新增使用者</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" placeholder="帳號" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" placeholder="密碼" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="姓名" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="role">
                            <option value="user">一般使用者</option>
                            <option value="admin">管理者</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">新增使用者</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  登入記錄燈箱  -->
<div class="modal fade" id="loginRecordsModal" tabindex="-1" role="dialog" aria-labelledby="loginRecordsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginRecordsModalLabel">登入紀錄</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped mt-3" id="loginRecordsTable">
                    <thead class="thead-dark">
                    <tr>
                        <th>使用者編號</th>
                        <th>帳號</th>
                        <th>姓名</th>
                        <th>時間</th>
                        <th>動作</th>
                        <th>狀態</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- AJAX 动态加载数据 -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--  會員資料  -->
<table class="table table-striped mt-3">
    <thead class="thead-dark">
    <tr>
        <th>使用者編號</th>
        <th>帳號</th>
        <th>姓名</th>
        <th>編輯</th>
        <th>刪除</th>
    </tr>
    </thead>
    <tbody id="userTableBody">
    <!-- AJAX 动态加载用户数据 -->
    </tbody>
</table>
<!-- 编辑用户燈箱 -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">编辑用户</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <div class="form-group">
                        <label for="editUsername">用户名</label>
                        <input type="text" class="form-control" id="editUsername" name="username" placeholder="用户名" readonly>
                    </div>
                    <div class="form-group">
                        <label for="editName">姓名</label>
                        <input type="text" class="form-control" id="editName" name="name" placeholder="姓名">
                    </div>
                    <div class="form-group">
                        <label for="editPassword">密码</label>
                        <input type="password" class="form-control" id="editPassword" name="password" placeholder="密码">
                    </div>
                    <div class="form-group">
                        <label for="editRole">角色</label>
                        <select class="form-control" id="editRole" name="role">
                            <option value="user">一般用户</option>
                            <option value="admin">管理员</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">保存更改</button>
                </form>
            </div>
        </div>
    </div>
</div>
