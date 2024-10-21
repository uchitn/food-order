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
                    <table class="tbl-full">
                        <tr>
                            <th>S.N</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Nishan Shrestha</td>
                            <td>Shresthauchit@gmail.com</td>
                            <td>1234567890</td>
                            <td>
                                <a href="#" class="btn-primary">Update User</a>
                                <a href="#" class="btn-danger" >Delete Admin</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>ABHSIHEK Shrestha</td>
                            <td>Shresthauchit@gmail.com</td>
                            <td>1234567890</td>
                            <td>
                            <a href="#" class="btn-primary">Update User</a>
                            <a href="#" class="btn-danger" >Delete Admin</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Ram Shrestha</td>
                            <td>Shresthauchit@gmail.com</td>
                            <td>1234567890</td>
                            <td>
                            <a href="#" class="btn-primary">Update User</a>
                            <a href="#" class="btn-danger" >Delete Admin</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--Main Section End-->
        </div>
    </body>
</html>
