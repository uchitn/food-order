<?php include('config/constants.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resturant Website</title>
    <link rel="icon" href="./images/favicon.ico">
    <link rel="stylesheet" href="./vendors/slick-slider/slick.css">
    <link rel="stylesheet" href="./vendors/slick-slider/slick-theme.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php
     include('partials-front/menu.php');
    ?>

    <!-- Start Slider Section -->
    <section class="banner">
        <div class="container">
            <div class="banner__slider-wrapper">
                <div class="banner__content">
                    <div class="container">
                        <h1>Recommended Top Foods</h1>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius doloribus nihil repellat
                            facilis
                            exercitationem! Amet veniam cupiditate animi temporibus. Nulla.</p>
                        <a href="#" class="secondary-btn">Make an order</a>
                    </div>
                </div>
                <div class="banner__slider">
                    <div class="slide-item">
                        <picture>
                            <source srcset="images\—Pngtree—food delicious burger_9113995.png" type="image/png">
                            <img src="images\—Pngtree—food delicious burger_9113995.png" loading="lazy">
                        </picture>
                    </div>
                    <div class="slide-item">
                        <picture>
                            <source srcset="images\—Pngtree—sausage cheese pizza slice three-dimensional_13137250.png">
                            <img src="images\—Pngtree—sausage cheese pizza slice three-dimensional_13137250.png"
                                loading="lazy">
                        </picture>
                    </div>
                    <div class="slide-item">
                        <picture>
                            <source srcset="./images/snacks.png" type="image/jpg">
                            <img src="./images/snacks.png" alt="Recommended Item Img 02" loading="lazy">
                        </picture>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Slider Section -->
    <?php
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);  
    }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container three-parts">
            <h2>Explore Foods</h2>
            <?php
            // Create SQL query to display category from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                // Category available
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the values like title, image_name, and id
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
            <a href="<?php  echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">
                <div class="box-3 flex-container">
                    <?php
                            if ($image_name == "") {
                                echo "<div style='color:red'>Image Not Available</div>";
                            } else {
                                ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"
                        alt="<?php echo $title; ?>" class="img-responsive img-curve" style="height: 400px">
                    <?php
                            }
                            ?>
                    <h3 class="text-item text-white"><?php echo $title; ?></h3>
                </div>
            </a>
            <?php
                }
            } else {
                // Category not available
                echo "<div style='color:red'>Category not added</div>";
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container ">
            <div class="three-items">
                <h2 class="text-center">Food order</h2>
                <?php
                // Create SQL query to display food from database
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    // Food available
                    while ($row = mysqli_fetch_assoc($res2)) {
                        // Get the values like title, price, description, and image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                                if ($image_name == "") {
                                    // Image not available
                                    echo "<div style='color:red'>Image not available.</div>";
                                } else {
                                    // Image available
                                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                            class="img-responsive img-curve">
                        <?php
                                }
                                ?>
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>
                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order
                            Now</a>
                    </div>
                </div>
                <?php
                    }
                } else {
                    // Food not available
                    echo "<div style='color:red'>Food not added</div>";
                }
                ?>
                <div class="clearfix"></div>
            </div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->



    <script src="./vendors/jquery/jquery.min.js"></script>
    <script src="./vendors/slick-slider/slick.min.js"></script>
    <script src="./javascript/script.js"></script>
</body>

</html>