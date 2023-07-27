<?php
    include_once "header.php";
?>
    <div class="admin-content-container">
        <h2 class="admin-heading">All Orders</h2>
        <?php
        $limit = 5;
        $db = new Database();
        // $db->sql('SELECT order_products.product_id,order_products.order_id,order_products.total_amount,order_products.product_qty,order_products.delivery,order_products.product_user,order_products.order_date,products.featured_image,user.f_name,user.address,user.city,payments.payment_status FROM order_products LEFT JOIN products ON FIND_IN_SET(products.product_id,order_products.product_id) > 0
        //             LEFT JOIN user ON order_products.product_user=user.user_id LEFT JOIN payments ON payments.txn_id = order_products.pay_req_id GROUP BY order_products.order_id ORDER BY order_products.order_id DESC');
        //     $result = $db->getResult();
            $db->select('order_master','*',null,null,'order_id DESC',null);
            $order_master_result = $db->getResult();

            if(count($order_master_result) > 0) {  ?>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <th>ORDER No.</th>
                        <th width="300px">Product Details</th>                        
                        <th>Total Amount</th>
                        <th>Customer Details</th>
                        <th>Order Date</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        </thead>
                        <tbody>
                        <?php  foreach($order_master_result as $order_master_row) { ?>
                            
                            <tr>
                                <td><?php echo 'ODR00'.$order_master_row['order_id']; ?></td>
                                <td>
                                <?php
                                $db->select('product_to_cart','cart_product_id,cart_product_qty',null,'cart_id IN ('.$order_master_row['cart_id'].')',null,null);
                                $pro_cart_result = $db->getResult();

                                    foreach($pro_cart_result as $pro_cart_row){ ?>
                                    <b>Product Code: </b><?php echo 'PDR00'.$pro_cart_row['cart_product_id']; ?>
                                    <b>Quantity: </b><?php echo $pro_cart_row['cart_product_qty']; ?>
                                    <br>
                                <?php } ?>

                                </td>                                
                                <td><?php echo $cur_format.' '.$order_master_row['order_amount']; ?></td>
                                <td>
                                <?php
                                $db->select('order_to_delivery','f_name,l_name,address,state,city',null,'order_id IN ('.$order_master_row['order_id'].')',null,null);
                                $delivery_result = $db->getResult();

                                    foreach($delivery_result as $delivery_row) {
                                ?>
                                    <b>Name : </b><?php echo $delivery_row['f_name']." ".$delivery_row['l_name']; ?><br>
                                    <b>Address : </b><?php echo $delivery_row['address']; ?><br>
                                    <b>State : </b><?php echo $delivery_row['state']; ?><br>
                                    <b>City : </b><?php echo $delivery_row['city']; ?><br>
                                <?php } ?>
                                </td>
                                <td><?php echo $order_master_row['order_date'];?></td>
                                <?php
                                $db->select('order_to_payment','order_to_payment.payment_status,order_to_delivery.delivery_status','order_to_delivery ON order_to_payment.order_id = order_to_delivery.order_id','order_to_payment.order_id IN ('.$order_master_row['order_id'].')',null,null);
                                $payment_result = $db->getResult();                                

                                if(!empty($payment_result)) {
                                    if($payment_result[0]['payment_status'] == '1') {
                                        ?> 
                                        <td><span class="label label-success">Payment Success</span></td>
                                        <?php
                                        if($payment_result[0]['delivery_status'] == '0') {
                                        ?>
                                        <td>
                                            <a class="btn btn-sm btn-primary order_complete" href="javascript:void(0)" data-id="<?php echo $order_master_row['order_id']; ?>">complete</a>
                                        </td>
                                        <?php
                                        } else {
                                        ?>
                                        <td>Delivery Completed</td>
                                        <?php
                                        }
                                        ?>
                                        <?php  
                                    } else {
                                        ?>
                                        <td><span class="label label-danger">Payment Due</span></td>
                                        <td>Not Delivered</td>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <td><span class="label label-danger">Payment Due</span></td>
                                    <td>Not Delivered</td>
                                    <?php
                                }
                                ?>                                
                            </tr>
                        <?php  
                        }?>
                        </tbody>
                    </table>
                <?php
            }else { ?>
                    <div class="not-found">!!! No Orders Found !!!</div>
            <?php } ?>
            <div class="pagination-outer">
                <?php echo $db->pagination('order_products','products ON order_products.product_id=products.product_id
                LEFT JOIN user ON order_products.product_user=user.user_id LEFT JOIN payments ON payments.txn_id = order_products.pay_req_id',null,$limit); ?>
            </div>
    </div>
<?php
    include_once "footer.php";
?>
