<?php

// Include constants.php file here
include('../config/constants.php');

// 1. Get the ID of Admin to be deleted
$id = $_GET['id'];

// 2. Create SQL Query to Delete Admin
$sql = "DELETE FROM tbl_user WHERE id=$id";

// Execute the query
$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if ($res == true) {
    // Query executed successfully and admin deleted
    //echo "User Deleted";
    // create session variable to display message
    $_SESSION['delete'] = "<div style='color:green'>User Deleted Successfully.</div>";
    // Redirect page to manage-user.php
    header('location:'.SITEURL.'admin/manage_user.php');
} else {
    // Query not executed successfully and admin not deleted
    //echo "Failed To Delete User";
    $_SESSION['delete'] = "<div style='color:red'>Failed To Delete User. try again later.</div>";
    header('location:'.SITEURL.'admin/manage_user.php');
}

// 3. Redirect to manage user page with message (success/error)
?>
