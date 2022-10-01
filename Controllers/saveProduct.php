<?php
require '../Repositories/ProductRepository.php';

$productRepo = new ProductRepository();

$sku = $_POST['sku'];
$name = $_POST['name'];
$price = $_POST['price'];
$productType = $_POST['productType'];
$size = $_POST['size'];
$height = $_POST['height'];
$width = $_POST['width'];
$length = $_POST['length'];
$weight = $_POST['weight'];

$productObj = new Product(null, $sku, $name, (float)$price, $productType, (float)$size,
                (float)$weight, (float)$height, (float)$width, (float)$length,) ;

$info = array("status" => "OK");


if ($productRepo->checkSKU($sku)) {
    $res = $productRepo->saveProduct($productObj);
    $info['status'] = $res;

} else {
    $info['status'] = 'error';
    $info['message'] = 'SKU_must_be_unique';
}

echo json_encode($info);

//$temp = array('sku' => $sku,
//    'name' => $name,
//    'price' => $price,
//    'productType' => $productType,
//    'size' => $size,
//    'height' => $height,
//    'width' => $width,
//    'length' => $length,
//    'weight' => $weight,
//);

//echo json_encode($temp);


//$info = array("status" => "error");
//$info["status"] = "success";
//$info["data"] = "123";
//print_r($info);









