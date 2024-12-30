<html>
<head>
    <title>Food Order Website - Manage Admin Page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <?php include('partials/menu.php'); ?>

    <div class='main-content'>
        <div class='wrapper'>
            <h1>Manage Admin</h1>
            <br><br>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']); // Remove once it is displayed one time
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']); // Remove once it is displayed one time
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']); // Remove once it is displayed one time
            }
            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']); // Remove once it is displayed one time
            }
            if (isset($_SESSION['password-not-matched'])) {
                echo $_SESSION['password-not-matched'];
                unset($_SESSION['password-not-matched']); // Remove once it is displayed one time
            }
            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']); // Remove once it is displayed one time
            }
            ?>
            <br><br>

            <!-- Button to add admin -->
            <a href="add-admin.php" class='btn-primary'>
                Add Admin
            </a>
            <br><br><br>

            <table class='tbl-full'>
                <tr>
                    <th>S.NO</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Display data into website from database
                $sql = 'SELECT * FROM tbl_admin';
                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Check if query executed or not
                if ($res == TRUE) {
                    // Count rows to check
                    $count = mysqli_num_rows($res); // Get all rows from DB, fetch
                    $sn = 1; // For numbering rows

                    // Check number of rows
                    if ($count > 0) {
                        // Data in DB
                        while ($rows = mysqli_fetch_assoc($res)) { // Will run until data in DB
                            // Get individual data
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            // Display values in table
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class='btn-primary'>Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class='btn-secondary'>Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class='btn-danger'>Delete Admin</a>  
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // No data in DB
                        ?>
                        <tr>
                            <td colspan="4">No Admins Added Yet.</td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <?php include("partials/footer.php"); ?>
</body>
</html>
