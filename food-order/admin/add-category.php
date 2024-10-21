<?php 
    include('../config/constants.php');
    include('./partials/login-check.php');
?>
<?php include('partials/menu.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            <?php
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <br><br>
            
            <!-- add category form starts -->
             <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-add">
                        </td>
                    </tr>
                </table>
             </form>    
            <!-- add category form end -->

            <?php
            // Check whether the submit button is clicked or not 
            if(isset($_POST['submit'])) {
                // Get the value from category form 
                $title = $_POST['title'];

                // For radio input type we need to check whether the button is selected or not 
                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                $active = isset($_POST['active']) ? $_POST['active'] : "No";

                // Check whether image is selected or not set the value for image name 
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                    // Upload the image
                    // To upload we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    // Auto rename the image to avoid duplication
                    $ext = end(explode('.', $image_name));
                    $image_name = "Category_".rand(000, 999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    // Finally upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not 
                    // And if the image is not uploaded then we will stop the process and redirect with error message
                    if($upload == false) {
                        $_SESSION['upload'] = "<div style='color:red'>Failed to upload image</div>";
                        // Redirect to add category page
                        header("location:".SITEURL.'admin/add-category.php');
                        // Stop the process
                        die();
                    }

                } else {
                    // Don't upload the image and set the image name value as blank
                    $image_name = "";
                }

                // Create SQL query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                // Execute the query and save in database
                $res = mysqli_query($conn, $sql);

                // Check whether the query executed or not and data added or not
                if($res == true) {
                    // Query executed and category added 
                    $_SESSION['add'] = "<div style='color:green'>Category Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    // Failed to add category
                    $_SESSION['add'] = "<div style='color:red'>Failed To Add Category</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
            ?>
        </div>
    </div>


            