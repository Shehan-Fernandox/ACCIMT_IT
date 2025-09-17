<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dromex - home page</title>
<!---------------------------------boostrapicon cdn link--------------------------------------->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.min.css" class="css">
<!---------------------------------slick slider link--------------------------------------->
<link rel="stylesheet" href="slick.css" class="css">
<!---------------------------------defaulit css link--------------------------------------->
<link rel="stylesheet" href="./assets/css/display.css" class="css">
</head>
<body>
    <section class="popular-brands">
        <h2>Our Team</h2>
        <h5>Arthur C Clarke Institute for Modern Technologies</h5>
        <div class="controls">
        <i class="bi bi-chevron-left left"></i>
        <i class="bi bi-chevron-right right"></i>
    </div>
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
    
    <div class="popular-brands-content">
        <?php
            $select_employee = mysqli_query($conn, "SELECT * FROM `manage_employee`") or die('query failed');
            if(mysqli_num_rows($select_employee)>0){
                while($fetch_employee = mysqli_fetch_assoc($select_employee)){

        ?>
        
        <form method="post" class="card">
            <img src="image/<?php echo $fetch_employee['image']; ?>">
            
            <div class="names"><?php echo $fetch_employee['name']; ?> </div>
            <div class="position"><?php echo $fetch_employee['position']; ?> </div>
            <input type="hidden" name="employee_id" value="<?php echo $fetch_employee['id']; ?>">
            <input type="hidden" name="employee_name" value="<?php echo $fetch_employee['name']; ?>">
            <input type="hidden" name="employee_position" value="<?php echo $fetch_employee['position']; ?>">
            <input type="hidden" name="employee_image" value="<?php echo $fetch_employee['image']; ?>">
            
           <div>
            <button>View </button>
           </div>
        </form>
        
        
        <?php
            
                }
            }else{
                echo '<p class="empty">no products added yet!</p>';
            }
        ?>
    </div>
    </section>

    <script src="jquery.js"></script>
    <script src="slick.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script type="text/javascript">
    $(document).ready(function(){
        $('.popular-brands-content').slick({
            lazyLoad: 'ondemand',
            slidesToShow: 4,
            slidesToScroll: 1,
            nextArrow: $('.right'),
            prevArrow: $('.left'),
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>



</body>
</html>