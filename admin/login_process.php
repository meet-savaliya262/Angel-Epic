<?php session_start();
    if(!empty($_POST))
    {
        extract($_POST);
        $error=array();
        if(empty($unm))
        {
            $error[]="please enter email";
        }
        if(empty($pwd))
        {
            $error[]="please enter password";
        }
        if(!empty($error))
        {
            foreach($error as $er)
            {
                echo $er.'<br />';
            }
        }
        else
        {
            include("../inc/config.php");
            $q="select * from admin where admin_email='".mysqli_real_escape_string($link,$unm)."' and admin_pwd='".mysqli_real_escape_string($link,$pwd)."'";
            $res=mysqli_query($link,$q);
            $row=mysqli_fetch_assoc($res);
            if(empty($row))
            {
                echo "wrong unm or pass";
            }
            else
            {
                $_SESSION['admin']['email']=$row['admin_email'];
                $_SESSION['admin']['id']=$row['admin_id'];
                $_SESSION['admin']['status']=true;
                 header("location:index.php");
            }
        }
    }
    else
    {
        header("location:login.php");
    }
?>