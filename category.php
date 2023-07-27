<?php
    include_once "config.php";
    include_once "header.php";
?>

    <div class="product-section content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">
                        <?php
                            if(!empty($_GET['cat_id']) && !empty($_GET['cat_title'])) {
                                $cat_id = $db->escapeString($_GET['cat_id']);
                                $cat_title = $db->escapeString($_GET['cat_title']);
                                echo $cat_title." Products";

                                $db->select('sub_categories','*',null,"cat_parent_id = '{$cat_id}'",null,null);
                                $sub_result = $db->getResult();
                            } else {
                                echo "Category Not Found";
                            }
                        ?>
                    </h2>
                </div>
            </div>
            <?php if(!empty($sub_result)){ ?>
            <div class="row">
                <div class="col-md-3 left-sidebar">
                    <h3>Related Categories</h3>                    
                    <ul>
                        <?php foreach($sub_result as $sub_row){ ?>
                            <li><a href="product_by_subcat.php?subcat_id=<?php echo $sub_row['sub_cat_id']; ?>&subcat_title=<?php echo $sub_row['sub_cat_title']; ?>"><?php echo $sub_row['sub_cat_title']; ?></a></li>
                        <?php } ?>
                    </ul>                    
                </div>
                <div class="col-md-9">
                    <?php
                        $limit = 8;                    
                        foreach($sub_result as $sub_row){
                            $db->select('product_master','*',null,"product_subcat_id = '{$sub_row['sub_cat_id']}' AND product_status = 1 AND product_stock_qty > 0",null,$limit);                            
                            $pro_result = $db->getResult();
                            if(count($pro_result) > 0) {
                                foreach($pro_result as $pro_row) {
                                    ?>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="product-grid">
                                                <div class="product-image">
                                                    <a class="image" href="single_product.php?pid=<?php echo $pro_row['product_id']; ?>">
                                                        <img class="pic-1" src="product-images/<?php echo $pro_row['product_image']; ?>">
                                                    </a>
                                                    <div class="product-button-group">
                                                        <a href="single_product.php?pid=<?php echo $pro_row['product_id']; ?>" ><i class="fa fa-eye"></i></a>
                                                        <a href="" class="add-to-cart" data-id="<?php echo $pro_row['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                                        <a href="" class="add-to-wishlist" data-id="<?php echo $pro_row['product_id']; ?>"><i class="fa fa-heart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3 class="title">
                                                        <a href="single_product.php?pid=<?php echo $pro_row['product_id']; ?>"><?php echo substr($pro_row['product_title'],0,30),'...'; ?></a>
                                                    </h3>
                                                    <div class="price"><?php echo $cur_format; ?> <?php echo $pro_row['product_price']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            } 
                        }
                     ?>                    
                    <div class="col-md-12 pagination-outer">                        
                    </div>
                </div>
            </div>
            <?php } else { echo "Product Not Found"; } ?>
        </div>
    </div>

<?php include_once "footer.php"; ?>