<?php
require '../Interfaces/IProduct.php';
require '../Controllers/DatabaseUtils.php';
require '../Models/Product.php';

class ProductRepository implements IProduct
{

    public function saveProduct($productObj)
    {
        // TODO: Implement saveProduct() method.

        $dbOBJ = new DatabaseUtils();
        $handler = $dbOBJ->connect();
        try {
            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryString = 'insert into product(SKU, Name, Price, Type, MB, KG, Height, Width, Length)
                               values(:sku, :name, :price, :productType, :size, :weight, :height, :width, :length)';
            $statement = $handler->prepare($queryString);
//            $statement->bindParam(':sku', $sku, PDO::PARAM_STR);
//            $statement->bindParam(':name', $name, PDO::PARAM_STR);
//            $statement->bindParam(':price', $price, PDO::PARAM_STR);
//            $statement->bindParam(':productType', $productType, PDO::PARAM_STR);
//            $statement->bindParam(':size', $size, ($size != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
//            $statement->bindParam(':weight', $weight, ($weight != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
//            $statement->bindParam(':height', $height, ($height != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
//            $statement->bindParam(':width', $width, ($width != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
//            $statement->bindParam(':length', $length, ($length != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);

            $statement->bindValue(':sku', $productObj->getSKU(), PDO::PARAM_STR);
            $statement->bindValue(':name', $productObj->getName(), PDO::PARAM_STR);
            $statement->bindValue(':price', $productObj->getPrice(), PDO::PARAM_STR);
            $statement->bindValue(':productType', $productObj->getType(), PDO::PARAM_STR);
            $statement->bindValue(':size', $productObj->getMB(), ($productObj->getMB() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindValue(':weight', $productObj->getKG(), ($productObj->getKG() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindValue(':height', $productObj->getHeight(), ($productObj->getHeight() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindValue(':width', $productObj->getWidth(), ($productObj->getWidth() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
            $statement->bindValue(':length', $productObj->getLength(), ($productObj->getLength() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);

            $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 'error';
        }
        return 'success';
    }

    public function checkSKU($sku)
    {
        $dbOBJ = new DatabaseUtils();
        $handler = $dbOBJ->connect();
        $result = 0;
        try {
            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlString = "select count(SKU) from product where SKU = :sku";
            $statement = $handler->prepare($sqlString);
            $statement->bindParam(':sku', $sku, PDO::PARAM_STR);
            $statement->execute();
            $result = (int)$statement->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result == 0;
    }

    public function getAllProducts()
    {
        // TODO: Implement getAllProducts() method.
        $dbOBJ = new DatabaseUtils();
        $handler = $dbOBJ->connect();
        $cont = array();
        try {
            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlString = "select ID, SKU, Name, Price, Type, MB, KG, Height, Width, Length from product";
            $statement = $handler->query($sqlString);
            $statement->setFetchMode(PDO::FETCH_OBJ);
            while ($row = $statement->fetch()) {
                $cont[] = $row;
//                $obj = new Product($row->ID, $row->SKU, $row->Name, $row->Price,
//                        $row->Type, $row->MB, $row->KG,$row->Height,$row->Width,$row->Length);
//                $cont[] = $obj;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $cont;
    }

    public function deleteProducts($productIds)
    {
        // TODO: Implement deleteProducts() method.
        $dbOBJ = new DatabaseUtils();
        $handler = $dbOBJ->connect();
        $information = array();
        try {
            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $queryString = "delete from product where ID in (" . implode(",", $productIds) . ")";
            $statement = $handler->prepare($queryString);
            $statement->execute();
            $count = (int)$statement->rowCount();
            $information['status'] = 'success';
            $information['rowCount'] = $count;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $information['status'] = 'error';
            $information['messages'] = $e->getMessage();
        }
        return $information;
    }
}




//require '../Interfaces/IProduct.php';
//require '../Controllers/DatabaseUtils.php';
//require '../Models/Product.php';
//
//
//class ProductRepository implements IProduct
//{
//
//    public function saveProduct($productObj)
//    {
//        // TODO: Implement saveProduct() method.
//
//        $dbOBJ = new DatabaseUtils();
//        $handler = $dbOBJ->connect();
//
//        try {
//            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//            $queryString = "insert into product(SKU, Name, Price, Type, MB, KG, Height, Width, Length)
//                            values(:sku, :name, :price, :productType, :size, :weight, :height, :width, :length)";
//            $statement = $handler->prepare($queryString);
//            $statement->bindValue(':sku', $productObj->getSKU(), PDO::PARAM_STR);
//            $statement->bindValue(':name', $productObj->getName(), PDO::PARAM_STR);
//            $statement->bindValue(':price', $productObj->getPrice(), PDO::PARAM_STR);
//            $statement->bindValue(':productType', $productObj->getType(), PDO::PARAM_STR);
//            $statement->bindValue(':size', $productObj->getMB(), ($productObj->getMB() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
//            $statement->bindValue(':weight', $productObj->getKG(), ($productObj->getKG() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
//            $statement->bindValue(':height', $productObj->getHeight(), ($productObj->getHeight() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
//            $statement->bindValue(':width', $productObj->getWidth(), ($productObj->getWidth() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
//            $statement->bindValue(':length', $productObj->getLength(), ($productObj->getLength() != null) ? PDO::PARAM_STR : PDO::PARAM_NULL);
//
////            $statement->bindParam(':sku', $sku, PDO::PARAM_STR);
////
//
//            $statement->execute();
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//            return 'error';
//        }
//        return 'success';
//    }
//
//    public function checkSKU($sku)
//    {
//
//        $dbOBJ = new DatabaseUtils();
//        $handler = $dbOBJ->connect();
//        $result = 0;
//
//        try {
//            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $sqlString = "select count(SKU) from product where SKU = :sku";
//            $statement = $handler->prepare($sqlString);
//            $statement->bindParam(':sku', $sku, PDO::PARAM_STR);
//            $statement->execute();
//            $result = (int)$statement->fetchColumn();
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//
//        return $result == 0;
//    }
//
//    public function getAllProducts()
//    {
//        $dbOBJ = new DatabaseUtils();
//        $handler = $dbOBJ->connect();
//        $cont = array();
//
//        try {
//            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $sqlString = "select ID, SKU, Name, Price, Type, MB, KG, Height, Width, Length from product";
//            $statement = $handler->query($sqlString);
//            $statement->setFetchMode(PDO::FETCH_OBJ);
//            while ($row = $statement->fetch()) {
////                $obj = new Product($row->ID, $row->SKU, $row->Name, $row->Price,
////                    $row->Type, $row->MB, $row->KG, $row->Height, $row->Width, $row->Length);
////                $cont[] = $obj;
//
//                $cont[] = $row;
//            }
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//
//        return $cont;
//
//    }
//
//    public function deleteProducts($productIds)
//    {
//        // TODO: Implement deleteProducts() method.
//
//        $dbOBJ = new DatabaseUtils();
//        $handler = $dbOBJ->connect();
//        $information = array();
//
//        try {
//            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $queryString = "delete from product where ID in (".implode(",", $productIds).")";
//            $statement = $handler->prepare($queryString);
//            $statement->execute();
//            $count = (int)$statement->rowCount();
//            $information['status'] = 'success';
//            $information['rowCount'] = $count;
//
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//            $information['status'] = 'error';
//            $information['message'] = $e->getMessage();
//        }
//        return $information;
//    }
//}