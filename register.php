<?php
include_once "config.php";
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {    
    header("Location: " . $hostname."/user_profile.php");
}else{

include_once "header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6" style="padding:90px 0 90px 0;">
           
            <!-- Form -->
            <form id="register_sign_up" class="signup_form" method ="POST" autocomplete="off">
                <h2>register here</h2>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="f_name" class="form-control first_name" placeholder="First Name" requried />
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="l_name" class="form-control last_name" placeholder="Last Name" requried />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="username" class="form-control user_name" placeholder="Email Address" requried />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control pass_word" placeholder="Password" requried />
                </div>
                
                <input type="submit" name="signup" class="btn" value="sign up"/>
            </form>
            <!-- /Form -->
        </div>
    </div>
</div>
    <?php include_once "footer.php";
}
?>