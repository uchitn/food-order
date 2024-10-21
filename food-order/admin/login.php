<?php
include('../config/constants.php');
?>
<html>
    <head>
        <title>Login Food-order  System</title>
        <link rel="stylesheet" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <section class="login__form">
    <div class="container">
        <div class="header">
            <h1>Admin form</h1>
            <hr>
        </div>


        <div class="login__card flex ">
            <div class="left__content  ">

            </div>
            <div class="right__content  col-2">
                <h2>Login form</h2>

                <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset(  $_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>
                <div class="user_details">
                    <form action="" method="POST" class="text-center">

                        <div class="username_email container">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="username" placeholder="Enter Username">
                            <hr>
                        </div>


                        <div class="username_pass container">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" placeholder="Enter Password">
                            <hr>
                        </div>
                        <div class="btn-primary"><input type="submit" name="submit" value="Login"   ></div>
                      
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>
        
    </body>
</html>

<?php
// Check whether the Submit is Clicked or  not
if(isset($_POST['submit']))
{
    // process for login
    // 1. get the data from login form 
     $username = $_POST['username'];
     $password = $_POST['password'];

    //  2. SQL to check wether with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    // 3. Execute the Query
    $res = mysqli_query($conn, $sql);

    // 4. coutn row to chek whether the user exists or not 
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        // User Available and login success
        $_SESSION['login'] = "<div >Login successful.<div>";
        $_SESSION['user'] = $username; // check whetethe the user is login or  not
        // redirect to dashboard
        header('Location:' .SITEURL.'admin/index.php');
    }
    else{
        // User  not Available
        $_SESSION['login'] = "<div >Username or password did  not match.<div>";
        // redirect to dashboard
        header('localhost:' .SITEURL.'admin/login.php');
    }
}
?>
