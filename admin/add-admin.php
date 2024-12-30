<html>
    <head>
    <title>Food Order Website-add admin page</title>
    <link rel="stylesheet" href="../css/admin.css">

<body>
<?php include('partials/menu.php');?>
<div class='main-content'>
    <div class='wrapper'>
        <h1>Add Admin</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add'])) //checks if seesion is set or not 
        {
            echo $_SESSION['add']; //display
            unset($_SESSION['add']); //remove
        }
        ?>
          <form action="" method='POST'>
            <table class='tbl-30'>
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder='enter your name'></td>  
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder='enter username'></td>  
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder='enter password'></td>  
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="submit" name='submit' value='Add Admin' class='btn-secondary'>
                    </td>
                </tr>
            </table>
          </form>
    </div>
</div>
<?php include("partials/footer.php")?>
<?php
//process value from form , and save to database
//check if buttom clicked or not (isset function checks whether a property is set or not)
 if(isset($_POST['submit'])) 
 {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //SQL Query to Save DataBase
    //column name , value from form
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',  
    username='$username',
    password='$password'";
    
    //executing query and saving data to database
    $res = mysqli_query($conn ,$sql) or die(mysqli_error()); //if failed error ,will die if not 

    //check whether the (Query is executed) data is inserted or not and display appropriate message

    if($res==TRUE)
    {
        //echo "data inserted";
        //create a session variable to display message
        $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
        //redirect page to manage admin
        header("location:".SITEURL. 'admin/manage-admin.php');

    }
   else
    {
        //echo "failed to insert data";
         //create a session variable to display message
         $_SESSION['add']="<div class='error'> Failed to Add Admin , plz try again </div>";
         //redirect page to add admin
         header("location:".SITEURL. 'admin/add-admin.php'); 
    }

 }

?>
</body>
    
</html>