<?php
include_once "config.php";
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {
include_once "header.php"; ?>
<div id="user_profile-content">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <?php
                $user = $_GET['user'];
                $db = new Database();
                $db->select('user','*',null,"user_id= '{$user}'",null,null);
                $result = $db->getResult();
                if(count($result) > 0) { ?>
                    <!-- Form -->
                    <form id="modify-user" method="POST">
                        <div class="signup_form">
                            <h2>Modify Profile</h2>
                            <?php foreach($result as $row){ ?>
                                <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="Username"
                                       value="<?php echo $row['user_username']; ?>" disabled requried>
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control first_name"
                                       placeholder="First Name" value="<?php echo $row['user_first_name']; ?>" requried>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control last_name" placeholder="Last Name"
                                       value="<?php echo $row['user_last_name']; ?>" requried>
                            </div>                            
                            
                            <input type="submit" name="signup" class="btn" value="Modify"/>
                        <?php  } ?>
                        </div>
                    </form>
                    <!-- /Form -->
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "footer.php";
}
?>