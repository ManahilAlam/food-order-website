<?php
include('../config/constants.php');
//destroy session
session_destroy();//unsets user session

//redirect to login page
header('location:'.SITEURL.'admin/login.php');
?>