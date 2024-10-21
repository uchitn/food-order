<?php
include('../config/constants.php');

// 1. Check whether value is passed or not
if(isset($_GET['id']) && isset($_GET['image_name'])) {
    // Process to delete
    // echo "Process to delete";

    // Get id and image name 
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the image if available 
    // Check whether the image is available or not and delete only if available
    if($image_name != "") {
        $path = "../images/food/".$image_name;

        $remove = unlink($path);

        if($remove == false) {
            // Failed to remove image
            $_SESSION['upload'] = "<div style='color:red;'>Failed to remove file.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }

    // Delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed or not 
    if($res == true) {
        // Deleted successfully
        $_SESSION['delete'] = "<div style='color:green;'>food deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    } else {
        // Failed to delete
        $_SESSION['delete'] = "<div style='color:red;'>Failed to delete food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

    // Redirect to manage food with session message
} else {
    // Redirect to manage food page
    // echo "Redirect";
    $_SESSION['Unauthorized'] = "<div style='color:red;'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>
