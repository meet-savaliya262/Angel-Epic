<?php
      if(!empty($_POST))
      {
            extract($_POST);
            $error=array();
            if(empty($fnm))
            {
                $error[]="enter your name";
            }
            if(empty($email))
            {
                $error[]="enter your email";
            }
            if(empty($phone))
            {
                $error[]="enter your phone number";
            }
            if(empty($msg))
            {
                $error[]="enter your message";
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
               $q="insert into contact(c_fnm,c_email,c_phone,c_msg,c_time) values('".$fnm."','".$email."','".$phone."','".$msg."','".$t."')";
               mysqli_query($link,$q);
               header("location:contact.php");

            }
      }
      else
      { 
        header("location:contact.php");
      }


?>