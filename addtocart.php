<?php 
ini_set('session.gc_maxlifetime', 86400); // 24 hours
session_set_cookie_params(86400);
session_start();

include("inc/config.php");

// Add product to cart
if(isset($_POST['pid']) && isset($_POST['qty']) && !isset($_POST['update_qty'])) {
    $id  = (int)$_POST['pid'];
    $qty = (int)$_POST['qty'];

    $q   = "SELECT p_nm,p_price,p_img FROM products WHERE p_id=".$id." AND p_status=1";
    $res = mysqli_query($link,$q);

    if($res && mysqli_num_rows($res)>0) {
        $row = mysqli_fetch_assoc($res);

        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        foreach($_SESSION['cart'] as &$item) {
            if($item['id'] == $id) {
                $item['qty'] += $qty; 
                $found = true;
                break;
            }
        }

        if(!$found) {
            $_SESSION['cart'][] = array(
                'id'    => $id,
                'qty'   => $qty,
                'nm'    => $row['p_nm'],
                'price' => $row['p_price'],
                'img'   => $row['p_img']
            );
        }
    }

    header("Location: product-single.php?pid=".$id);
    exit;
}

if(isset($_POST['update_qty']) && isset($_POST['pid']) && isset($_POST['qty'])) {
    $id  = (int)$_POST['pid'];
    $qty = (int)$_POST['qty'];

    foreach($_SESSION['cart'] as &$item) {
        if($item['id'] == $id) {
            $item['qty'] = max(1, $qty); 
            break;
        }
    }
    header("Location: cart.php");
    exit;
}

// Remove product
if(isset($_GET['rid'])) {
    $id = (int)$_GET['rid'];
    foreach($_SESSION['cart'] as $index => $item) {
        if($item['id'] == $id) {
            unset($_SESSION['cart'][$index]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); 
    header("Location: cart.php");
    exit;
}
?>
;