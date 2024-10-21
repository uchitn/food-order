<?php
//include constants.php for SITEURL
include('../config/constants.php');
//destroid the session
session_destroy();//unset $_SESSIOJ['user']

//2. redirect to login page
header('location:'.SITEURL.'index.php');
?>