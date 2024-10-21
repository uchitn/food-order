<?php include('../config/constants.php');?>
<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <br><br>
        <?php
        if(isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter title">
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="40" rows="10" placeholder="Enter description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            // Create SQL to get all active categories from the database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            // Execute the query
                            $res = mysqli_query($conn, $sql);
                            // Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            if($count > 0) {
                                // We have categories
                                while($row = mysqli_fetch_assoc($res)) {
                                    // Get the details of the category
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            } else {
                                // We don't have categories
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
                        <input type="submit" name="submit" value="Add food" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check whether the button is clicked or not
        if(isset($_POST['submit'])) {
            // Get the values from the form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            // Upload the image if selected
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $image_name = $_FILES['image']['name'];
                // Rename the image
                $ext_array = explode('.', $image_name);
                $ext = end($ext_array);
                $image_name = "Food-Name-".rand(0000, 9999).".".$ext; // New image name may be "Food-Name-657.jpg"
                $src = $_FILES['image']['tmp_name'];
                $dst = "../images/Food/".$image_name;

                // Check if directory exists
                if (!file_exists('../images/Food/')) {
                    mkdir('../images/Food/', 0777, true);
                }

                // Attempt to move the uploaded file
                if(move_uploaded_file($src, $dst) == false) {
                    $_SESSION['upload'] = "<div style='color:red'>Failed to Upload Image. Possible reason: " . error_get_last()['message'] . "</div>";
                    header('location:'.SITEURL.'admin/add-food.php');
                    die();
                }
            } else {
                $image_name = ""; // Setting default value as blank
            }

            // Insert into database
            $sql2 = "INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true) {
                $_SESSION['add'] = "<div style='color:green'>food Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div style='color:red'>Failed to Add food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>
