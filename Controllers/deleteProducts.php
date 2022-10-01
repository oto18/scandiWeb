<?php
require '../Repositories/ProductRepository.php';

$productRepo = new ProductRepository();

$productIds = $_POST['productIds'];
//echo json_encode($productIds);
$info = $productRepo->deleteProducts($productIds);
echo json_encode($info);


