<?php
include_once "config.php";
if(!session_id()){ session_start(); }
    if(!isset($_SESSION["user_role"])){
        header("location:{$hostname}");
    }else{
        $u_id = $_SESSION["user_id"];
    }

include_once "header.php";
?>
    <div class="product-cart-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">My Orders</h2>                    
                    <table class="table table-bordered">
                        <tbody>
                            <?php
                                $db = new Database();
                                    
                                $db->select('order_master','*',null,'user_id IN ('.$u_id.')','order_id DESC',null);
                                $order_result = $db->getResult();

                                if(count($order_result) > 0){ 

                                    foreach($order_result as $order_row){                
                                        $db->select('product_to_cart','*',null,'cart_id IN ('.$order_row['cart_id'].')',null,null);
                                        $pro_cart_result = $db->getResult();

                                            ?><tr class="active">
                                                <th colspan="3"><h4><b>ORDER No. : <?php echo 'ODR00'.$order_row['order_id']; ?></b></h4></th>
                                                <th width="200px"><b>Order Placed : </b><?php echo $order_row['order_date']; ?></th>
                                            </tr><?php

                                        if(count($pro_cart_result) > 0) {
                                            
                                            foreach($pro_cart_result as $pro_cart_row) {
                                                $db->select('product_master','product_title,product_price,product_image',null,'product_id IN ('.$pro_cart_row['cart_product_id'].')',null,null);
                                                $pro_master_result = $db->getResult();                                                
                                                ?>                                                
                                                <tr>
                                                    <td>
                                                        <img class="img-thumbnail" src="product-images/<?php echo $pro_master_result[0]['product_image']; ?>" alt="" width="100px" />
                                                    </td>
                                                    <td>
                                                        <span><b>Product Name :</b> <?php echo $pro_master_result[0]['product_title']; ?></span><br/>
                                                        <span><b>Product Price :</b> <?php echo $cur_format.' '.$pro_master_result[0]['product_price']; ?></span><br/>
                                                        <span><b>Quantity :</b> <?php echo $pro_cart_row['cart_product_qty']; ?></span><br/>
                                                        <span><b>Total :</b> <?php echo $pro_cart_row['cart_product_qty'] * $pro_master_result[0]['product_price']; ?></span><br/>
                                                    </td>
                                                    <td colspan="2"><?php echo $cur_format.' '.$pro_cart_row['cart_product_qty'] * $pro_master_result[0]['product_price']."/-"; ?></td>                                                    
                                                    <!-- <td>
                                                        <span><b>Delivery Expected By :</b> <?php echo date('d',strtotime($row[$i]['order_date']. ' +4 day')); ?> - <?php echo date('d F, Y',strtotime($row[$i]['order_date']. ' +7 day')); ?></span>
                                                    </td> -->
                                                </tr> 
                                                <?php
                                            }
                                        }

                                        if($order_row['order_status'] == '1'){
                                            $status = '<label class="label label-success">Delivered</label>';
                                        }
                                        else{
                                            $status = '<label class="label label-primary">In - Process</label>';
                                        }

                                        ?>
                                            <tr>
                                                
                                                <td colspan="3" align="right"><b>Status : <?php echo $status; ?></b><span style="margin-left:50px;"><b>Total Amount : </b></span></td>
                                                <td><b><?php echo $cur_format.' '.$order_row['order_amount']."/-"; ?></b></td>
                                            </tr>

                                        <?php
                                    }
                                } else {
                            ?>
                                <div class="empty-result">
                                    No Orders Found.
                                </div>
                            <?php
                                }
                            ?>                                    
                        </tbody>
                    </table>                                                
                </div>
            </div>
        </div>
    </div>
<?php
 include_once "footer.php";
?>