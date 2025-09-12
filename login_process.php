<?php session_start();
    if(!empty($_POST))
    {
        extract($_POST);
        $_SESSION['error']=array();
        if(empty($email))
        {
            $_SESSION['error'][]="please enter email";
        }
        if(empty($pwd))
        {
            $_SESSION['error'][]="please enter password";
        }
        if(! empty($_SESSION['error']))
        {
            header("location:login.php");
        }
        else
        {
            include("inc/config.php");
            $q="select * from signup where s_email='".mysqli_real_escape_string($link,$email)."' and s_pwd='".mysqli_real_escape_string($link,$pwd)."'";
            $res=mysqli_query($link,$q);
            $row=mysqli_fetch_assoc($res);
            if(empty($row))
            {
                header("location:login.php");
            }
            else
            {
                $_SESSION['client']['email']=$row['s_email'];
                $_SESSION['client']['id']=$row['s_id'];
                $_SESSION['client']['status']=true;
                header("location:index.php");
            }
        }
    }
    else
    {
        header("location:login.php");
    }
?>