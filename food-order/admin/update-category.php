<?php include('../config/constants.php');?>
<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        // Check whether the id is set or not
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Create SQL query to get other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Then only we get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                // Redirect to manage category page with message
                $_SESSION['no-category-found'] = "<div style='color:red'>Category not found</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // Display the image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php
                        } else {
                            // Display message
                            echo "<div style='color:red'>Image not available</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get all the values from our form 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Updating new image if selected
            if (isset($_FILES['image']['name'])) {
                // Get the image detail
                $image_name = $_FILES['image']['name'];

                // Check whether the image is available or not 
                if ($image_name != "") {
                    // Image available
                    // Upload the new image
                    $ext = end(explode('.', $image_name));
                    $image_name = "Category_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    // Finally upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not 
                    // And if the image is not uploaded then we will stop the process and redirect with error message
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div style='color:red'>Failed to upload image</div>";
                        // Redirect to add category page
                        header("location:" . SITEURL . 'admin/add-category.php');
                        // Stop the process
                        die();
                    }

                    // Remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);
                        // Check whether the image is removed or not and if failed to remove, display message and stop the process
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div style='color:red'>Failed to remove current image</div>";
                            // Redirect to manage category page
                            header("location:" . SITEURL . 'admin/manage-category.php');
                            // Stop the process
                            die(); 
                        }
                    }
                } else {
                    // Image not available
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // Update the database
            $sql2 = "UPDATE tbl_category SET 
                    title='$title', 
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id";

            // Execute the query
            $res = mysqli_query($conn, $sql2);

            // Redirect to manage category with message
            // Check whether query executed or not
            if ($res == TRUE) {
                // Category updated
                $_SESSION['update'] = "<div style='color:green'>Category Updated Successfully</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                // Failed to update category
                $_SESSION['update'] = "<div style='color:red'>Failed to Update Category</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>

    </div>
</div>

