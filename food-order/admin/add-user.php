<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add User</h1>
        <br><br>

        
        <?php 
        if(isset($_SESSION['add'])) //cheaking wether the session is set or not
        {
            echo $_SESSION['add'];//Displaying session message
            unset($_SESSION['add']);//removing session message
             
        }
        ?>
        <br> <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your names" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" placeholder="Enter your email" required></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td><input type="text" name="contact" placeholder="Enter your number" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add User" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>



<?php
// Database connection

// Process the form and save it to the database
if (isset($_POST['submit'])) {
    // Get the data from form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = md5($_POST['password']); // Password encryption with MD5

    // Create SQL query to save data into database
    $sql = "INSERT INTO tbl_user (full_name, email, contact, password) VALUES ('$full_name', '$email', '$contact', '$password')";

    // Execute query and save data in database
    $res = mysqli_query($conn, $sql) or die('Query failed: ' . mysqli_error($conn));

    // Redirect or show a success message
    if ($res) {
       // echo "User added successfully.";
       // create a session veariable to displat messa\age
       $_SESSION['add'] = "<div style='color:green'>User added successfully</div>";
       //redirect page to manage user
       header("location:".SITEURL.'admin/manage_user.php');
    } else {
       // echo "Failed to add user.";
       // create a session veariable to displat messa\age
       $_SESSION['add'] = "<div style='color:red'>Fail to add user</div>";
       //redirect page to add user
       header("location:".SITEURL.'admin/add-user.php');
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
