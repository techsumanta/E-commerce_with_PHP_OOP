<?php 
    include_once "config.php";
    if(!session_id()){ session_start(); }
    if(!isset($_SESSION["user_role"])){
        header("location:{$hostname}");
    }else{
        $u_id = $_SESSION["user_id"];
    }
    include_once "header.php";
    
    $p_ids = $_POST['product_id'];
    $p_qty = $_POST['product_qty'];
    $total_price = $_POST['product_total'];    
?>
    
    <div class="container">        
        <div class="row">
            <div class="col-md-offset-3 col-md-6" style="padding:50px 0 50px 0;">                
                <!-- Form -->
                <form id="delivery_details" class="signup_form" method ="POST" autocomplete="on">
                    <h2>Delivery Details</h2>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control first_name" placeholder="First Name" requried />
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control last_name" placeholder="Last Name" requried />
                    </div>
                    <div class="form-group">
                        <label>Address</label>                        
                        <textarea class="form-control address" name="address" cols="50" placeholder="Address"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control phone" placeholder="Phone" requried />
                        <!-- <input type="text" class="form-control phone" name="mobile" pattern="[1-9]{1}[0-9]{9}" title="Enter 10 digit mobile number" placeholder="Mobile number" required /> -->
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" class="form-control state" placeholder="State" requried />
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" class="form-control city" placeholder="City" requried />
                    </div>
                    <div class="form-group">
                        <label>Pin Code</label>
                        <input type="text" name="pincode" class="form-control pincode" placeholder="Pincode" requried />
                    </div>
                    
                    <input type="hidden" name="user_id" class="user_id" value="<?php echo $u_id; ?>" />                    
                    <input type="hidden" name="product_id" value="<?php echo $p_ids; ?>" />
                    <input type="hidden" name="product_qty" value="<?php echo $p_qty; ?>" />
                    <input type="hidden" name="total_price" class="total_price" value="<?php echo $total_price; ?>" />

                    <input type="submit" name="signup" class="btn" value="Submit"/>
                </form>
                <!-- /Form -->
            </div>
        </div>        
    </div>

<?php include_once "footer.php"; ?>