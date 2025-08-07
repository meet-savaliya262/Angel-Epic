<?php session_start();
   
    if(!empty($_POST))
    {
        extract($_POST);
        $_SESSION['error']=array();
        if(empty($pnm))
        {
            $_SESSION['error']['pnm']="please enter product name";
        }
        if(empty($cnm))
        {
            $_SESSION['error']['cnm']="please select category";
        }
        if(empty($price))
        {
            $_SESSION['error']['price']="please enter price";
        }
        else if(! is_numeric($price))
        {
            $_SESSION['error']['price']="please enter numeric price";
        }
        if(empty($weight))
        {
            $_SESSION['error']['weight']="please enter product weight";
        }
        if(empty($sdesc))
        {
            $_SESSION['error']['sdesc']="please enter short description";
        }
       
        if(empty($_FILES['pimg']['name']))
        {
            $_SESSION['error']['pimg']="please select product img";
        }
        else if(file_exists("../product_img/".$_FILES['pimg']['name']))
        {
            $_SESSION['error']['pimg']="file already exists";
        }

        if(! empty($_SESSION['error']))
        {
            header("location:product.php");
        }
        else
        {
            include("../inc/config.php");
            $t = time(); 
            $pimg_nm=$t."_".$_FILES['pimg']['name'];
            move_uploaded_file($_FILES['pimg']['tmp_name'],"../product_img/".$pimg_nm);
            $q="insert into products(p_nm,p_cat,p_price,p_weight,p_short_desc,p_description,p_add_info,p_time,p_img)
                values('".$pnm."','".$cnm."','".$price."','".$weight."','".$sdesc."','".$desc."','".$ainfo."','".$t."','".$pimg_nm."')";
            mysqli_query($link,$q);
            $_SESSION['success']='Done! product add sccuccessfully';
            header("location:product.php");    
        }
    }
    else
    {
        header("location:product.php");
    }
?>