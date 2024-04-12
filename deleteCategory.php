<?php

include("config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $parentId = $_POST["parent_id"];

    $query = "DELETE FROM categories WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($stmt, "i", $parentId);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $success = "Category deleted successfully";
    } else {
        $error = "Failed to delete category";
    }

    mysqli_stmt_close($stmt);
}

var_dump($_POST);


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
            $html .= '<li style="padding-left: ' . (20 * $level) . 'px;"><a href="#" onclick="toggleSubMenu(' . $category['id'] . ')">' . $category['name'] . ' <i class="fa-solid fa-caret-down"></i></a>';

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


    <div class="main-content">

        <section class="section__container buttons__container">


            <div class="nav" id="sidebar">
                <?php echo $navMenu; ?>
            </div>

            <div class="box">
                <h2>Delete Category</h2>

                <?php if (isset($error)) { ?>
                    <p class="message" style="color: red;"><?php echo $error; ?></p>
                <?php } ?>

                <?php if (isset($success)) { ?>
                    <p class="message" style="color: green;"><?php echo $success; ?></p>
                <?php } ?>

                <form method="post">

                    <div class="field input">
                        <label for="parent_id">Parent Category</label><br>
                   

                    <select id="parent_id" name="parent_id">

                        <?php
                        function buildCategoryOptions($categories, $parent_id = 0, $prefix = '')
                        {
                            global $connection;
                            $html = '';
                            foreach ($categories as $category) {
                                if ($category['parentId'] == $parent_id) {
                                    $category_name = $prefix . $category['name'];
                                    $html .= '<option value="' . $category['id'] . '">' . $category_name . '</option>';
                                    $html .= buildCategoryOptions($categories, $category['id'], $category_name . '-');
                                }
                            }
                            return $html;
                        }

                        $query = "SELECT id, name, parentId FROM categories";
                        $result = mysqli_query($connection, $query);
                        $all_categories = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $all_categories[] = $row;
                        }

                        echo buildCategoryOptions($all_categories);
                        ?>
                    </select>

                    </div>

                    

                    <input type="submit" value="Add Category" class="btn">
                </form>
                <br>
                <a href="manageCategory.php">Back to Dashboard</a>
            </div>

        </section>








    </div>

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