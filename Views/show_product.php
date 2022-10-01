<?php
require '../Shared/header.php';
?>

<script type="text/javascript" src="../Scripts/show_products_script.js"></script>

</head>
<body>

<div class="container">

    <div id="show_product_messages" class="alert" role="alert" style="display: none"></div>


    <div class="row mt-3">
        <div class="col-md-9 display-6 ">Product List</div>
        <div class="col-md-1">
            <button id="red_new_product2" class="btn btn-success w-100">ADD</button>
        </div>
        <div class="col-md-2">
            <button id="delete-product-btn" type="submit" class="btn btn-danger w-100">MASS Delete</button>
        </div>
    </div>
    <hr>
    <div id="product_list" class="mt-3"></div>

</div>

<?php
require '../Shared/footer.php';
?>



