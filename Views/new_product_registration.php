<?php
require '../Shared/header.php';
?>

<script src="../Scripts/new_product_registration_script.js"></script>

</head>
<body>
<div class="container">
    <div id="save_product_messages" class="alert" role="alert" style="display: none">

    </div>

    <form id="product_form" method="post">
        <div class="row mt-3">
            <div class="col-md-10 display-6 ">Product Add</div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-success w-100">save</button>
            </div>
            <div class="col-md-1">
                <button id="red_welcome" class="btn btn-secondary w-100">cancel</button>
            </div>
        </div>
        <hr>


        <div class="row mt-5">
            <div class="col-md-1">SKU</div>
            <div class="col-md-2">
                <input id="sku" type="text" class="form-control">
            </div>
            <div id="sku_messages" class="col-md-6"></div>
        </div>

        <div class="row mt-2">
            <div class="col-md-1">Name</div>
            <div class="col-md-2">
                <input id="name" type="text" class="form-control">
            </div>
            <div id="name_messages" class="col-md-6"></div>
        </div>

        <div class="row mt-2">
            <div class="col-md-1">Price ($)</div>
            <div class="col-md-2">
                <input id="price" type="text" class="form-control">
            </div>
            <div id="price_messages" class="col-md-6"></div>
        </div>

        <div class="row mt-3">
            <div class="col-md-2">Type Switcher</div>
            <div class="col-md-2">
                <select id="productType" class="form-select" aria-label="Default select example">
                    <option selected value="-1">Type Swither</option>
                    <option value="dvd">DVD</option>
                    <option value="furniture">Furniture</option>
                    <option value="book">Book</option>
                </select>
            </div>
            <div id="product_type_messages" class="col-md-6"></div>
        </div>
        <div id="section">
        </div>
    </form>

</div>
</body>

<?php
require '../Shared/footer.php';
?>



