<?php
include('../config/constants.php');
//check whether the id and image_name value is set or not
if (isset($_GET['id']) AND isset($_GET['image_name'])) {
    // Get the values
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    
    // remove the physical image file is available 
    if($image_name !="")
    {
        //image is available. so remove it
        $path = "../images/category/".$image_name;
        //remove the image
        $remove = unlink($path);

        if($remove==false)
        {
            //set the session message
            $_SESSION['remove'] = "<div style='color:red'>Failed to remove the image</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop the message
            die();
        }
    }

    //delete data from databse
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //excute the query
    $res = mysqli_query($conn, $sql);

    //check whetehr the data is deleted form databse pr not
    if($res==true)
    {
        //set the session message
        $_SESSION['delete'] = "<div style='color:green'>Category deleted successfully</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        //set the session message
        $_SESSION['delete'] = "<div style='color:red'>Failed to delete category</div";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');


    }

    //redirect to manage category page with messafe
    
    // Proceed with deletion
    //echo "get value and delete";
} else {
    // Redirect to manage category page
    header('location:' . SITEURL . 'admin/manage-category.php');
}

?>