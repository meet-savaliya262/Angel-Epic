<?php
include("../inc/config.php"); 

if(isset($_POST['id']) && isset($_POST['status']))
{
    $id = intval($_POST['id']); 
    $status = mysqli_real_escape_string($link, $_POST['status']);

    $q = "UPDATE userorder SET o_status='$status' WHERE o_id=$id";
    if(mysqli_query($link, $q))
    {
        echo "success";
    } 
    else 
    {
        http_response_code(500);
        echo "Error: " . mysqli_error($link);
    }
}
?>
