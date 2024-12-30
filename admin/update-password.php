<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class='wrapper'>
        <h1>Change Password</h1>
        <br><br>
        <?php
         if(isset($_GET['id'])) //gets 
         {
            $id=$_GET['id'];
         }
        ?>
        <form action="" method="POST">
            <table class='tbl-30'>
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder='current password'>
                    </td>
                </tr>
                <tr>
                <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder='New password'>
                    </td>
                </tr>
                <tr>
                <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder='confirm password'>
                    </td>
                </tr>
                <tr>
                <td colspan='2'>
                    <input type="hidden" name='id' value="<?php echo $id;?>" >
                    <input type="submit" name='submit' value='Change Password' class='btn-secondary'>

                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>
<?php
//check if submit button is clicked or not
if(isset($_POST['submit']))
{
    //echo "clicked";
    //get data from form
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);
    //check whether user with currentid or password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    //execute
    $res = mysqli_query($conn ,$sql);
    if($res==true)
    {
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //user exists and password can be changed
           // echo "user yes";
           if($new_password==$confirm_password)
           {
            //update password
            $sql2="UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
            //execute query
            $res2 = mysqli_query($conn ,$sql2);

            //check whether query executed or not
            if($res2==true)
            {  //success message
                 //redirect to manage admin pade with sucess mesage
            $_SESSION['change-pwd'] = "<div class='success'> Password Changed Successfully </div>";
            //redirect user
            header('location:'.SITEURL.'admin/manage-admin.php');


            }
            else{
                //error message
                $_SESSION['change-pwd'] = "<div class='error'> Failed To Change Password </div>";
            //redirect user
            header('location:'.SITEURL.'admin/manage-admin.php');

            }

           }
           else{
            //redirect to manage admin pade with error mesage
            $_SESSION['password-not-matched'] = "<div class='error'> password did not match </div>";
            //redirect user
            header('location:'.SITEURL.'admin/manage-admin.php');

           }
           //check whether the new pass and confirm match

        }
        else{
            //user doesn't exist set message , redirect
            $_SESSION['user-not-found'] = "<div class=error> User Not Found </div>";
            //redirect user
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
    }
    //check whether the new password and confirm password match or not
    //change pass if all true

}
?>
<?php include("partials/footer.php"); ?>