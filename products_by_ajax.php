<?php
include_once "config.php";

$db = new Database();

if(isset($_POST['product_by_subcat'])){
    if(!empty($_POST['subcat_id'])) {
        $subcat_id = $db->escapeString($_POST['subcat_id']);                                       

        $db->select('product_master','*',null,"product_subcat_id = '{$subcat_id}' AND product_status = 1 AND product_stock_qty > 0",null,null);
        $product_result = $db->getResult();        

        if(!empty($product_result)) {
            echo json_encode(array('success' => $product_result));
        } else {
            echo json_encode(array('error' => 'Product Not Found'));
        }

    } else {
        echo json_encode(array('error' => 'Category Not Found'));

    }
}


if(isset($_POST['product_by_brand'])){
    if(!empty($_POST['brand_id'] || !empty($_POST['subcat_id']))) {
        $brand_id = $db->escapeString($_POST['brand_id']);
        $subcat_id = $db->escapeString($_POST['subcat_id']);                                       

        $db->select('product_master','*',null,"product_subcat_id = '{$subcat_id}' AND product_brand_id = '{$brand_id}' AND product_status = 1 AND product_stock_qty > 0",null,null);
        $product_result = $db->getResult();
        // $sql = $db->getsql(); echo $sql; 
        // echo json_encode(array('sql' => $sql)); exit;

        if(!empty($product_result)) {
            echo json_encode(array('success' => $product_result));
        } else {
            echo json_encode(array('error' => 'Product Not Found'));
        }

    } else {
        echo json_encode(array('error' => 'Category Not Found'));

    }
}

?>