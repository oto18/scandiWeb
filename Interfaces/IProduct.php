<?php

interface IProduct
{
    public function saveProduct($productObj);
    public function checkSKU($sku);
    public function getAllProducts();
    public function deleteProducts($productIds);
}