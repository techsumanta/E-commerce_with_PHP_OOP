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
                            if(!empty($_GET['brand_id']) && !empty($_GET['subcat_id'])){
                                $brand_id = $db->escapeString($_GET['brand_id']);
                                $subcat_id = $db->escapeString($_GET['subcat_id']);

                                $db->select('sub_categories','sub_categories.sub_cat_id,sub_categories.sub_cat_title','sub_categories as sub_cat ON sub_categories.cat_parent_id = sub_cat.cat_parent_id',"sub_cat.sub_cat_id = '{$subcat_id}' AND sub_categories.sub_cat_status = '1'",null,null);
                                $subcat_result = $db->getResult();

                                $db->select('brand','brand_title',null,"brand_id = '{$brand_id}'",null,null);
                                $result = $db->getResult();
                                
                                if(!empty($result)){                                     
                                    echo $result[0]['brand_title'];
                                }else{ 
                                    $title = "Result Not Found";                                    
                                }
                            } else {
                                echo "Brand Not Found";
                            }                            
                        ?>
                    </h2>
                </div>
            </div>
            <?php if(!empty($result)){ ?>
            <div class="row">
                <div class="col-md-3">                    
                    <div class="row">
                        <div class="col-md-12 left-sidebar">
                            <h3>Related Brands</h3>
                            <ul>
                                <?php
                                    $db->select('brand','brand.brand_id,brand.brand_title,brand.brand_subcat_id',null,"brand_subcat_id = '{$subcat_id}'",null,null);
                                    $brand_result = $db->getResult();
                                    if(count($brand_result) > 0){
                                        foreach($brand_result as $brand_row){ ?>
                                            <li><a href="brands.php?brand_id=<?php echo $brand_row['brand_id']; ?>&subcat_id=<?php echo $brand_row['brand_subcat_id']; ?>"><?php echo $brand_row['brand_title']; ?></a></li>
                                    <?php }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-md-12 left-sidebar">
                            <h3>Related Categories</h3>
                            <?php                    
                            if(count($subcat_result) > 0){ ?>
                                <ul>
                                    <?php foreach($subcat_result as $subcat_row){ ?>
                                        <li><a href="product_by_subcat.php?subcat_id=<?php echo $subcat_row['sub_cat_id']; ?>&subcat_title=<?php echo $subcat_row['sub_cat_title']; ?>"><?php echo $subcat_row['sub_cat_title'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php }?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-9">
                    <?php
                    $limit = 8;
                    $db->select('product_master','*',null,"product_brand_id = '{$brand_id}' AND product_status = 1 AND product_stock_qty > 0",null,$limit);
                    $pro_result = $db->getResult();

                    if(count($pro_result) > 0){
                        foreach($pro_result as $pro_row){ ?>
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
                                            <a href="single_product.php?pid=<?php echo $pro_row['product_id']; ?>"><?php echo substr($pro_row['product_title'],0,30).'...'; ?></a>
                                        </h3>
                                        <div class="price"><?php echo $cur_format; ?> <?php echo $pro_row['product_price']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php    }
                    } ?>
                    <div class="col-md-12 pagination-outer">
                        <?php
                            echo $db->pagination('product_master',null,"product_brand_id = '{$brand_id}' AND product_status = 1 AND product_stock_qty > 0",$limit);
                        ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

<?php include_once "footer.php"; ?>