<?php
    if(!empty($_POST))
    {
        extract($_POST);
        $error=array();
        
        if(empty($fnm))
        {
            $error[]="Enter your Name";
        }
        if(empty($email))
        {
            $error[]="Enter your email address";
        }
        if(empty($pwd))
        {
            $error[]="Enter your password";
        }
        if(empty($rpwd))
        {
            $error[]="Enter your retype password";
        }
        if($pwd != $rpwd)
        {
            $error[]="your password is not same";
        }

        if (!empty($error)) 
        {
            foreach ($error as $er) 
            {
                echo "<p style='color:red;'>$er</p>";
            }
        } 
        else
        {
            include("inc/config.php");
            $t=time();
            $q="insert into signup(s_fnm,s_email,s_pwd,s_time) values('".$fnm."','".$email."','".$pwd."','".$t."')";
            mysqli_query($link,$q);
            header("location:index.php");
        }
    }
    else
    {
        header("location:login.php");
    }

?>