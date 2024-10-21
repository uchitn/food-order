<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<nav class="site-nav">
    <div class="container">
        <div class="nav-wrapper">
            <div class="site-logo">
                <a href="#" title="Logo">
                    Fast-Food
                </a>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li>
                        <a href="<?php echo SITEURL;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>category.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>foods.php">food</a>
                    </li>
                    <li class="searchbar">
                        <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                            <input type="search" name="search" placeholder="Search for Food.." required>
                            <i class="fa-solid fa-magnifying-glass">
                            <!-- <input type="submit" name="submit" value="Search" class="btn btn-primary"> -->
                            </i>
                        </form>
                    </li>
                    <li class="admin">
                        <a href="<?php echo SITEURL;?>admin/login.php"><i class="fa-solid fa-user"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
</body>
</html>
