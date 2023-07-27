<?php
include_once "config.php";
session_start();
if(!isset($_SESSION['user_id']) && $_SESSION['user_role'] != 'user') {
    header("Location: " . $hostname);
}
include_once "header.php"; ?>
    <div id="user_profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <h2 class="section-head">My Profile</h2>
                    <?php
                        $user_id = $_SESSION["user_id"];
                        $db = new Database();
                        $db->select('user','*',null,"user_id = '{$user_id}'",null,null);
                        $result = $db->getResult();
                        if (count($result) > 0) {
                            $table = '<table>';
                            foreach($result as $row) { ?>
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <td><b>First Name :</b></td>
                                        <td><?php echo $row["user_first_name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Last Name :</b></td>
                                        <td><?php echo $row["user_last_name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Username :</b></td>
                                        <td><?php echo $row["user_username"]; ?></td>
                                    </tr>                                    
                                </table>
                            <?php }
                        }
                        ?>
                        <a class="modify-btn btn" href="edit_user.php?user=<?php echo $_SESSION['user_id']; ?>">Modify Details</a>
                        <a class="modify-btn btn" href="change_password.php">Change Password</a>
                </div>
            </div>
        </div>
    </div>
<?php include_once "footer.php";


?>
  