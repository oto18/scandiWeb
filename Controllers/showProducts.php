<?php
require '../Repositories/ProductRepository.php';

$productRepo = new ProductRepository();

$results = $productRepo->getAllProducts();
echo json_encode($results);



