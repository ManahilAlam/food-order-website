<?php
include('../config/constants.php');
//1: get id of admin to be deleted
$id = $_GET['id'];
//2: create SQL query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id"; //value obtained from get variable
//execute query
$res = mysqli_query($conn , $sql);
//check whether the query executed successfully or not
if($res==TRUE)
{
    //success , admin deleted
    //echo "admin deleted";
    //cretae seesion variable to display message
    $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully </div>";
    //Redirect to manage admin page
    header ('location:'.SITEURL. 'admin/manage-admin.php ');
}
else{
    //echo "admin deletion failed";
    //cretae seesion variable to display message
    $_SESSION['delete'] = "<div class='error'> Failed to delete Admin , plz try again </div>";
    //Redirect to manage admin page
    header ('location:'.SITEURL. 'admin/manage-admin.php');
}
//3: redirect to manage admin page with message (success/error)

?>
