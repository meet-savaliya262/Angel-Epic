<?php session_start();
   
    if(!empty($_POST))
    {
        extract($_POST);
        $_SESSION['error']=array();
        if(empty($ponm))
        {
            $_SESSION['error']['ponm']="please enter latest products name";
        }
        if(empty($podesc))
        {
            $_SESSION['error']['podesc']="please enter latest product description";
        }
        if(empty($_FILES['poimg']['name']))
        {
            $_SESSION['error']['poimg']="please select product img";
        }
        else if(file_exists("../latest_img/".$_FILES['poimg']['name']))
        {
            $_SESSION['error']['poimg']="file already exists";
        }

        if(! empty($_SESSION['error']))
        {
            header("location:latest.php");
        }
        else
        {
            include("../inc/config.php");
            $t = time(); 
            $poimg_nm=$t."_".$_FILES['poimg']['name'];
            move_uploaded_file($_FILES['poimg']['tmp_name'],"../latest_img/".$poimg_nm);
            $q="insert into latest(po_nm,po_description,po_time,po_img)
                values('".$ponm."','".$podesc."','".$t."','".$poimg_nm."')";
            mysqli_query($link,$q);
            $_SESSION['success']='Done! post add sccuccessfully';
            header("location:latest.php");    
        }
    }
    else
    {
        header("location:latest.php");
    }
?>