<?php
    include_once "header.php";
?>

<div class="admin-content-container">
    <h2 class="admin-heading">Edit Product</h2>
    <?php
    $id = $_GET['id'];
    $db = new Database();
    $db->select('product_master','*',null,"product_id = $id",null,null);
    $result = $db->getResult();
    if ($result > 0) {
        foreach($result as $row) { ?>
            <form id="updateProduct" class="add-post-form row" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="">Product Title</label>
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                        <input type="text" class="form-control product_title" name="product_title"
                               value="<?php echo $row['product_title']; ?>" placeholder="Product Title"/>
                    </div>
                    <div class="form-group category">
                        <label for="">Product Category</label>
                        <?php
                        $db->select('sub_categories','cat_parent_id',null,"sub_cat_id = '{$row['product_subcat_id']}'",null,null);
                        $result2 = $db->getResult();                        
                        if ($result2 > 0) { ?>
                            <select class="form-control product_category" name="product_cat">
                                <?php
                                    $db->select('categories',"*",null,null,null,null);
                                    $result3 = $db->getResult();
                                    if($result3 > 0) {
                                        foreach($result3 as $row3) {
                                            if($row3['cat_id'] == $result2[0]['cat_parent_id']){
                                                ?>
                                                <option selected value="<?php echo $row3['cat_id']; ?>"><?php echo $row3['cat_title']; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $row3['cat_id']; ?>"><?php echo $row3['cat_title']; ?></option>
                                                <?php
                                            }
                                        }
                                    }                                        
                                 ?>                                    
                            </select>
                        <?php } ?>
                    </div>
                    <div class="form-group sub_category">
                        <label for="">Product Sub-Category</label>
                        <?php                        
                        $db->select('product_master','product_subcat_id',null,"product_id = '{$_GET['id']}'",null,null);
                        $res = $db->getResult();
                        echo $res[0]['product_subcat_id'];
                        if($res > 0) {
                            $db->select('sub_categories','cat_parent_id',null,"sub_cat_id = '{$res[0]['product_subcat_id']}'",null,null);
                            $res2 = $db->getResult();
                            echo $res2[0]['cat_parent_id'];
                            // exit;
                            if($res2 > 0) {
                                $db->select('sub_categories','*',null,"cat_parent_id = '{$res2[0]['cat_parent_id']}'");
                                $res3 = $db->getResult();
                            }
                            ?>
                            <select class="form-control product_sub_category" name="product_sub_cat">
                            
                            <?php foreach($res3 as $ros3) {
                                if($ros3['sub_cat_id'] == $row['product_subcat_id']){ ?>
                                    <option selected value="<?php echo $ros3['sub_cat_id']; ?>"><?php echo $ros3['sub_cat_title']; ?></option>
                            <?php   }else{ ?>
                                    <option value="<?php echo $ros3['sub_cat_id']; ?>"><?php echo $ros3['sub_cat_title']; ?></option>
                            <?php    }
                            } 
                        } ?>
                            </select>
                        
                    </div>
                    <div class="form-group brand">
                        <label for="">Product Brand</label>
                        <?php
                        $db->select('brand','*',null,"brand_subcat_id = '{$row['product_subcat_id']}'",null,null);
                        $result4 = $db->getResult();
                        if ($result4 > 0) { ?>
                        <select class="form-control product_brands" name="product_brand">
                            <option value="">Select Brand</option>
                            <?php foreach($result4 as $row4) {
                                if($row['product_brand_id'] == $row4['brand_id']){ ?>
                                    <option selected value="<?php echo $row4['brand_id']; ?>"><?php echo $row4['brand_title']; ?></option>
                                <?php   }else{ ?>
                                    <option value="<?php echo $row4['brand_id']; ?>"><?php echo $row4['brand_title']; ?></option>
                                <?php    }
                            } ?>
                        </select>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="">Product Description</label>
                        <textarea class="form-control product_description" name="product_desc" rows="8"
                                  cols="80"><?php echo $row['product_desc']; ?></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Featured Image</label>
                        <input type="file" class="product_image" name="new_image">
                        <input type="hidden" class="old_image" name="old_image" value="<?php echo $row['product_image']; ?>">
                        <img id="image" src="../product-images/<?php echo $row['product_image']; ?>" alt="" width="100px"/>
                    </div>
                    <div class="form-group">
                        <label for="">Product Price</label>
                        <input type="text" class="form-control product_price" name="product_price" value="<?php echo $row['product_price']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Available Quantity</label>
                        <input type="number" class="form-control product_qty" name="product_qty" value="<?php echo $row['product_stock_qty']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control product_status" name="product_status">
                            <option <?php if($row['product_status'] == '1') echo 'selected'; ?> value="1">Published</option>
                            <option <?php if($row['product_status'] == '0') echo 'selected'; ?> value="0">Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn add-new" name="submit" value="Update">
                    </div>
                </div>
            </form>
        <?php
        }
    }
    ?>
</div>

<?php
    include_once "footer.php";
?>