<?php 
    include('../config/constants.php');
    include('./partials/login-check.php');
?>

<html>

<body>

    <head>
        <title>Food-order</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <div class="dashboard-wrapper">
        <?php
                include('partials/menu.php');
            ?>

        <!--Main Section Start-->
        <div class="dashboard-content">
            <div class="container">
                <h1>Manage Order</h1>

                <?php
if(isset($_SESSION['update'])){
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
?>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.NO</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <?php
    // Get all the orders from the database
    $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // Display the latest orders first
    // Execute query
    $res = mysqli_query($conn, $sql);
    // Count the rows
    $count = mysqli_num_rows($res);

    $sn = 1; // Create a serial number and set its initial value as 1

    if($count > 0) {
        // Orders available
        while($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $food = $row['food'];
            $price = $row['price'];
            $qty = $row['qty'];
            $total = $row['total'];
            $order_date = $row['order_date'];
            $status = $row['status'];
            $customer_name = $row['customer_name'];
            $customer_contact = $row['customer_contact'];
            $customer_email = $row['customer_email'];
            $customer_address = $row['customer_address'];
    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td>
                            <?php
            if($status == "Ordered"){
                echo "<label>$status</label>";
            } elseif($status == "On Delivery") {
                echo "<label style='color:orange'>$status</label>";
            } elseif($status == "Delivered") {
                echo "<label style='color:green'>$status</label>";
            } elseif($status == "Cancelled") {
                echo "<label style='color:red'>$status</label>";
            }
            ?>
                        </td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"
                                class="btn-secondary">Update Order</a>
                        </td>
                    </tr>
                    <?php
        }
    } else {
        // Orders not available
        echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
    }
    ?>
                </table>
            </div>
        </div>
        <!--Main Section End-->
    </div>
</body>

</html>