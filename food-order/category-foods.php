<?php include('config/constants.php');?>
<?php include('partials-front/menu.php')?>
<?php
    if(isset($_GET['category_id']))
    {
        //category id is set
        $category_id = $_GET['category_id'];
        //get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            //get the value from database
            $row = mysqli_fetch_assoc($res);

            if (!empty($row)) {
                //get the title
                $category_title = $row['title'];
            } else {
                // redirect to home page if no category found
                header('Location:'.SITEURL);
            }
        } else {
            // redirect to home page if query fails
            header('Location:'.SITEURL);
        }
    }
    else
    {
        //category id is not set
        //redirect to home page
        header('Location:'.SITEURL);
    }
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        
        <h2>Foods on <a href="#" class="text-white"><?php echo isset($category_title) ? $category_title : 'Unknown Category'; ?></a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //sql query to get all food items from database based on selected category
        if (isset($category_id)) {
            $sql = "SELECT * FROM tbl_food WHERE category_id=$category_id";
            $res = mysqli_query($conn, $sql);
            
            if ($res == true) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            // check if image is available
                            if ($image_name == "") {
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    
                    <?php
                }
            } else {
                echo "<div class='error'>Food not available.</div>";
            }
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->


