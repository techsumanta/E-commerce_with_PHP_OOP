<?php
    include_once "config.php";    
    
    // include header 
    include_once "header.php";
?>
<div id="banner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-content ">                                        
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="images/banner-img-1.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/banner-img-3.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/banner-img-4.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-section popular-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head">Popular Products</h2>
                <div class="popular-carousel owl-carousel owl-theme">
                    <?php
                        $db->select('product_master','*',null,'product_status = 1 AND product_stock_qty > 0',null,'5');
                        $result = $db->getResult();                        
                        if(count($result) > 0){
                            foreach($result as $row){ ?>
                    <div class="product-grid latest item">
                        <div class="product-image popular">
                            <a class="image" href="single_product.php?pid=<?php echo $row['product_id']; ?>">
                                <img class="pic-1" src="product-images/<?php echo $row['product_image']; ?>">
                            </a>
                            <div class="product-button-group">
                                <a href="single_product.php?pid=<?php echo $row['product_id']; ?>" ><i class="fa fa-eye"></i></a>
                                <a href="" class="add-to-cart" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                <a href="" class="add-to-wishlist" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3 class="title">
                                <a href="single_product.php?pid=<?php echo $row['product_id']; ?>"><?php echo substr($row['product_title'],0,25),'...'; ?></a>
                            </h3>
                            <div class="price"><?php echo $cur_format; ?> <?php echo $row['product_price']; ?></div>
                        </div>
                    </div>
                    <?php    }
                    }else{
                } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head">Latest Products</h2>
                <div class="latest-carousel owl-carousel owl-theme">
                    <?php
                    $db = new Database();
                    $db->select('product_master','*',null,'product_status = 1 AND product_stock_qty > 0','product_id DESC',12);
                    $result = $db->getResult();
                    if(count($result) > 0){
                        foreach($result as $row){ ?>
                            <div class="product-grid latest item">
                                <div class="product-image popular">
                                    <a class="image" href="single_product.php?pid=<?php echo $row['product_id']; ?>">
                                        <img class="pic-1" src="product-images/<?php echo $row['product_image']; ?>">
                                    </a>
                                    <div class="product-button-group">
                                        <a href="single_product.php?pid=<?php echo $row['product_id']; ?>" ><i class="fa fa-eye"></i></a>
                                        <a href="" class="add-to-cart" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                        <a href="" class="add-to-wishlist" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3 class="title">
                                        <a href="single_product.php?pid=<?php echo $row['product_id']; ?>"><?php echo substr($row['product_title'],0,25),'...'; ?></a>
                                    </h3>
                                    <div class="price"><?php echo $cur_format; ?> <?php echo $row['product_price']; ?></div>
                                </div>
                            </div>
                    <?php    }
                        }?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php"; ?>