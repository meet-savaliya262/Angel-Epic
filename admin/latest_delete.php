<?php session_start();
    if(isset($_SESSION['admin']['status']) && isset($_GET['poid']))
    {

        include("../inc/config.php");
        $poid=$_GET['poid'];
        $sq="select po_img from latest where po_id=".$poid;
        $sres=mysqli_query($link,$sq);
        $srow=mysqli_fetch_assoc($sres);
        unlink("../latest_img/".$srow['po_img']);
        $q="delete from latest where po_id=".$poid;
        mysqli_query($link,$q);
        $_SESSION['success']="post successfully deleted";
        header("location:latest_post_list.php");
    }
    else
    {
        header("location:login.php");
    }


?>