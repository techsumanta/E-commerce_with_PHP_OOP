<?php
    include_once "header.php";
?>
    <div class="admin-content-container">
        <a class="add-new pull-right" href="add_product.php">Add New</a>
        <?php
        $limit = 10;
        $db = new Database();
        $db->select('product_master','product_master.product_id,product_master.product_subcat_id,product_master.product_brand_id,product_master.product_title,product_master.product_price,product_master.product_stock_qty,product_master.product_status,product_master.product_image,sub_categories.sub_cat_title,brand.brand_title','sub_categories ON product_master.product_subcat_id=sub_categories.sub_cat_id LEFT JOIN brand ON product_master.product_brand_id=brand.brand_id',null,'product_master.product_id DESC',$limit);
        $result = $db->getResult();
                
        if (count($result) > 0) { ?>
            <h2 class="admin-heading">All Products</h2>
            <table id="productsTable" class="table table-striped table-hover table-bordered">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                </thead>
                <?php
                    $db->select('site_info','currency_format',null,null,null,null);
                    $c_format = $db->getResult();
                    $currency = $c_format[0]['currency_format'];
                ?>
                <tbody>
                    <?php foreach($result as $row) { ?>
                    <tr>
                        <td><b><?php echo 'PDR00'.$row['product_id']; ?></b></td>
                        <td><?php echo $row['product_title']; ?></td>
                        <td><?php echo $row['sub_cat_title']; ?></td>
                        <td><?php echo $row['brand_title']; ?></td>
                        <td><?php echo $currency.$row['product_price']; ?></td>
                        <td><?php echo $row['product_stock_qty']; ?></td>
                        <td>
                            <?php  if($row['product_image'] != ''){ ?>
                                <img src="../product-images/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_image']; ?>" width="50px"/>
                            <?php }else{ ?>
                                <img src="images/index.png" alt="" width="50px"/>
                            <?php } ?>
                        </td>
                        <td><?php
                                if($row['product_status'] == '1'){
                                    echo '<span class="label label-success">Active</span>';
                                }else{
                                    echo '<span class="label label-danger">Inactive</span>';
                                }
                            ?>
                        </td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $row['product_id'];  ?>"><i class="fa fa-edit"></i></a>
                            <a class="delete_product" href="javascript:void(0)" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php }else{ ?>
            <div class="not-found clearfix">!!! No Products Found !!!</div>
        <?php    } ?>
        <div class="pagination-outer">
        <?php   //show pagination
        echo $db->pagination('product_master','sub_categories ON product_master.product_subcat_id=sub_categories.sub_cat_id LEFT JOIN brand ON product_master.product_brand_id=brand.brand_id',null,$limit);
        ?>
        </div>
    </div>
<?php //    include footer file
    include_once "footer.php";
?>
