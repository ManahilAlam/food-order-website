<?php
//authorization
//check whether user is logged inor not
if(!isset($_SESSION['user'])) //if user session not set 
{
//user is not logged in
$_SESSION['no-login-message'] = "<div class='error'>Please Login To Access Admin Panel</div>";
header('location:'.SITEURL.'admin/login.php');

}
?>