<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--box icon link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="./assets/css/style.css" class="css">
</head>

<body>
    <header class="header">
        <div class="flex">
            <a href="admin_panel.php" class="logo"><img src=""></a>
            <nav class="navbar">
                <a href="admin_panel.php">home</a>
                <a href="./manage_employee.php">employee</a>
                <a href="admin_order.php">footer</a>
                <a href="admin_user.php">users</a>
                <a href="admin_message.php">messages</a>
            </nav>
            <div class="icons">
                <i class="bi bi-list" id="menu-btn"></i>
                <i class="bi bi-person" id="user-btn"></i>


            </div>
            <div class="user-box">
                

                <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <form method="post">
                    <button type="submit" name="logout" class="logout-btn">log out</button>

                </form>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
            <p>Arthur C Clarke Institute for Modern Technologies</p>
        </div>
    </div>
    <div class="line"></div>
    <script src="./script.js"></script>
    
</body>

</html>