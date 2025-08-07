<?php
    if(!empty($_POST))
    {
        extract($_POST);
        $error=array();
        
       
        if(empty($email))
        {
            $error[]="Enter your email address";
        }
        if(empty($pwd))
        {
            $error[]="Enter your password";
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
            $q="select s_email,s_pwd from signup where s_status=1"
            mysqli_query($link,$q);
            header("location:login.php");
        }
    }
    else
    {
        header("location:login.php");
    }

?>