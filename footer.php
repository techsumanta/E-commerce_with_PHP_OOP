<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php
                    $db = new Database();
                    $db->select('site_info','site_name,site_desc,contact_phone,contact_email,contact_address',null,null,null,null);
                    $footer = $db->getResult();  ?>
                <h3><?php echo $footer[0]['site_name']; ?></h3>
                <p><?php echo $footer[0]['site_desc']; ?></p>
            </div>
            <div class="col-md-3">
                <h3>Categories</h3>
                <ul class="menu-list">
                    <?php
                    $db = new Database();
                    $db->select('categories','*',null,null,null,null);
                    $result = $db->getResult();
                    if(count($result) > 0){
                        foreach($result as $res){ ?>
                            <li><a href="category.php?cat_id=<?php echo $res['cat_id']; ?>&cat_title=<?php echo $res['cat_title']; ?>"><?php echo $res['cat_title']; ?></a></li>
                        <?php    }
                    } ?>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Useful Links</h3>
                <ul class="menu-list">
                    <li><a href="<?php echo $hostname; ?>">Home</a></li>
                    <li><a href="all_products.php">All Products</a></li>
                    <li><a href="latest_products.php">Latest Products</a></li>
                    <li><a href="popular_products.php">Popular Products</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Contact Us</h3>
                <ul class="menu-list">
                    <?php if(!empty($footer[0]['contact_address'])){ ?>
                        <li><i class="fa fa-home" ></i><span>: <?php echo $footer[0]['contact_address']; ?></span></li>
                    <?php } ?>
                    <?php if(!empty($footer[0]['contact_phone'])){ ?>
                        <li><i class="fa fa-phone" ></i><span>: <?php echo $footer[0]['contact_phone']; ?></span></li>
                    <?php } ?>
                    <?php if(!empty($footer[0]['contact_email'])){ ?>
                        <li><i class="fa fa-envelope" ></i><span>: <?php echo $footer[0]['contact_email']; ?></span></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-12">
                <span id="curYear"></span>                            
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="js\jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="js\bootstrap.min.js"></script>
<script src="js\actions.js"></script>
<!--okzoom Plugin-->
<script src="js/okzoom.min.js" type="text/javascript"></script>
<!--owl carousel plugin-->
<script type="text/javascript" src="js/owl.carousel.js"></script>

<script>

    let date = new Date();
    let year = date.getFullYear();
    document.getElementById("curYear").innerHTML = "&copy; copyright "+year+" - Created By techsumanta";

    $(document).ready(function(){

        $('#product-img').okzoom({
            width: 200,
            height: 200,
            scaleWidth: 800
        });

        $('.banner-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 1,
                    nav: true
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: false,
                    margin: 10
                }
            }
        });

        $('.popular-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 2,
                    nav: true
                },
                800: {
                    items: 4,
                    nav: true
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 10
                }
            }
        });

        $('.latest-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 2,
                    nav: true
                },
                800: {
                    items: 3,
                    nav: true
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: false,
                    margin: 5
                }
            }
        });
    });

</script>

</body>
</html>