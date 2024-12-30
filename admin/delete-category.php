<?php

include('../config/constants.php');

//echo "Delete Page";
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
 // echo "Get Value and Delete";
 $id = $_GET['id'];
 $image_name = $_GET['imagr_name'];
  // remove
if($image_name != "")
{
    // img is available. so remove it
    $path = "../images/category/".$image_name;
    //remove
    $remove = unlink($path);

    if($remove==false)
    {
        // set session
        $_SESSION['remove']="<div class = 'error'> Failed to Remove Category Image </div>";

        // redirect 
        header('location: '.SITEURL. 'admin/manage-category.php');
    
        // stop
        die();

    }
}
  //delete
    $sql = "DELETE FROM tbl_category WHERE id = $id";
    
    //execute
   $res = mysqli_query($conn, $sql);
   //check
   if($res==true)
   {
     $_SESSION['delete '] = "<div class = 'success'>Category Deleted Successfully.</div>";
     //redirect
     header('location:'.SITEURL.'admin/manage-category.php');

   }
   else
   {

    $_SESSION['delete '] = "<div class = 'error'>Failed to Delete Category.</div>";
    //redirect
    header('location:'.SITEURL.'admin/manage-category.php');
    
   }

  //redirect

}
else
{
 header('location:'.SITEURL.'admin/manage-category.php');
}
?>