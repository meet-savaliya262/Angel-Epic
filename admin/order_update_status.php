<?php
include("../inc/config.php");

if (!empty($_POST['id']) && !empty($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = mysqli_real_escape_string($link, $_POST['status']);

    $q = "UPDATE userorder SET o_status='$status' WHERE o_id=$id";
    if (mysqli_query($link, $q)) {
        echo "success";
    } else {
        echo "error: " . mysqli_error($link);
    }
} else {
    echo "invalid";
}
?>
