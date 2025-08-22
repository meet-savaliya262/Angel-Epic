<?php session_start();

if(!empty($_POST)) 
{
    extract($_POST);
    $error = array();

    if(empty($fnm)) {
        $error[] = "enter your name";
    }
    if(empty($email)) {
        $error[] = "enter your email";
    }
    if(empty($phone)) {
        $error[] = "enter your phone number";
    }
    if(empty($msg)) {
        $error[] = "enter your message";
    }

    if (!empty($error)) 
    {
        $_SESSION['status'] = "error";
        header("Location: contact.php");
    } 
    else 
    {
        include("include/config.php");
        $t = time();
        $q = "INSERT INTO contact(c_fnm,c_email,c_phone,c_msg,c_time) 
              VALUES('".$fnm."','".$email."','".$phone."','".$msg."','".$t."')";
        mysqli_query($link, $q);

        $_SESSION['status'] = "success";
        header("Location: contact.php");
    }
} 
else 
{ 
    header("Location: contact.php");
}
?>
