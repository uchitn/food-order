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
                <h1>Manage food</h1>
                <?php
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset ($_SESSION['add']);
    }

    if(isset($_SESSION['delete']))
    {
        echo $_SESSION['delete'];
        unset ($_SESSION['delete']);
    }
    if(isset($_SESSION['upload']))
    {
        echo $_SESSION['upload'];
        unset ($_SESSION['upload']);
    }
    if(isset($_SESSION['Unauthorized']))
    {
        echo $_SESSION['Unauthorized'];
        unset ($_SESSION['Unauthorized']);
    }
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset ($_SESSION['update']);
    }
?>
                <!-- Button to Add Category -->
                <a href="<?php echo SITEURL;?>admin/add-food.php" class="primary-btn">Add food</a>
                <br /><br /><br />


                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    <?php

            $sql="SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);

            //count row 
            $count = mysqli_num_rows($res);
            
            //creata number varible set defult value one
            $sn=1;

            if($count>0)
            {
                //we have food in database
                //get the foods form databse and display
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the value form individual colums
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active=$row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $title;?></td>
                        <td>$<?php echo $price;?></td>
                        <td>
                            <?php 
                                    //check if image is available in food
                                    if($image_name=="")
                                    {
                                        //we do not have image display error msg
                                        echo"<div style='color:red'>Image not Added</div>";
                                    }
                                    else
                                    {
                                        ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" width="50">
                            <?php
                                    }
                                    ?>

                        </td>
                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>"
                                class="success-btn">Update food</a>
                            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>"
                                class="danger-btn">Delete food</a>
                        </td>
                    </tr>

                    <?php
                }
            }
            else
            {
                //no food in database
                echo"<tr><td colspan='7' style='color:red'>Food not Added Yet</td></tr>";
            }
        ?>



                </table>
            </div>
        </div>
        <!--Main Section End-->
    </div>
</body>

</html>