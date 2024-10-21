<?php include('../config/constants.php');?>
<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>
        <br><br>

        <?php
        // Check whether id is set or not
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            // Fetch current details from database
            $sql = "SELECT * FROM tbl_food WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if($res == true) {
                $count = mysqli_num_rows($res);
                if($count == 1) {
                    // Get details
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['image_name'];
                    $category_id = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    // Redirect to manage food with message
                    $_SESSION['no-food-found'] = "<div style='color:red;'>No Food Found.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        } else {
            // Redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
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
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image != "") {
                            echo "<img src='../images/food/$current_image' width='150px'>";
                        } else {
                            echo "<div style='color:red;'>Image Not Added.</div>";
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
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count > 0) {
                                while($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                                    ?>
                                    <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if($featured == "Yes"){echo "checked";} ?>> Yes
                        <input type="radio" name="featured" value="No" <?php if($featured == "No"){echo "checked";} ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if($active == "Yes"){echo "checked";} ?>> Yes
                        <input type="radio" name="active" value="No" <?php if($active == "No"){echo "checked";} ?>> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update food" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if(isset($_POST['submit'])) {
            // Get all the details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Updating new image if selected
            if(isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if($image_name != "") {
                    // Auto rename the image
                    $ext = end(explode('.', $image_name));
                    $image_name = "Food-Name-".rand(0000, 9999).".".$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/".$image_name;

                    // Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if($upload == false) {
                        $_SESSION['upload'] = "<div style='color:red;'>Failed to Upload Image.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                    }

                    // Remove current image if available
                    if($current_image != "") {
                        $remove_path = "../images/food/".$current_image;
                        $remove = unlink($remove_path);

                        if($remove == false) {
                            $_SESSION['failed-remove'] = "<div style='color:red;'>Failed to remove current image.</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // Update the database
            $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id=$id
            ";

            $res3 = mysqli_query($conn, $sql3);

            if($res3 == true) {
                $_SESSION['update'] = "<div style='color:green'>food Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            } else {
                $_SESSION['update'] = "<div style='color:red'>Failed to Update food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>
