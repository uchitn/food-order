<?php
    // Start session
    session_start();

// Create Constant to Store non reprating values
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die('Connection failed: ' . mysqli_connect_error());
?>