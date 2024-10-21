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
                    <div class="dash-board ">
                        <h1 class="">DASHBOARD</h1>
                       
                        <?php
                        if(isset($_SESSION['login']))
                        {
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
                        }
                        ?>
                     <div class="dashboard-insights">
                            <div class="col-4 text-center">
                                <div class="insight-block">
                                    <?php
                                    $sql = "SELECT * FROM tbl_category";
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);
                                    ?>
                                    <h2><?php echo $count; ?></h2>
                                    Category
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="insight-block">
                                    <?php
                                    $sql = "SELECT * FROM tbl_food";
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);
                                    ?>
                                    <h2><?php echo $count; ?></h2>
                                    Foods
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="insight-block">
                                    <?php
                                    $sql = "SELECT * FROM tbl_order";
                                    $res = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($res);
                                    ?>
                                    <h2><?php echo $count; ?></h2>
                                    Order
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="insight-block">
                                    <h2>4</h2>
                                    Feedback
                                </div>
                            </div>
                     </div>
                    </div>
                </div>
            </div>
            <!--Main Section End-->
        </div>
    </body>
</html>
