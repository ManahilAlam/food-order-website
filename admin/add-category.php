<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }


        ?>
        <br><br>

        <!--Add category form start-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Category Title"></td>
                </tr>
                <tr>
                    <td>
                        Select Image: 
                    </td>
                    <td>
                        <input type="file" name= "image">
                    </td>
                </tr>
                <tr>

                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!--Add category form end-->

        <?php
        // Process the form submission
        if (isset($_POST['submit'])) {
            // Get values from the form
            $title = $_POST['title'];

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } 
            else 
            {
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else 
            {
                $active = "No";
            }


            //check the whether the images slected or donot
            //print_r($_FILES['image']); 

            //die(); here

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") 
            {
                // Get image details
                $image_name = $_FILES['image']['name'];

                // Auto rename our image 
                // Get the extension of our image (jpg,png)

                $ext = end(explode('.', $image_name));

                //rename img
                $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                $source_path = $_FILES['image']['tmp_name'];
            
                // Define destination path
                $destination_path = "../images/category/" . $image_name;
            
                // Upload the image
                $upload = move_uploaded_file($source_path, $destination_path);
            
                // Check if the image was uploaded successfully
                if ($upload == false)
                 {
                    // Set an error message
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                    
                    // Redirect to the add category page
                    header('location:' . SITEURL . 'admin/add-category.php');
                    
                    // Stop the process
                    die();
                }
            } else {
                // If no image is selected, set image name to empty
                $image_name = "";
            }
            
            // 2.SQL query to insert category
            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'";

            // 3.Execute the query
            $res = mysqli_query($conn, $sql);

            // 4.Check whether the query was successful
            if ($res == true) {
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>
<?php
include('partials/footer.php');
?>
