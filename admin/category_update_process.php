<?php session_start();
    if(!empty($_POST))
    {
        
        extract($_POST);
        $_SESSION['error']=array();
        if(empty($cnm))
        {
            $_SESSION['error']['cnm']="enter category name";
        }
        // Image validation
       
        if(!empty($_FILES['cimg']['name']))
        {
            if(file_exists("../category_img/".$_FILES['cimg']['name']))
            {
                $_SESSION['error']['cimg']="file already exists";
            }
        }    

        if (!empty($_SESSION['error'])) 
        {
            header("Location:category_edit.php");
        }

        else
        {
            include("../inc/config.php");
            if(!empty($_FILES['cimg']['name']))
            {
                $f_q="select cat_img from category where cat_id=".$cid;
                $f_res=mysqli_query($link,$f_q);
                $f_row=mysqli_fetch_assoc($f_res);
                unlink("../category_img/".$f_row['cat_img']);
                $img=time()."_".$_FILES['cimg']['name'];
                move_uploaded_file($_FILES['cimg']['tmp_name'],"../category_img/".$img);

                $q = "UPDATE category SET 
                    cat_nm='".$cnm."',
                    cat_img='".$img."' where cat_id=".$cid;
            }
            else
            {
                $q = "UPDATE category SET 
                    cat_nm='$cnm' where cat_id=".$cid;
            }

                mysqli_query($link,$q);

                $_SESSION['success']="Done! category successfully updated";
                header("location:category-list.php");   

        }
    }
    else{
        header("location:caterory.php");
    }

?>