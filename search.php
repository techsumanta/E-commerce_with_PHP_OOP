<?php
include_once "config.php";
if($_GET['search'] == ''){
    header("Location: " . $hostname);
}
    include_once "header.php";  ?>
    <div class="product-section content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-head">Search Results</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 left-sidebar">
                    <?php                    
                    $search_value = $db->escapeString($_GET['search']);

                    $db->select('sub_categories','sub_categories.sub_cat_id,sub_categories.sub_cat_title','sub_categories as sub_cat ON sub_categories.cat_parent_id = sub_cat.cat_parent_id',"sub_cat.sub_cat_title = '{$search_value}' AND sub_categories.sub_cat_status = '1'",null,null);
                    // $sql = $db->getSql();
                    $result = $db->getResult();  
                    ?>

                    <h3>Related Categories</h3>
                    <ul>
                        <?php if(count($result) > 0){
                            foreach($result as $row){ ?>
                            <li>
                                <a href="product_by_subcat.php?subcat_id=<?php echo $row['sub_cat_id']; ?>&subcat_title=<?php echo $row['sub_cat_title']; ?>"><?php echo $row['sub_cat_title']; ?></a>
                            </li>
                        <?php }
                        } ?>
                    </ul>
                </div>
                <div class="col-md-10">
                    <?php
                    $limit = 8;
                    $db->select('product_master','*',null,"product_title LIKE '%{$search_value}%' AND product_status = '1'",null,$limit);
                    $result3 = $db->getResult();
                    if (count($result3) > 0) {
                        foreach($result3 as $row3) {
                            ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a class="image" href="single_product.php?pid=<?php echo $row3['product_id']; ?>">
                                            <img class="pic-1"
                                                 src="product-images/<?php echo $row3['product_image']; ?>">
                                        </a>
                                        <div class="product-button-group">
                                            <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>"><i
                                                    class="fa fa-eye"></i></a>
                                            <a href="" class="add-to-cart"
                                               data-id="<?php echo $row3['product_id']; ?>"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a href="" class="add-to-wishlist"
                                               data-id="<?php echo $row3['product_id']; ?>"><i
                                                    class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title">
                                            <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>"><?php echo substr($row3['product_title'],0,30).'...'; ?></a>
                                        </h3>
                                        <div class="price"><?php echo $cur_format; ?> <?php echo $row3['product_price']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="empty-result">!!! Result Not Found !!!</div>
                    <?php } ?>
                    <div class="pagination-outer">
                        <?php
                        echo $db->pagination('product_master',null,"product_title LIKE '%{$search_value}%'",$limit);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once "footer.php"; ?>