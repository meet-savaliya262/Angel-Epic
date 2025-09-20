<?php session_start();

    if(isset($_SESSION['admin']['status']) && isset($_GET['poid']))
    {
        include("../inc/config.php");
        $poid=$_GET['poid'];
        $status=$_GET['status'];
        $q="update latest set po_status=".$status." where po_id= ".$poid;
        mysqli_query($link,$q);
        $_SESSION['success']="post Successfully Updated";
        header("location:latest_list.php");
    }
    else
    {
        header("location:login.php");
    }

?>