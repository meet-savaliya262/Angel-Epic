<?php 
session_start();

if (!empty($_POST)) {
    
    extract($_POST);
    $_SESSION['error'] = [];

    // Validation
    if (empty($ponm)) 
    {
        $_SESSION['error']['ponm'] = "Please enter product name";
    }

    if (empty($podesc))
    {
        $_SESSION['error']['podesc'] = "Please enter product description";
    }

    // Image validation
    if (!empty($_FILES['poimg']['name'])) 
    {
        if (file_exists("../latest_img/" . $_FILES['poimg']['name'])) 
        {
            $_SESSION['error']['poimg'] = "File already exists";
        }
    }

    // If there are any errors
    if (!empty($_SESSION['error'])) 
    {
        header("Location: latest_edit.php?poid=" . urlencode($poid));
        exit;
    } 
    else
    {
        include("../inc/config.php");

        if (!empty($_FILES['poimg']['name'])) 
        {
            // Delete old image
            $f_q = "SELECT po_img FROM latest WHERE po_id=" . intval($poid);
            $f_res = mysqli_query($link, $f_q);
            if ($f_res && mysqli_num_rows($f_res) > 0) 
            {
                $f_row = mysqli_fetch_assoc($f_res);
                if (!empty($f_row['po_img']) && file_exists("../latest_img/" . $f_row['po_img'])) {
                    unlink("../latest_img/" . $f_row['po_img']);
                }
            }

            // Upload new image
            $img = time() . "_" . basename($_FILES['poimg']['name']);
            move_uploaded_file($_FILES['poimg']['tmp_name'], "../latest_img/" . $img);

            $q = "UPDATE latest SET 
                po_nm = '" . mysqli_real_escape_string($link, $ponm) . "',
                po_description = '" . mysqli_real_escape_string($link, $podesc) . "',
                po_img = '" . mysqli_real_escape_string($link, $img) . "'
                WHERE po_id = " . intval($poid);
        } 
        else 
        {
            $q = "UPDATE latest SET 
                po_nm = '" . mysqli_real_escape_string($link, $ponm) . "',
                po_description = '" . mysqli_real_escape_string($link, $podesc) . "'
                WHERE po_id = " . intval($poid);
        }

        if (mysqli_query($link, $q)) 
        {
            $_SESSION['success'] = "Done! Post successfully updated.";
        } 
        else 
        {
            $_SESSION['error']['db'] = "Database error: " . mysqli_error($link);
        }

        header("Location: latest_list.php");
        exit;
    }

} 
else 
{
    header("Location: latest.php");
    exit;
}
?>
