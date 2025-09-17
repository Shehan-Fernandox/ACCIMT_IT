<?php
    include 'connection.php';
    session_start();
    $admin_id = $_SESSION['admin_name'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }

    //adding products to dadabase
   if (isset($_POST['add_product'])) {
    $employee_name = mysqli_real_escape_string($conn, $_POST['name']);
    $employee_position = mysqli_real_escape_string($conn, $_POST['position']);
    $employee_detail = mysqli_real_escape_string($conn, $_POST['detail']);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'image/'.$image;

    

    $select_employee_name = mysqli_query($conn, "SELECT name FROM `manage_employee` WHERE name = '$employee_name'") or die('query failed');

    if (mysqli_num_rows($select_employee_name) > 0) {
        $message[] = 'Employee name already exists';
    } elseif ($image_size > 2000000) {
        $message[] = 'Image size is too large (max 2MB)';
    } else {
        $insert_products = mysqli_query($conn,
            "INSERT INTO `manage_employee`(`name`,`position`,`detail`, `image`)
             VALUES ('$employee_name','$employee_position','$employee_detail', '$image')"
        ) or die('query failed');

        if ($insert_products) {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Employee added successfully';
        } else {
            $message[] = 'Failed to add product';
        }
    }
}

//delete products from database
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $select_delete_image = mysqli_query($conn, "SELECT image FROM `manage_employee` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink('image/'.$fetch_delete_image['image']);

    mysqli_query($conn, "DELETE FROM `manage_employee` WHERE id = '$delete_id'") or die('query failed');
    // mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
    // mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');

    header('location:./manage_employee.php');
}

//update product
if(isset($_POST['update_product'])){
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_position = $_POST['update_position'];
    $update_detail = $_POST['update_detail'];
    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder='image/'.$update_image;

    $update_query = mysqli_query($conn, "UPDATE `manage_employee` SET `id`='$update_id', `name`='$update_name', `position`='$update_position', `detail`='$update_detail', `image`='$update_image' WHERE id = '$update_id'") or die('query failed');

    if($update_query){
        move_uploaded_file($update_image_tmp_name,$update_image_folder);
        header('location:manage_employee.php');
        $message[] = 'Employee updated successfully';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_panel</title>
     <!--box icon link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="./assets/css/style.css" class="css">
</head>
<body>
    
    <?php include'admin_header.php' ?>
    <?php
        if(isset($message)){
            foreach($message as $message){
                echo '
                    <div class="message">
                    <span>'.$message.'</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>
                ';
            }
        }
    ?>
    <div class="line2"></div>
    <section class="add-product form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="input-field">
                <label>employee name</label><br>
                <input type="text" name="name" required>
            </div>

            <div class="input-field">
                <label>employee position</label><br>
                <input type="text" name="position" required>
            </div>
            
            <div class="input-field">
                <label>employee detail</label>
                <textarea name="detail" required></textarea>
            </div>

            <div class="input-field">
                <label>employee image</label>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            </div>
            <input type="submit" name="add_product" value="add product" class="btn">
        </form>
    </section>
    
   <div class="line3"></div>
   <div class="line4"></div>
   <section class="show-products">
        <div class="box-container">
            <?php
                $select_employee = mysqli_query($conn, "SELECT * FROM `manage_employee`") or die('query-failed');
                if(mysqli_num_rows($select_employee)>0){
                    while($fetch_employee = mysqli_fetch_assoc($select_employee)){
            ?>
            <div class="box">
                <img src="image/<?php echo $fetch_employee['image'];?>">
               
                <h4><?php echo $fetch_employee['name'];?></h4>
                <h4><?php echo $fetch_employee['position'];?></h4>
                <details><?php echo $fetch_employee['detail'];?></details>
                <a href="manage_employee.php?edit=<?php echo $fetch_employee['id']; ?>" class="edit">edit</a>
                <a href="manage_employee.php?delete=<?php echo $fetch_employee['id']; ?>" class="delete" onclick="return confirm('want to delete this product')">delete</a>
            </div>
            <?php
                  }
                }else{
                        echo '
                             <div class="empty">
                                <p>no products added yet</p>
                            </div>
                        ';
                  }
            ?>
           
        </div>
   </section>
   <div class="line"></div>
   <section class="update-container">
    <?php
        if(isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM `manage_employee` WHERE id = '$edit_id'") or die('query failed');
            if(mysqli_num_rows($edit_query)>0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){

                

    ?>
    <form method="POST" enctype="multipart/form-data">
        <img src="image/<?php echo $fetch_edit['image']; ?>">
        <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
        <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>">
        <input type="text" name="update_position" value="<?php echo $fetch_edit['position']; ?>">
        <textarea name="update_detail"><?php echo $fetch_edit['detail']; ?></textarea>
        <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png, image/webp">
        <input type="submit" name="update_product" value="update" class="edit">
        <input type="button" name="" value="cancel" class="option-btn btn" id="close-form">
    </form>
    <?php
              }
           }
           echo "<script>document.querySelector('.update-container').style.display='block'</script>";

        }
    ?>
   </section>
    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>
</html>
