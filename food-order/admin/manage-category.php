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
                    <h1>Manage Category</h1>

                    <?php
                        if(isset($_SESSION['add'])) 
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }

                        if(isset($_SESSION['remove'])) 
                        {
                            echo $_SESSION['remove'];
                            unset($_SESSION['remove']);
                        }

                        if(isset($_SESSION['delete'])) 
                        {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }

                        if(isset($_SESSION['no-category-found'])) 
                        {
                            echo $_SESSION['no-category-found'];
                            unset($_SESSION['no-category-found']);
                        }
                        if(isset($_SESSION['update'])) 
                        {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }
                        if(isset($_SESSION['upload'])) 
                        {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
                        if(isset($_SESSION['failed-remove'])) 
                        {
                            echo $_SESSION['failed-remove'];
                            unset($_SESSION['failed-remove']);
                        }

                    ?>

                    <!-- Button to Add Category -->
                    <a href="<?php echo SITEURL;?>admin/add-category.php" class="primary-btn">Add Category</a>


                    <table class="category-table">
                        <tr>
                            <th>S.N</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                    //Quwery to get all admin
                    $sql = "SELECT * FROM tbl_category";
                    // execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count =mysqli_num_rows($res);

                    $sn=1; //crreate a variable and assign the value

                        //chexk the num of row
                        if($count>0)
                        {
                            //we have data in database
                            //get the data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                
                                ?>
                        <tr>
                            <td> <?php echo $sn++;?></td>
                            <td><?php echo $title;?></td>

                            <td>

                                <?php
                                        //check whether image name is available or not
                                        if($image_name!="")
                                        {
                                            //display image
                                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="100px">
                                <?php

                                        }
                                        else
                                        {
                                            //display message
                                            echo"<div style='color:red'>Image not added.</div>";
                                        }

                                        ?>

                            </td>

                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>"
                                    class="success-btn">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>"
                                    class="danger-btn">Delete</a>
                            </td>
                        </tr>
                        <?php
                            }
                        
                        }
                        else
                        {
                            //no data in database
                            //we'll deisplay the message inside the table
                            ?>
                        <tr>
                            <td colspan="6">
                                <div style="red">No Category Added.</div>
                            </td>
                        </tr>
                        <?php
                        }
                ?>



                    </table>

                </div>
            </div>
            <!--Main Section End-->
        </div>
    </body>
</html>