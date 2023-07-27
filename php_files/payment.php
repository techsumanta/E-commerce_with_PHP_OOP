<?php
include_once "../config.php";
if(!session_id()){ session_start(); }
if(!isset($_SESSION["user_role"])){
    header("location:{$hostname}");
}else{
    
    if(!isset($_POST['order_id']) || !isset($_POST['payment_id'])) {
        echo json_encode(array('error' => 'Data not send'));
    } else {
        $payment_params = [
            'order_id' => $_POST['order_id'],
            'payment_req_id' => $_POST['payment_id'],
            'payment_status' => '1'
        ];

        $db = new Database();
        $db->insertDB('order_to_payment', $payment_params);
        $pay_result = $db->getResult();

        if(!empty($pay_result)){
            echo json_encode(array('success' => 'success'));
            setcookie('cart_count','',time() - (300),'/','','',TRUE);
            setcookie('user_cart','',time() - (300),'/','','',TRUE);
        } else {
            echo json_encode(array('error' => 'Payment Failed'));
        }

    }

}

?>