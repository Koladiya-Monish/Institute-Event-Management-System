<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <nav class="sidebar">
                <h3>Admin Portal</h3>
                <ul class="sidebar-menu">
                    <li><a href="admin-dashboard.php" class="<?= ($current_page == 'admin-dashboard.php') ? 'active' : '' ?>">Dashboard</a></li>
                    <li><a href="manage-academic-year.php" class="<?= ($current_page == 'manage-academic-year.php') ? 'active' : '' ?>">Manage Academic Year</a></li>
                    <li><a href="manage-institute.php" class="<?= ($current_page == 'manage-institute.php') ? 'active' : '' ?>">Manage Institute</a></li>
                    <li><a href="manage-department.php" class="<?= ($current_page == 'manage-department.php') ? 'active' : '' ?>">Manage Department</a></li>
                    <li class="dropdown">
                        <a href="#" onclick="toggleDropdown('users')" class="dropdown-toggle <?= ($current_page == 'manage-student.php' || $current_page == 'manage-faculty.php') ? 'active' : '' ?>">Manage Users ▼</a>
                        <ul class="dropdown-menu" id="users-dropdown">
                            <li><a href="manage-student.php" class="<?= ($current_page == 'manage-student.php') ? 'active' : '' ?>">Students</a></li>
                            <li><a href="manage-faculty.php" class="<?= ($current_page == 'manage-faculty.php') ? 'active' : '' ?>">Faculty</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" onclick="toggleDropdown('events')" class="dropdown-toggle <?= ($current_page == 'manage-event-category.php' || $current_page == 'manage-event-subcategory.php') ? 'active' : '' ?>">Manage Events ▼</a>
                        <ul class="dropdown-menu" id="events-dropdown">
                            <li><a href="manage-event-category.php" class="<?= ($current_page == 'manage-event-category.php') ? 'active' : '' ?>">Category</a></li>
                            <li><a href="manage-event-subcategory.php" class="<?= ($current_page == 'manage-event-subcategory.php') ? 'active' : '' ?>">Sub-Category</a></li>
                        </ul>
                    </li>
                    <li><a href="feedback.php">Feedback</a></li>
                    <li><a href="reports.php">Reports</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
    </body>
</html>
