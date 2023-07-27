<?php
    include_once 'header.php';
?>
<div class="admin-content-container">
    <h2 class="admin-heading">All Brands</h2>
    <a class="add-new pull-right" href="add_brand.php">Add New</a>
    <?php
    $limit = 10;
    $db = new Database();
    $db->select('brand','brand.brand_id,brand.brand_title,brand.brand_subcat_id,sub_categories.sub_cat_title','sub_categories ON brand.brand_subcat_id=sub_categories.sub_cat_id',null,'brand.brand_id DESC',$limit);
    $result = $db->getResult();
    if (count($result) > 0) { ?>
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <th>Title</th>
            <th>Sub Category</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php foreach($result as $row) { ?>
                <tr>
                    <td><?php echo $row['brand_title']; ?></td>
                    <td><?php echo $row['sub_cat_title']; ?></td>
                    <td>
                        <a href="edit_brand.php?id=<?php echo $row['brand_id'];  ?>"><i class="fa fa-edit"></i></a>
                        <a class="delete_brand" href="javascript:void(0);" data-id="<?php echo $row['brand_id'];  ?>"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php }else{ ?>
        <div class="not-found">!!! No Barnds Found !!!</div>
    <?php    } ?>
    <div class="pagination-outer">
        <?php echo $db->pagination('brand','sub_categories ON brand.brand_subcat_id=sub_categories.sub_cat_id',null,$limit); ?>
    </div>
</div>

<?php
    include_once "footer.php";
?>
