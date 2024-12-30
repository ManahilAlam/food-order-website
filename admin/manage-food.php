<html>
    <head>
    <title>Food Order Website-manage category page</title>
    <link rel="stylesheet" href="../css/admin.css">

<body>
<?php include('partials/menu.php');?>

    <div class='main content'>
        <div class='wrapper'>
            <h1>Manage Food</h1> 
            <br>
             <a href="<?php echo SITEURL; ?>admin/add-food.php" class='btn-primary'>
                Add Food
             </a>
             <br><br><br>
             

             <?php  
             
               if(isset($_SESSION['add']))
               {
                echo$_SESSION['add'];
                unset($_SESSION['add']);
               }

             ?>


            <table class='tbl-full'>
                <tr>
                    <th>S.NO</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td>1. </td>
                    <td>Manahil Alam</td>
                    <td>manahilalam18</td>
                    <td>
                        <a href="#" class='btn-secondary'>Update Admin</a>
                        <a href="#" class='btn-danger'>Delete Admin</a>
                        
                    </td>
                </tr>
                <tr>
                    <td>2. </td>
                    <td>Manahil Alam</td>
                    <td>manahilalam18</td>
                    <td>
                    <a href="#" class='btn-secondary'>Update Admin</a>
                    <a href="#" class='btn-danger'>Delete Admin</a>
                    </td>
                </tr>
                <tr>
                    <td>3. </td>
                    <td>Manahil Alam</td>
                    <td>manahilalam18</td>
                    <td>
                    <a href="#" class='btn-secondary'>Update Admin</a>
                    <a href="#" class='btn-danger'>Delete Admin</a>
                    </td>
                </tr>
            </table>

        </div>
    </div>

<?php include("partials/footer.php")?>
</body>
    
</html>