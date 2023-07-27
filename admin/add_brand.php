<?php
    include_once "header.php";
?>

    <div class="admin-content-container">
        <h2 class="admin-heading">Add New Brand</h2>
        <div class="row">        
            <!-- Form -->
            <form id="createBrand" class="add-post-form col-md-6" method="POST">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name"/>
                </div>
                <div class="form-group">
                    <label for="">Parent Sub Category</label>
                    <?php
                    $db = new Database();
                    $db->select('sub_categories','*',null,null,null,null);
                    $result = $db->getResult(); ?>
                    <select class="form-control sub_cat" name="sub_cat">
                        <option value="" selected disabled>Select Sub Category</option>
                        <?php if (count($result) > 0) { ?>
                            <?php foreach($result as $row) { ?>
                                <option value="<?php echo $row['sub_cat_id']; ?>"><?php echo $row['sub_cat_title']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <input type="submit" name="save" class="btn add-new" value="Submit"/></button>
            </form>
            <!-- /Form -->
        </div>
    </div>

<?php
    include_once "footer.php";
?>
            