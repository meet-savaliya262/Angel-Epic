<?php session_start();

if (!empty($_POST)) 
{
    extract($_POST);
    $_SESSION['error'] = [];

    if (empty($cnm)) 
    {
        $_SESSION['error']['cnm'] = "Enter category name";
    }

    if (empty($_FILES['cimg']['name'])) 
    {
        $_SESSION['error']['cimg'] = "Please select category image";
    } 
    else if (file_exists("../category_img/" . $_FILES['cimg']['name'])) 
    {
        $_SESSION['error']['cimg'] = "File already exists";
    }

    if (!empty($_SESSION['error'])) 
    {
        header("Location: category.php");
        exit;
    }

    include("../inc/config.php");
    $t = time();
    $cimg_nm = $t . "_" . $_FILES['cimg']['name'];
    move_uploaded_file($_FILES['cimg']['tmp_name'], "../category_img/" . $cimg_nm);

    $q = "INSERT INTO category(cat_nm, cat_time, cat_img) VALUES('$cnm', '$t', '$cimg_nm')";
    mysqli_query($link, $q);

    $_SESSION['success'] = 'Done! Category added successfully';
    header("Location: category.php");
    exit;
} 
else 
{
    header("Location: category.php");
    exit;
}
?>
