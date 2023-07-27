<?php
    include_once "header.php";
?>

<div class="admin-content-container">
    <h2 class="admin-heading">All SubCategory</h2>
    <a class="add-new pull-right" href="add_sub_category.php">Add New</a>
    <?php
    $limit = 10;
    $db = new Database();
    $db->select('sub_categories','sub_categories.sub_cat_id,sub_categories.sub_cat_title,sub_categories.cat_parent_id,sub_categories.sub_cat_status,categories.cat_title','categories ON sub_categories.cat_parent_id=categories.cat_id',null,'sub_categories.sub_cat_id ASC',$limit);    
    $result = $db->getResult();
    if (count($result) > 0) { ?>
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <th>Title</th>
            <th>Category</th>            
            <th>Status</th>
            <th>Action</th>
            </thead>
            <tbody>
            <?php foreach($result as $row) { ?>
                <tr>
                    <td><?php echo $row['sub_cat_title']; ?></td>
                    <td><?php echo $row['cat_title']; ?></td>
                    <td></td>                    
                    <td>
                        <a href="edit_sub_category.php?id=<?php echo $row['sub_cat_id'];  ?>"><i class="fa fa-edit"></i></a>
                        <a class="delete_subCategory" href="javascript:void(0);" id="<?php echo $row['sub_cat_id'];  ?>"><i class="fa fa-trash"></i></a>
                        <span style="margin-left:15px;">
                            <?php if($row['sub_cat_status'] == '1'){ ?>
                                <input type="checkbox" class="toggle-checkbox sub_cat_status" id="<?php echo $row['sub_cat_id'];  ?>" checked />
                            <?php }else{ ?>
                                <input type="checkbox" class="toggle-checkbox sub_cat_status" id="<?php echo $row['sub_cat_id'];  ?>" />
                            <?php } ?>
                        </span>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php }else{ ?>
        <div class="not-found">!!! No Sub Categories Available !!!</div>
    <?php    }  ?>
    <div class="pagination-outer">
        <?php echo $db->pagination('sub_categories','categories ON sub_categories.cat_parent_id=categories.cat_id',null,$limit); ?>
    </div>
</div>

<?php
    include_once "footer.php";
?>