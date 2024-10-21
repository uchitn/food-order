<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1>
        <br><br>

        <?php
        //1. get the id of selected admin 
        $id=$_GET['id'];

        //2. create sql querry to get the details
        $sql="SELECT * FROM tbl_user WHERE id=$id" ;

        //execute the querry
        $res=mysqli_query($conn,$sql);

        //check whether the querry is ececuted or not
        if($res==true)
        {
            //check whether the data is available or not
            $count=mysqli_num_rows($res);
            //check whether we have user data oor not
            if($count==1)
            {
                //echo "User Available";
                $row=mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $email = $row['email'];
                $contact = $row['contact'];
            }
            else{
                //redirect to manage user page
                header('location:'.SITEURL.'admin/manage_user.php');
            }
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name;?>" ></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?php echo $email;?>"  ></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td><input type="text" name="contact" value="<?php echo $contact;?>" ></td>
                </tr>
               

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update User" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

    </div>
</div>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
       // echo "button clicked";
        //get all the valus from form to update
         $id = $_POST['id'];
         $full_name = $_POST['full_name'];
         $email=$_POST['email'];
         $contact=$_POST['contact'];

         //create a sql querry to update user
         $sql = "UPDATE tbl_user SET full_name = '$full_name', email = '$email', contact = '$contact' WHERE id='$id'";
         //execute the query
         $res = mysqli_query($conn, $sql);

         //check wheter the queey execute succesful or not
        if($res==TRUE)
        {
            //Querry executed and user updated
            $_SESSION['update'] ="<div style='green'Admin Update Successfully.</div>";
            //redirect to manager user page
            header('location:'.SITEURL.'admin/manage_user.php');
        }
        else{
            //Querry not executed
            $_SESSION['update'] ="<div style='red'Failed to update admin.</div>";
            //redirect to manager user page
            header('location:'.SITEURL.'admin/manage_user.php');
        }
        }

?>
