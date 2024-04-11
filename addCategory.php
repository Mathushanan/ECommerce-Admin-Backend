<?php

include("config.php");

$query = "SELECT id, name, parentId FROM categories";
$result = mysqli_query($connection, $query);


$categories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}



function buildMenu($categories, $parent_id = 0, $level = 0)
{
    $html = '<ul>';
    foreach ($categories as $category) {
        if ($category['parentId'] == $parent_id) {
            $html .= '<li style="padding-left: ' . (20 * $level) . 'px;"><a href="#" onclick="toggleSubMenu(' . $category['id'] . ')">' . $category['name'] . '</a>';

            $html .= '<ul id="submenu_' . $category['id'] . '" style="display:none;">';
            $html .= buildMenu($categories, $category['id'], $level + 1);
            $html .= '</ul>';
            $html .= '</li>';
        }
    }
    $html .= '</ul>';
    return $html;
}


$navMenu = buildMenu($categories);
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




</head>

<body>
    <button id="toggleButton">Toggle Sidebar</button> <!-- Button to toggle sidebar -->


    <!-- Main content container -->
    <div class="main-content">

        <section class="section__container buttons__container">
            <div class="webadmin_dashboard_buttons_container">
                <div class="webadmin_dashboard_accommodation_container">

                    <nav id="sidebar">
                        <?php echo $navMenu; ?>
                    </nav>
                </div>
                <a href="addCategory.php"><button class="big-button">Add New Category</button></a>
            </div>
        </section>







     
    </div> <!-- End of main content container -->

    <script>
        function toggleSidebar() {
            var nav = document.querySelector('nav');
            var mainContent = document.querySelector('.main-content');

            nav.classList.toggle('open');
            mainContent.classList.toggle('shifted');
        }

        function toggleSubMenu(categoryId) {
            var submenu = document.getElementById('submenu_' + categoryId);
            if (submenu.style.display === 'none') {
                submenu.style.display = 'block';
            } else {
                submenu.style.display = 'none';
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.add("open");
        });
    </script>
</body>

</html>