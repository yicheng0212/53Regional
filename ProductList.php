<div id="productDisplay" class="container mt-3">
    <!-- 通过 AJAX 加载的商品将显示在这里 -->
</div>

<div id="productWizard" class="container mt-4">
    <!-- 步骤 1: 输入商品信息 -->
    <div class="wizard-step" data-step="1">
        <h2 class="mb-3">步驟1:輸入商品信息</h2>
        <div class="form-group">
            <input type="text" class="form-control" id="productName" placeholder="商品名稱">
        </div>
        <div class="form-group">
            <textarea class="form-control" id="productDescription" placeholder="商品描述"></textarea>
        </div>
        <div class="form-group">
            <input type="number" class="form-control" id="productPrice" placeholder="價格">
        </div>
        <button class="btn btn-primary next-step">下一步</button>
    </div>

    <!-- 步骤 2: 选择商品版型 -->
    <div class="wizard-step d-none" data-step="2">
        <h2 class="mb-3">步驟2: 選擇商品版型</h2>
        <div class="form-group">
            <select class="form-control" id="templateSelect">
                <option value="template1">版型 1</option>
                <option value="template2">版型 2</option>
            </select>
        </div>
        <button class="btn btn-secondary prev-step">上一步</button>
        <button class="btn btn-primary next-step">下一步</button>
    </div>

    <!-- 步骤 3: 上传商品图片 -->
    <div class="wizard-step d-none" data-step="3">
        <h2 class="mb-3">步驟3:上傳商品圖片</h2>
        <div class="form-group">
            <input type="file" class="form-control-file" id="productImage" placeholder="商品圖片">
        </div>
        <button class="btn btn-secondary prev-step">上一步</button>
        <button class="btn btn-success" id="submitProduct">提交商品</button>
    </div>
</div>

<div id="productPreview" class="container mt-4"></div>
