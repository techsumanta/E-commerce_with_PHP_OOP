<?php 
include_once "config.php";
if(!session_id()){ session_start(); }
if(!isset($_SESSION["user_role"])){
    header("location:{$hostname}");
}else{
    $u_id = $_SESSION["user_id"];
    $order_id = $_SESSION['order_id'];
    $amount = $_SESSION['amount'];    
}
include_once "header.php";        

$db->select('user','user_first_name,user_last_name',null,"user_id = '$u_id'",null,null);
$result = $db->getResult();

if(!empty($result)) {
    $user_name = $result[0]['user_first_name']." ".$result[0]['user_last_name'];    
} else {
    echo "User Not Found"; exit;
}

?>

    <div class="container">        
        <div class="row">
            <div class="col-md-offset-3 col-md-6" style="padding:15% 0;">                                
                <form id="payment_details" class="signup_form" method ="POST" autocomplete="off">
                    <div class="form-group" style="font-size: 1.5em">Your Order is Placed Successfully. Please, make the Payment</div>                    
                <input type="hidden" name="user_name" class="user_name" value="<?php echo $user_name; ?>" />                    
                <input type="hidden" name="order_id" class="order_id" value="<?php echo $order_id; ?>" />
                <input type="hidden" id="amount" name="amount" class="amount" value="<?php echo $amount; ?>" />
                <input type="submit" name="pay_now" id="pay_now" class="btn" value="Pay <?php echo $cur_format.$amount; ?>" />
                </form>

            </div>
        </div>
    </div>

<?php
include_once "footer.php";
?>

    <!-- <button id="rzp-button1">Pay</button> -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

let user_name = $(".user_name").val();
let order_id = $(".order_id").val();
let amount = $(".amount").val() * 100;

$("#pay_now").click(function(e){
    rzp1.open();
    e.preventDefault();    
});

var options = {    
    "key": "rzp_test_Rm9bBL8cx6bntO", // Enter the Key ID generated from the Dashboard
    "amount": amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "e-Commerce Store", //your business name
    "description": "Test Transaction",
    "image": "https://tppwebsolutions.com/wp-content/uploads/logo-demo3.png",    
    "handler": function (response){        
        // console.log(response);
        // window.location.href = "payment_success.php?payment_id="+response.razorpay_payment_id;        
        $.ajax({
            url: "php_files/payment.php",
            method: "POST",
            data: { order_id : order_id, payment_id : response.razorpay_payment_id },
            success: function (response) {
                // console.log(response);
                window.location.href = "payment_success.php";                        
            }
        });
    },
    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
        "name": user_name, //your customer's name
        // "email": "gaurav.kumar@example.com", 
        "contact": "9000090000"  //Provide the customer's phone number for better conversion rates 
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};



var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        // alert(response.error.code);
        // alert(response.error.description);
        // alert(response.error.source);
        // alert(response.error.step);
        alert(response.error.reason);
        // alert(response.error.metadata.order_id);
        // alert(response.error.metadata.payment_id);
});

// document.getElementById('pay_now').onclick = function(e){
//     let amt = document.getElementById('amount').value;
//     console.log(amt);
//     rzp1.open();
//     e.preventDefault();
// }



</script>