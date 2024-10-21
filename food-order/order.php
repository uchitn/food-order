<?php
include('config/constants.php');
?>
<?php include('partials-front/menu.php')?>

<?php
// Check whether food id is set or not
if(isset($_GET['food_id'])){
    $food_id = $_GET['food_id'];

    // Fetch food details
    $sql = "SELECT * FROM tbl_food WHERE id = '$food_id'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);
    // Check whether the data is available or not
    if($count == 1) {
        // Get the data from the database
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:'.SITEURL.'index.php');
    }

    // Check whether the user has already viewed the food
    $sql_check_view = "SELECT * FROM tbl_views WHERE food_id = '$food_id'";
    $res_check_view = mysqli_query($conn, $sql_check_view);

    if(mysqli_num_rows($res_check_view) > 0){
        // User has already viewed, update the view count
        $sql_update_views = "UPDATE tbl_views SET view_count = view_count + 1 WHERE food_id = '$food_id'";
        mysqli_query($conn, $sql_update_views);
    }
    else{
        // First time viewing, insert into tbl_views
        $user_id = 1; // Static user_id, replace this with actual user identification if available
        $sql_insert_view = "INSERT INTO tbl_views ( food_id, view_count) VALUES ( '$food_id', 1)";
        mysqli_query($conn, $sql_insert_view);
    }
}
else{
    header('location:'.SITEURL.'home.php');
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                    // Check whether the image is available or not
                    if(empty($image_name)) {
                        // Image not available
                        echo "<div class='error'>Image not available</div>";
                    } else {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Food Image" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo isset($title) ? $title : ''; ?></h3>
                    <input type="hidden" name="food" value="<?php echo isset($title) ? $title : ''; ?>">
                    <p class="food-price"><?php echo isset($price) ? $price : ''; ?></p>
                    <input type="hidden" name="price" value="<?php echo isset($price) ? $price : ''; ?>"> 

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Nishan Shrestha" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. nishanshrestha.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php
        // Check whether submit button is clicked or not
        if(isset($_POST['submit'])) {
            // Get all the details from form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty; // total = price * qty
            $order_date = date("Y-m-d h:i:sa"); // order date
            $status = "ordered"; // ordered, undelivered, delivered, cancelled
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            // Save the order in database
            // Create SQL to save the data
            $sql2 = "INSERT INTO tbl_order SET
                food='$food',
                price=$price,
                qty=$qty,
                total=$total,
                order_date='$order_date',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'
            ";

            $res2 = mysqli_query($conn, $sql2);
            // Check whether executed successfully or not 
            if($res2 == true) {
                // Query executed and order saved
                $_SESSION['order'] = "<div class='success text-center'>Food ordered successfully</div>";
                header('location:'.SITEURL);
            } else {
                $_SESSION['order'] = "<div class='error text-center'>Failed to order food</div>";
                header('location:'.SITEURL);
            }
        }
        ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- Recommended for You Section -->
<section class="food-recommend">
    <div class="container">
        <h2 class="text-center text-white">Recommended for You</h2>

        <!-- Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                // Fetch the top 5 most viewed recipes by the user that have at least 3 views
                $sql_recommend = "SELECT f.* FROM tbl_food f
                                  JOIN tbl_views v ON f.id = v.food_id
                                   AND v.view_count >= 3
                                  ORDER BY v.view_count DESC LIMIT 5";
                $res_recommend = mysqli_query($conn, $sql_recommend);

                if(mysqli_num_rows($res_recommend) > 0){
                    while($row_recommend = mysqli_fetch_assoc($res_recommend)){
                        $rec_id = $row_recommend['id'];
                        $rec_title = $row_recommend['title'];
                        $rec_image = $row_recommend['image_name'];
                        ?>
                        <div class="swiper-slide recommend-item">
                            <?php
                            if ($rec_image == ""){
                                echo "<div style='color:red'>Image not available.</div>";
                            } else {    
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $rec_image; ?>" alt="Recommended Food">
                                <?php
                            }
                            ?>
                            <h3><?php echo $rec_title; ?></h3>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $rec_id; ?>" class="btn">Order Here</a>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No recommendations available at the moment.</p>";
                }
                ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Swiper Initialization -->
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 20,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
        },
    });
</script>

<!-- Custom CSS -->
<style>
/* Your existing CSS here */
/* Your existing CSS here */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.food-recommend {
    background-color: #f8f8f8;
    padding: 50px 0;
}

.food-recommend h2 {
    color: black;
    margin-bottom: 30px;
}

.swiper-container {
    width: 100%;
    height: 100%;
    display: flex;
}

.swiper-wrapper {
    display: flex; /* Ensures items are displayed in a row */
    flex-wrap: wrap;
    gap: 20px; /* Adds space between items */
    justify-content: center; /* Centers the items horizontally */
}

.recommend-item {
    background-color: white;
    padding: 20px;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    width: 300px; /* Adjusts the width of each item */
}

.recommend-item img {
    max-width: 100%;
    border-radius: 10px;
}

.recommend-item h3 {
    margin: 15px 0;
    font-size: 18px;
}

.recommend-item a.btn {
    background-color: #ff6b6b;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
}

/* Swiper Navigation Styling */
.swiper-button-next, .swiper-button-prev {
    color: #333;
}

/* Adjusts layout for smaller screens */
@media screen and (max-width: 768px) {
    .recommend-item {
        width: 100%; /* Stacks items vertically on smaller screens */
    }
}

</style>


