<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category</h1>

    <br><br>
    <?php 
    // Check
    if (isset($_GET['id'])) {
        // Get the ID
        $id = $_GET['id'];
        // Create SQL Query
        $sql = "SELECT * FROM tbl_category WHERE id=$id";
        // Execute Query
        $res = mysqli_query($conn, $sql);
        // Count Rows
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            // Get all the data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        } else {
            // Redirect to manage category
            $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
    } else {
        // Redirect
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Title:</td>
          <td>
            <input type="text" name="title" value="<?php echo $title; ?>">
          </td>
        </tr>
        <tr>
          <td>Current Image:</td>
          <td>
            <?php  
            if ($current_image != "") {
                // Display image
                ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                <?php
            } else {
                // Display message
                echo "<div class='error'>Image Not Added.</div>";
            }
            ?>
          </td>
        </tr>
        <tr>
          <td>New Image:</td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>
        <tr>
          <td>Featured:</td>
          <td>
            <input <?php if ($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
            <input <?php if ($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No
          </td>
        </tr>
        <tr>
          <td>Active:</td>
          <td>
            <input <?php if ($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
            <input <?php if ($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No"> No
          </td>
        </tr>
        <tr>
          <td>
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        // 1.Get all the values
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        //2.update image
            if (isset($_FILES['image']['name']))
            {
                 $image_name= $_FILES['image']['name'];
                 if($image_name != "")
                 {
                       //image avail

                       //upload image
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
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    
                    // Stop the process
                    die();
                }
            
                       // remove current image
                       if($current_image!="")
                     {

                       $remove_path = "../images/category/".$current_image ;
                       $remove=unlink($remove_path);
                       //check 
                       if($remove==false){
                        $_SESSION['failed-remove']="<div class= 'error'>Failed to remove current Image.</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        die();
                       }
                    }

                 }
            }else
            {
              $image_name=$current_image;
            }

        // 3. Update the database
        $sql2 = "UPDATE tbl_category SET
            title = '$title',
            image_name='$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id = $id";

        // Execute the query
        $res2 = mysqli_query($conn, $sql2);

        // 4. Redirect to manage category
        if ($res2 == true) {
            // Category updated
            $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');    
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');  
        }
    }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>

