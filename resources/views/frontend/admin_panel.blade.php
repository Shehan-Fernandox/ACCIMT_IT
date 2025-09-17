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
?>

</style>
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
    <?php include 'admin_header.php';?>
    <div class="line4"></div>
    <section class="dashboard">
        <div class="box-container">
           
            
            <div class="box">
                <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                    $num_of_users = mysqli_num_rows($select_users)
                ?>
                <h3><?php echo $num_of_users;?></h3>
                <p>total normal users</p>
            </div>
            <div class="box">
                <?php
                    $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                    $num_of_admin = mysqli_num_rows($select_admin)
                ?>
                <h3><?php echo $num_of_admin;?></h3>
                <p>total admins</p>
            </div>
            <div class="box">
                <?php
                    $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                    $num_of_admin = mysqli_num_rows($select_admin)
                ?>
                <h3><?php echo $num_of_admin;?></h3>
                <p>total registered users</p>
            </div>
             
        </div>
    </section>
    <!--<div class="" style="height: 100vh;"></div>-->
    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>
</html>
