<?php
    include_once "php_files/config.php";
    include_once "php_files/database.php";
    if(!session_id()){ session_start(); }
    if(!isset($_SESSION['admin_name'])) {
        header("location:{$base_url}/admin");
    }

        $db = new Database();
        $db->select('order_master','*',null,null,'order_id DESC',null);
        $order_master_result = $db->getResult();
        // $sql = $db->getSql();
        // echo $sql."<br>";

        if(count($order_master_result) > 0) {

            foreach($order_master_result as $order_master_row) {
                $db->select('product_to_cart','cart_product_id,cart_product_qty',null,'cart_id IN ('.$order_master_row['cart_id'].')',null,null);
                $pro_cart_result = $db->getResult();
                // $sql2 = $db->getSql();
                // echo $sql2."<br>";

                $db->select('order_to_delivery','f_name,l_name,address,state,city',null,'order_id IN ('.$order_master_row['order_id'].')',null,null);
                $delivery_result = $db->getResult();
            }            

        } else {
            echo "Order Not Found";
        }

?>