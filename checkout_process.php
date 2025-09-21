<?php 
session_start();

if((!empty($_POST) && isset($_SESSION['client']['status'])))
{
    extract($_POST);
    $_SESSION['error'] = array();

    // ---------- Validation ----------
    if(empty($fnm)) {
        $_SESSION['error']['fnm'] = "Please enter first name";
    }

    if(empty($lnm)) {
        $_SESSION['error']['lnm'] = "Please enter last name";
    }

    if(empty($country)) {
        $_SESSION['error']['country'] = "Please select your country";
    }

    if(empty($address_line1)) {
        $_SESSION['error']['address_line1'] = "Please enter address";
    }

    if(empty($city)) {
        $_SESSION['error']['city'] = "Please enter city name";
    }

    if(empty($state)) {
        $_SESSION['error']['state'] = "Please enter state name";
    }

    if(empty($phone)) {
        $_SESSION['error']['phone'] = "Please enter phone no";
    }
    else if(!is_numeric($phone)) {
        $_SESSION['error']['phone'] = "Please enter valid phone number";
    }

    if(empty($email)) {
        $_SESSION['error']['email'] = "Please enter email";
    }

    if(empty($payment)) {
        $_SESSION['error']['payment'] = "Please select payment method";
    }

    // ---------- Redirect back if error ----------
    if(!empty($_SESSION['error'])) {
        header("location:checkout.php");
        exit;
    }

    // ---------- Insert into DB ----------
    include("inc/config.php");

    $a = "abcdefghijklmnopqrstuvwxyz123456789";
    $key = '';
    for($i=1; $i<=10; $i++) {
        $key .= substr($a, rand(0, strlen($a)-1), 1);
    }

    $t   = date("Y-m-d"); 
    $uid = $_SESSION['client']['id'];

    $pids = array();
    foreach($_SESSION['cart'] as $val) {
        $pids[] = $val['id'];
    }
    $pid = json_encode($pids);

    $q = "INSERT INTO userorder
        (o_fnm,o_lnm,o_country,o_address_line1,o_address_line2,
        o_city,o_state,o_pincode,o_phone,o_email,o_pid,o_uid,o_order_key,
        o_payment,o_time)
        VALUES
        ('".$fnm."','".$lnm."','".$country."','".$address_line1."',
        '".$address_line2."','".$city."','".$state."','".$pincode."','".$phone."','".$email."',
        '".$pid."','".$uid."','".$key."','".$payment."','".$t."')";
        
    $res = mysqli_query($link, $q);

    if(!$res){
        // Debug purpose
        die("MySQL Error: ".mysqli_error($link));
    }

        $order_id = mysqli_insert_id($link);
        unset($_SESSION['cart']);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Order Success</title>
      <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="success-box">
                        <div class="success-icon">✅</div>
                        <h3>Order Placed Successfully!</h3>
                        <p>You will be redirected to your order details shortly...</p>
                    </div>
                </div>
            </div>
        </div>
      

      <script>
        setTimeout(function(){
          window.location.href = "orders.php";
        }, 5000);
      </script>
    </body>
    </html>
    <?php
    exit;
}
else 
{
    header("location:product.php");
    exit;
}
?>
