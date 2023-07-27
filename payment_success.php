<?php 
    include_once "config.php";
    if(!session_id()){ session_start(); }
    if(!isset($_SESSION["user_role"])){
        header("location:{$hostname}");
    }else{
        $u_id = $_SESSION["user_id"];
    }
    include_once "header.php";        
?>

    <div class="container">        
        <div class="row">
            <div class="col-md-offset-3 col-md-6" style="padding:15% 0 25%;">                                
                <h2 align="center">Thank You for This Payment.</br> Your Product is Deliver within 3 - 4 Days</h2>
            </div>
        </div>
    </div>

<?php include_once "footer.php"; ?>