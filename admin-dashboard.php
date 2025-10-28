<?php require_once 'config.php'; ?>

<?php
//1.1️⃣ Get current calendar year
$currentYear = date('Y');

//2.2️⃣ Check if current year exists in tblacademicyear
$currentYearQuery = mysqli_query($connect, "SELECT id FROM tblacademicyear WHERE year = '$currentYear' LIMIT 1");

//3.3️⃣ If current year exists, use it — else use the latest year
if (mysqli_num_rows($currentYearQuery) > 0) {
    $yearData = mysqli_fetch_assoc($currentYearQuery);
    $selectedYear = $yearData['id'];
} else {
    $latestYearQuery = mysqli_query($connect, "SELECT id FROM tblacademicyear ORDER BY year DESC LIMIT 1");
    $latest = mysqli_fetch_assoc($latestYearQuery);
    $selectedYear = $latest['id'];
}

//4.4️⃣ Allow manual override from dropdown
if (isset($_GET['academicyearid'])) {
    $selectedYear = $_GET['academicyearid'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <!-- Academic Year Selection -->
                <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h1>Admin Dashboard</h1>
                        <p style="color: #666;">Manage institute events and system administration</p>
                    </div>
                    <div>
                        <form method="get" id="yearForm" style="display:inline;">
                            <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>
                            <select id="academicYear" name="academicyearid" class="form-control" style="width: auto; display: inline-block;" onchange="document.getElementById('yearForm').submit();">
                                <?php
                                $query = "SELECT * FROM tblacademicyear";
                                $q = mysqli_query($connect, $query);

                                while ($a = mysqli_fetch_assoc($q)) {
                                    $isSelected = ($a['id'] == $selectedYear) ? 'selected' : '';
                                    echo "<option value='{$a['id']}' $isSelected>{$a['year']}</option>";
                                }
                                ?>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="stats-grid">
                    <a href="manage-student.php?academicyearid=<?php echo $selectedYear; ?>" class="stat-card" style="text-decoration:none; color:inherit;">
                        <?php
                        $query = "SELECT COUNT(DISTINCT s.enro) AS total_students FROM tblstudent s JOIN tblsemesterdivision sd ON s.semdivid = sd.id WHERE sd.academicyearid = $selectedYear";
                        $q = mysqli_query($connect, $query);

                        if ($q) {
                            $row = mysqli_fetch_assoc($q);
                            echo "<div class='stat-number'>" . $row['total_students'] . "</div>";
                        } else {
                            echo "Error: " . mysqli_error($connect);
                        }
                        ?>
                        <div class="stat-label">Total Students</div>
                    </a>
                    <a href="manage-faculty.php?academicyearid=<?php echo $selectedYear; ?>" class="stat-card" style="text-decoration:none; color:inherit;">
                        <?php
                        $query = "SELECT COUNT(DISTINCT f.id) AS total_faculty FROM tblfaculty f JOIN tbluser u ON f.userid = u.id JOIN tbldepartment d ON u.departmentid = d.id JOIN tblinstitute i ON d.instituteid = i.id WHERE i.academicyearid = $selectedYear";
                        $q = mysqli_query($connect, $query);

                        if ($q) {
                            $row = mysqli_fetch_assoc($q);
                            echo "<div class='stat-number'>" . $row['total_faculty'] . "</div>";
                        } else {
                            echo "Error: " . mysqli_error($connect);
                        }
                        ?>
                        <div class="stat-label">Total Faculty</div>
                    </a>
                    <a href="manage-event-category.php?academicyearid=<?php echo $selectedYear; ?>" class="stat-card" style="text-decoration:none; color:inherit;">
                        <?php
                        $query = "SELECT COUNT(DISTINCT id) AS total_categories FROM tbleventcatagory WHERE academicyearid = $selectedYear";
                        $q = mysqli_query($connect, $query);

                        if ($q) {
                            $row = mysqli_fetch_assoc($q);
                            echo "<div class='stat-number'>" . $row['total_categories'] . "</div>";
                        } else {
                            echo "Error: " . mysqli_error($connect);
                        }
                        ?>
                        <div class="stat-label">Total Event Categories</div>
                    </a>
                    <a href="manage-event-subcategory.php?academicyearid=<?php echo $selectedYear; ?>" class="stat-card" style="text-decoration:none; color:inherit;">
                        <?php
                        $query = "SELECT COUNT(DISTINCT esc.id) AS total_subcategories FROM tbleventsubcatagory esc JOIN tbleventcatagory ec ON esc.eventcatagoryid = ec.id WHERE ec.academicyearid = $selectedYear";
                        $q = mysqli_query($connect, $query);

                        if ($q) {
                            $row = mysqli_fetch_assoc($q);
                            echo "<div class='stat-number'>" . $row['total_subcategories'] . "</div>";
                        } else {
                            echo "Error: " . mysqli_error($connect);
                        }
                        ?>
                        <div class="stat-label">Total Event Sub Categories</div>
                    </a>
                </div>


            </main>
        </div>

        <style>
            .dropdown {
                position: relative;
            }

            .dropdown-toggle {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .dropdown-menu {
                display: none;
                list-style: none;
                margin: 0.5rem 0 0 1rem;
                padding: 0;
            }

            .dropdown-menu.show {
                display: block;
            }

            .dropdown-menu li {
                margin-bottom: 0.25rem;
            }

            .dropdown-menu a {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        </style>

        <script>
            function toggleDropdown(dropdownId) {
                // Close all other dropdowns first
                const allDropdowns = document.querySelectorAll('.dropdown-menu');
                allDropdowns.forEach(dropdown => {
                    if (dropdown.id !== dropdownId + '-dropdown') {
                        dropdown.classList.remove('show');
                    }
                });

                // Toggle the clicked dropdown
                const dropdown = document.getElementById(dropdownId + '-dropdown');
                dropdown.classList.toggle('show');
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function (event) {
                if (!event.target.closest('.dropdown')) {
                    const allDropdowns = document.querySelectorAll('.dropdown-menu');
                    allDropdowns.forEach(dropdown => {
                        dropdown.classList.remove('show');
                    });
                }
            });

            // Prevent dropdown toggle from closing when clicking inside dropdown
            document.addEventListener('DOMContentLoaded', function () {
                const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
                dropdownToggles.forEach(toggle => {
                    toggle.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    });
                });
            });

            function logout() {
                localStorage.removeItem('userLoggedIn');
                localStorage.removeItem('userRole');
                window.location.href = 'home.php';
            }

            // Set user as logged in for demo
            localStorage.setItem('userLoggedIn', 'true');
            localStorage.setItem('userRole', 'admin');
        </script>
    </body>
</html>
