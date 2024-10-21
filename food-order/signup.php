<?php
 include('./config/constants.php');
if(isset($_POST['submit'])){
  $name=$_POST['full_name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $contact=$_POST['contact'];

  $sql="INSERT into `tbl_user` (full_name,email,password ,contact) values ('$name','$email','$password',' $contact') ";
  $res=mysqli_query($conn,$sql);
  if(!$res){
    die("connection was not successfully".mysqli_error($conn));
  } 
  else{
      
    header('location:'.SITEURL.'login.php');
  }


}

?>





<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <style>
    body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 0;
  background-image: url('img2.jpg');
  background-size: cover;
  background-position: center;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.signup-container {
  background-color: #ffffff;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  padding: 40px;
  width: 100%;
  max-width: 400px;
}

.signup-container h1 {
  font-size: 28px;
  margin-bottom: 20px;
  text-align: center;
}

.signup-container form {
  display: grid;
  gap: 15px;
}

.signup-container input {
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  width: 100%;
}

.signup-container input:focus {
  outline: none;
  border-color: #007bff;
}

.signup-container button {
  padding: 12px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

.signup-container button:hover {
  background-color: #0056b3;
}

#error,
#error3,
#error4,
#error5,
#error6
 {
  font-size: 14px;
  color: red;
}

@media (max-width: 480px) {
  .signup-container {
    padding: 20px;
  }
}

    
    
  </style>

</head>
<body>
  <div class="signup-container">
    <h1>Sign Up</h1>
    <form onsubmit="return validation()" method="POST" enctype="multipart/form-data">
      <input type="text" placeholder="Full name" id="fname" name="full_name"><span id="error" style="color:red"></span>
      <input type="email" placeholder="Enter your email" id="femail" name="email">
      <input type="password" class="pass" placeholder="Password" id="fpass" name="password" required><span id="error3" style="color:red"></span>
      <input type="password" placeholder="Confirm Password" id="frepass" required><span id="error4" style="color:red"></span>
      <input class="phone" type="tel" placeholder="Enter your phone number" id="fphone" name="contact" required><span id="error5" style="color:red"></span>
      
      <br>
      <button class="btn" type="submit" name="submit">Sign Up</button>
    </form>
  </div>
  <script>
    function validation() {
      var fname = document.getElementById('fname').value;
      if (fname == "") {
        document.getElementById('error').innerHTML = "*Fullname cannot be null";
        return false;
      }

      var fpass = document.getElementById('fpass').value;
      if (fpass.length < 8) {
        document.getElementById('error3').innerHTML = "*Your password must be at least 8 characters long. Please try another.";
        return false;
      }

      var frepass = document.getElementById('frepass').value;
      if (fpass != frepass) {
        document.getElementById('error4').innerHTML = "*Password must be the same";
        return false;
      }

      var fphone = document.getElementById('fphone').value;
      if (fphone.length != 10) {
        document.getElementById('error5').innerHTML = "*Must contain 10 digits";
        return false;
      }
    }
  </script>
</body>
</html>

