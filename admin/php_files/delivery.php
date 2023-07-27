<?php
include_once "database.php";

$db = new Database();

    if(isset($_POST['deliver_id'])) {        
        $order_id = $_POST['deliver_id'];
        // echo json_encode(array('error' => $order_id));exit;


        $db->updateDB('order_to_delivery',array('delivery_status' => '1'),"order_id = '{$order_id}'");
        $delivery_update_result = $db->getResult();
        
        if(!empty($delivery_update_result)) {

            $db->updateDB('order_master',array('order_status' => '1'),"order_id = '{$order_id}'");
            $order_master_update_result = $db->getResult();

            if(!empty($order_master_update_result)) {
                echo json_encode(array('success' => 'success'));
            } else {
                echo json_encode(array('error' => 'Order Status Update Failed'));

            }
        } else {
            echo json_encode(array('error' => 'Delivery Status Update Failed'));
        }
    }


?>