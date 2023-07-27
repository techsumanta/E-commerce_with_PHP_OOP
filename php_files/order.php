<?php include_once "../config.php"; ?>

<?php

// Place Order
if(isset($_POST['placeOrder'])){
    if(!isset($_POST['f_name']) || empty($_POST['f_name'])){
        echo json_encode(array('error'=>'First Name Field Empty.')); exit;
    }else if(!isset($_POST['l_name']) || empty($_POST['l_name'])){
        echo json_encode(array('error'=>'Last Name Field Empty.')); exit;
    }else if(!isset($_POST['address']) || empty($_POST['address'])){
        echo json_encode(array('error'=>'Address Field Empty.')); exit;
    }else if (!isset($_POST['phone']) || empty($_POST['phone'])){
          echo json_encode(array('error'=>'Phone Field Empty.')); exit;
    }else if(!isset($_POST['state']) || empty($_POST['state'])){
        echo json_encode(array('error'=>'State Field Empty.')); exit;
    }else if (!isset($_POST['city']) || empty($_POST['city'])){
        echo json_encode(array('error'=>'City Field Empty.')); exit;
    }else if(!isset($_POST['pincode']) || empty($_POST['pincode'])){
        echo json_encode(array('error'=>'Pincode Field Empty.')); exit;
    }else if(!isset($_POST['product_id']) || empty($_POST['product_id'])){
        echo json_encode(array('error'=>'Detail Submission Failed')); exit;
    }else if (!isset($_POST['product_qty']) || empty($_POST['product_qty'])){
        echo json_encode(array('error'=>'Detail Submission Failed')); exit;
    }else if(!isset($_POST['total_price']) || empty($_POST['total_price'])){
        echo json_encode(array('error'=>'Detail Submission Failed')); exit;
    }else if(!isset($_POST['user_id']) || empty($_POST['user_id'])){
        echo json_encode(array('error'=>'Detail Submission Failed')); exit;
    } else {
        $db = new Database();

        $cart_master_params = [
            'user_id' => $_POST['user_id'],
            'status' => '1'
        ];
        
        $db->insertDB('cart_master', $cart_master_params);
        $cart_result = $db->getResult();
        
        if(is_numeric($cart_result[0])) {
            $pid = $_POST['product_id'];
            $pqty = $_POST['product_qty'];
            $pro_id = explode(",", $pid);
            $pro_qty = explode(",", $pqty);
            $pro_length = count($pro_id)-1;

            for($i=0; $i<$pro_length; $i++) {
                
                $pro_cart_params = [
                    'cart_id' => $cart_result[0],
                    'cart_product_id' => $pro_id[$i],
                    'cart_product_qty' => $pro_qty[$i]
                ];

                $db->insertDB('product_to_cart', $pro_cart_params);
                $pro_cart_result = $db->getResult();                
            }
            if(!empty($pro_cart_result)){
                // echo json_encode(array('success' => 'success'));

                $order_master_params = [
                    'user_id' => $_POST['user_id'],
                    'cart_id' => $cart_result[0],
                    'order_date' => date("d:m:Y"),
                    'order_amount' => $_POST['total_price'],
                    'order_status' => '0'
                ];

                $db->insertDB('order_master', $order_master_params);
                $order_master_result = $db->getResult();
                
                if(!empty($order_master_result)) {

                    $delivery_address_params = [
                        'order_id' => $order_master_result[0],
                        'f_name' => $_POST['f_name'],
                        'l_name' => $_POST['l_name'],
                        'address' => $_POST['address'],
                        'phone' => $_POST['phone'],
                        'state' => $_POST['state'],
                        'city' => $_POST['city'],
                        'pincode' => $_POST['pincode']
                    ];

                    $db->insertDB('order_to_delivery', $delivery_address_params);
                    $delivery_address_result = $db->getResult();

                    if(!empty($delivery_address_result)) {
                        session_start();
                        $_SESSION['order_id'] = $order_master_result[0];
                        $_SESSION['amount'] = $_POST['total_price'];

                        echo json_encode(array('success' => 'All Data Successfully Inserted'));
                    } else {
                        echo json_encode(array('error' => 'Delivery Info Submission Failed'));
                    }

                } else {
                    echo json_encode(array('error' => 'Order Submission Failed'));
                }

            } else {
                echo json_encode(array('error' => 'Product submission failed in product to cart table'));
            }
        } else {
            echo json_encode(array('error' => $cart_result)); exit;
        }

    }
}

?>