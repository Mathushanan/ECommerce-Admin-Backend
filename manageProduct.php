
<?php



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emerald</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css\all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/slider-styles.css?v=<?php echo time(); ?>">
</head>

<body>


    <nav>
        <div class="nav__logo"><span id="uni">Emerald</span><span id="nest">Shop</span></span></div>
        <ul class="nav__links">
            <li class="link"><a href="index.php">Home</a></li>
            <li class="link"><a href="manageCategory.php">Categories</a></li>

        </ul>
    </nav>






    <section class="section__container buttons__container">
        <div class="webadmin_dashboard_buttons_container">
            <a href="addCategory.php"><button class="big-button">Add New Product</button></a>
            <a href="updateCategory.php"><button class="big-button">Update Product</button></a>
            <a href="deleteCategory.php"><button class="big-button">Delete Product</button></a>
            
        </div>

    </section>






























</body>

</html>