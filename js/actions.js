$(document).ready(function () {
  
  $(".add-to-wishlist").click(function (e) {
    e.preventDefault();
    let p_id = $(this).attr("data-id");
    $.ajax({
      url: "actions.php",
      method: "POST",
      data: { addWishlist: p_id },
      success: function (data) {
        wishlist_data = `<span>${data}</span>`;
        $(".wishlist_count").html(wishlist_data);
      },
    });
  });

  $(".add-to-cart").click(function (e) {    
    e.preventDefault();
    let p_id = $(this).attr("data-id");    
    $.ajax({
      url: "actions.php",
      method: "POST",
      data: { addCart: p_id },
      success: function (data) {                
        cart_data = `<span>${data}</span>`;
        $(".cart_count").html(cart_data);
      },
    });
  });  

  $(".remove-cart-item").click(function (e) {
    e.preventDefault();
    let tr = $(this);
    let p_id = $(this).attr("data-id");    
    $.ajax({
      url: "actions.php",
      method: "POST",
      data: { removeCartItem: p_id },
      success: function (data) {        
        if(data < 1) {
          cart_data = " ";
          $(".cart_count").html(cart_data);
          $(".cart_items").remove();
        } else{
          cart_data = `<span>${data}</span>`;
          $(".cart_count").html(cart_data);
          tr.parent().parent().remove();
          net_amount();
        } 
      },
    });
  });

  $(".remove-wishlist-item").click(function (e) {
    e.preventDefault();
    let tr = $(this);
    let p_id = $(this).attr("data-id");
    $.ajax({
      url: "actions.php",
      method: "POST",
      data: { removeWishlistItem: p_id },
      success: function (data) {        
        if(data < 1) {
          wish_data = " ";
          $(".wishlist_count").html(wish_data);
          $(".wishlist_items").remove();
        } else {
          wish_data = `<span>${data}</span>`;
          $(".wishlist_count").html(wish_data);
          tr.parent().parent().remove();
        }        
      },
    });
  });

  $(".proceed-to-cart").click(function (e) {
    e.preventDefault();
    let goToCart = 1;
    $.ajax({
      url: "actions.php",
      method: "POST",
      data: { proceedCart: goToCart },
      success: function (data) {
        window.location.href = "cart.php";
      },
    });
  });

  function net_amount() {
    let amount = 0;
    $(".sub-total").each(function () {
      let val = $(this).html();
      let total = parseInt(amount) + parseInt(val);
      amount = total;
    });
    $(".total-amount").html(amount);
    $(".checkout-form").children(".total-price").val(amount);
  }
  net_amount();

  $(".item-qty").change(function () {
    let qty = $(this).val();
    let price = $(this).siblings(".item-price").val();
    let new_price = qty * price;
    $(this).parent().siblings().children(".sub-total").html(new_price);
    net_amount();
    net_qty();
  });

  function net_qty() {
    let val = "";
    $(".item-qty").each(function () {
      val = val + $(this).val() + ",";
    });
    $(".checkout-form").children(".total-qty").val(val);
  }
  net_qty();

  $("#loginUser").submit(function (e) {
    e.preventDefault();
    let username = $(".username").val();
    let password = $(".password").val();
    if (username == "" || password == "") {
      $("#userLogin_form .modal-body").prepend(
        '<div class="alert alert-danger">Please Fill All The Fields.</div>'
      );
    } else {
      $.ajax({
        url: "php_files/user.php",
        method: "POST",
        data: { login: "1", username: username, password: password },
        dataType: "json",
        success: function (response) {
          $(".alert").hide();
          // console.log(response);
          let res = response;
          if (res.hasOwnProperty("success")) {
            $("#userLogin_form .modal-body").prepend(
              '<div class="alert alert-success">LoggedIn Successfully.</div>'
            );
            setTimeout(function () {
              location.reload();
            }, 1000);
          } else if (res.hasOwnProperty("error")) {
            $("#userLogin_form .modal-body").prepend(
              `<div class="alert alert-danger">${res.error}</div>`
            );
          }
        },
      });
    }
  });

  $(".user_logout").click(function (e) {
    e.preventDefault();
    let user_logout = 1;
    $.ajax({
      url: "php_files/user.php",
      method: "POST",
      data: { user_logout: user_logout },
      success: function (response) {
        if (response == "true") {
          window.location.href = "index.php";
        }
      },
    });
  });

  $("#register_sign_up").submit(function (e) {
    e.preventDefault();
    $(".alert").hide();
    let f_name = $(".first_name").val();
    let l_name = $(".last_name").val();
    let username = $(".user_name").val();
    let password = $(".pass_word").val();

    if (f_name == "" || l_name == "" || username == "" || password == "") {
      $("#register_sign_up").prepend(
        '<div class="alert alert-danger">Please Fill All The Fields</div>'
      );
    } else {
      let formdata = new FormData(this);
      formdata.append("create", "1");
      $.ajax({
        url: "php_files/user.php",
        type: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $(".alert").hide();
          // console.log(response);
          let res = response;
          if (res.hasOwnProperty("success")) {
            $("#register_sign_up").prepend(
              '<div class="alert alert-success">' + res.success + "</div>"
            );
            setTimeout(function () {
              window.location.href = "user_profile.php";
            }, 1500);
          } else if (res.hasOwnProperty("error")) {
            $("#register_sign_up").prepend(
              '<div class="alert alert-danger">' + res.error + "</div>"
            );
          }
        },
      });
    }
  });

  $("#modify-user").submit(function (e) {
    e.preventDefault();
    let f_name = $(".first_name").val();
    let l_name = $(".last_name").val();

    if (f_name == "" || l_name == "") {
      $("#modify-user").prepend(
        '<div class="alert alert-danger">Please Fill All The Fields</div>'
      );
    } else {
      let formdata = new FormData(this);
      formdata.append("update", "1");
      $.ajax({
        url: "php_files/user.php",
        type: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $(".alert").hide();
          // console.log(response);
          let res = response;
          if (res.hasOwnProperty("success")) {
            $("#modify-user").prepend(
              '<div class="alert alert-success">Modified Successfully.</div>'
            );
            setTimeout(function () {
              window.location.href = "user_profile.php";
            }, 1500);
          } else if (res.hasOwnProperty("error")) {
            $("#modify-user").prepend(
              '<div class="alert alert-danger">' + res.error + "</div>"
            );
          }
        },
      });
    }
  });

  $("#modify-password").submit(function (e) {
    e.preventDefault();
    $(".alert").hide();
    let old_pass = $(".old_pass").val();
    let new_pass = $(".new_pass").val();

    if (old_pass == "" || new_pass == "") {
      $("#modify-password").prepend(
        '<div class="alert alert-danger">Please Fill All The Fields</div>'
      );
    } else {
      let formdata = new FormData(this);
      formdata.append("modifyPass", "1");
      $.ajax({
        url: "php_files/user.php",
        type: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $(".alert").hide();
          let res = response;
          if (res.hasOwnProperty("success")) {
            $("#modify-password").prepend(
              '<div class="alert alert-success">Password Modified Successfully.</div>'
            );
            setTimeout(function () {
              window.location.href = "user_profile.php";
            }, 1500);
          } else if (res.hasOwnProperty("error")) {
            $("#modify-password").prepend(
              '<div class="alert alert-danger">' + res.error + '</div>'
            );
          }
        },
      });
    }
  });

  $("#delivery_details").submit(function (e) {
    e.preventDefault();
    $(".alert").hide();
    let f_nm = $(".first_name").val();
    let l_nm = $(".last_name").val();
    let add = $(".address").val();
    let phone = $(".phone").val();
    let state = $(".state").val();
    let city = $(".city").val();
    let pin = $(".pincode").val();
    let u_id = $(".user_id").val();
    let total = $(".total_price").val();
    

    let phone_format = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

    if(f_nm == "" || l_nm == "" || add == "" || phone == "" || state == "" || city == "" || pin == "") {      
      $("#delivery_details").prepend(
        '<div class="alert alert-danger">Please Fill All The Fields</div>'
      );
    } else {
      if(phone.match(phone_format)){
        if(isNaN(pin)){
          $("#delivery_details").prepend(
            '<div class="alert alert-danger">Enter a No. in Pincode</div>'
          );
        } else {
          console.log(f_nm+" "+l_nm+" "+add+" "+phone+" "+state+" "+city+" "+pin);

          let formdata = new FormData(this);
          formdata.append("placeOrder", "1");
          $.ajax({
            url: "php_files/order.php",
            type: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
              $(".alert").hide();
              let res = response;
              // console.log(res);
              if (res.hasOwnProperty("success")) {
                $("#delivery_details").prepend(
                  '<div class="alert alert-success">Successful</div>'
                );
                setTimeout(function () {
                  window.location.href = "payment.php";
                }, 1500);
              } else if (res.hasOwnProperty("error")) {
                $("#delivery_details").prepend(
                  '<div class="alert alert-danger">' + res.error + '</div>'
                );
              }
            },
          });
        }        
      } else {
        $("#delivery_details").prepend(
          '<div class="alert alert-danger">Enter a valid Phone no.</div>'
        );
      }
    }

  }); 

  $(".product-by-subcat").click(function() {
    let subcat_id = $(this).attr("data-id");
    let subcat_title = $(this).attr("data-title");
    let currency_format = $(this).attr("currency-format");
    $.ajax({
      url: "products_by_ajax.php",
      method: "POST",
      data: { product_by_subcat: '1', subcat_id: subcat_id },
      success: function(response) {        
        let result = JSON.parse(response);
        let data = "";
        if(result.hasOwnProperty("success")){          
          let res = result['success'];                    
          res.forEach(element => {

            data += `
                    <div class="col-md-4 col-sm-6">
                        <div class="product-grid">
                            <div class="product-image">
                                <a class="image" href="single_product.php?pid=${element['product_id']}">
                                    <img class="pic-1" src="product-images/${element['product_image']}">
                                </a>
                                <div class="product-button-group">
                                    <a href="single_product.php?pid=${element['product_id']}" ><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" class="add-to-cart" data-id="${element['product_id']}"><i class="fa fa-shopping-cart"></i></a>
                                    <a href="javascript:void(0)" class="add-to-wishlist" data-id="${element['product_id']}"><i class="fa fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3 class="title">
                                    <a href="single_product.php?pid=${element['product_id']}">${element['product_title'].substring(0, 30)+"..."}</a>
                                </h3>
                                <div class="price">${currency_format+" "+element['product_price']}</div>
                            </div>
                        </div>
                    </div> `;

          });          
        } else if(result.hasOwnProperty("error")) {
          data += `<div class="empty-result">Product Not Found</div>`;          
        }
        $(".section-head").html(subcat_title);
        $(".get-products").html(data);        
      }
    }) ;

  });

  $(".product-by-brand").click(function() {
    let brand_id = $(this).attr("brand-id");
    let brand_title = $(this).attr("brand-title");
    let subcat_id = $(this).attr("subcat-id");
    let currency_format = $(this).attr("currency-format");    

    $.ajax({
      url: "products_by_ajax.php",
      method: "POST",
      data: { product_by_brand: '1', brand_id: brand_id, subcat_id: subcat_id },
      success: function(response) {        
        let result = JSON.parse(response);
        let data = "";        
        if(result.hasOwnProperty("success")){          
          let res = result['success'];          
          res.forEach(element => { 
            // let cart_btn = '';

            data += `
                    <div class="col-md-4 col-sm-6">
                        <div class="product-grid">
                            <div class="product-image">
                                <a class="image" href="single_product.php?pid=${element['product_id']}">
                                    <img class="pic-1" src="product-images/${element['product_image']}">
                                </a>
                                <div class="product-button-group">
                                    <a href="single_product.php?pid=${element['product_id']}"><i class="fa fa-eye"></i></a>
                                    <a href="javascript:void(0)" class="add-to-cart" data-id="${element['product_id']}"><i class="fa fa-shopping-cart"></i></a>
                                    <a href="javascript:void(0)" class="add-to-wishlist" data-id="${element['product_id']}"><i class="fa fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3 class="title">
                                    <a href="single_product.php?pid=${element['product_id']}">${element['product_title'].substring(0, 30)+"..."}</a>
                                </h3>
                                <div class="price">${currency_format+" "+element['product_price']}</div>
                            </div>
                        </div>
                    </div> `;

          }); 
          console.log(typeof(data));         
        } else if(result.hasOwnProperty("error")) {
          data += `<div class="empty-result">Product Not Found</div>`;          
        }
        $(".section-head").html(brand_title);
        $(".get-products").html(data);        
      }
    }) ;

  });
  
});
