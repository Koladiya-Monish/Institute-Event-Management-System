<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php
// Get current or selected year
if (isset($_GET['academicyearid'])) {
    $selectedYear = $_GET['academicyearid'];
}

?>

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
        <title>Manage Event Sub-Categories - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <?php include_once 'admin_navbar.php'; ?>

            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1>Event Sub-Category Management</h1>
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

                <!-- Add Event Sub-Category Button -->
                <div style="margin-bottom: 2rem;">
                    <button class="btn" onclick="window.location.href = 'add-event-subcategory.php?academicyear=<?php echo $selectedYear; ?>'">Add Event Sub-Category</button>
                </div>

                <div class="card">
                    <h3>All Event Sub-Categories</h3>
                    <div style="margin-bottom: 1rem; display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                        <input type="text" id="searchSubCategory" class="form-control" placeholder="Search sub-categories..." style="width: 250px;">
                        <select id="filterCategory"class="form-control" style="width: 200px;" required>
                            <option>All Categories</option>
                            <?php
                            $academicyearid = $_GET['academicyear'] ?? '';

                            $query = "SELECT id, name FROM tbleventcatagory WHERE academicyearid = '$selectedYear' ORDER BY name ASC";
                            $result = mysqli_query($connect, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                }
                            } else {
                                echo "<option value=''>No categories available</option>";
                            }
                            ?>
                        </select>
                        <select id="filterType" class="form-control" style="width: 150px;">
                            <option value="">All Types</option>
                            <option value="solo">Solo</option>
                            <option value="group">Group</option>
                        </select>
                        <select id="filterCoordinator" class="form-control" style="width: 200px;">
                            <option value="">All Coordinators</option>
                            <option value="Dr. Smith">Dr. Smith</option>
                            <option value="Prof. Johnson">Prof. Johnson</option>
                            <option value="Ms. Patel">Ms. Patel</option>
                        </select>
                        <select id="filterStatus" class="form-control" style="width: 150px;">
                            <option value="">All Status</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Category</th>
                                    <th>Sub-Category Name</th>
                                    <th>Type</th>
                                    <th>Coordinator</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // ✅ Query to get all event subcategories with category, coordinator, and academic year
                                $query = "SELECT s.id AS subcat_id, s.name AS subcat_name, s.type, s.status, c.name AS category_name, CONCAT(u.fname, ' ', u.lname) AS coordinator_name FROM tbleventsubcatagory AS s JOIN tbleventcatagory AS c ON s.eventcatagoryid = c.id LEFT JOIN tbleventcordinator AS ec ON s.id = ec.eventsubcatagoryid LEFT JOIN tblfaculty AS f ON ec.facultyid = f.id LEFT JOIN tbluser AS u ON f.userid = u.id WHERE c.academicyearid = $selectedYear ORDER BY c.name, s.name;";

                                $q = mysqli_query($connect, $query);

                                if (!$q) {
                                    die("<tr><td colspan='7'>❌ Query failed: " . mysqli_error($connect) . "</td></tr>");
                                }

                                if (mysqli_num_rows($q) == 0) {
                                    echo "<tr><td colspan='7'>No subcategories found for this academic year.</td></tr>";
                                } else {
                                    $i = 1;
                                    while ($r = mysqli_fetch_assoc($q)) {
                                        echo "<tr>
                                                <td>{$i}</td>
                                                <td>{$r['category_name']}</td>
                                                <td>{$r['subcat_name']}</td>
                                                <td>{$r['type']}</td>
                                                <td>" . (!empty($r['coordinator_name']) ? $r['coordinator_name'] : '—') . "</td>
                                                <td>{$r['status']}</td>
                                                <td>";
                                        
                                                    if (empty($r['coordinator_name'])) {
                                                        echo "<a href='assign-coordinator.php?subcatid={$r['subcat_id']}&academicyearid={$selectedYear}' class='btn btn-primary btn-sm'>Assign</a>";
                                                    } else {
                                                        echo "<a href='assign-coordinator.php?subcatid={$r['subcat_id']}&academicyearid={$selectedYear}' class='btn btn-warning btn-sm'>Reassign</a>";
                                                    }
                                                    
                                                    echo "<a href='add-event-subcategory.php?editid={$r['subcat_id']}&academicyear={$selectedYear}' class='btn'>Edit</a>"
                                                    . "<a href='manage-event-subcategory.php?deleteid={$r['subcat_id']}&academicyear={$selectedYear}' onclick=\"return confirm('Are you sure you want to delete this record?');\" class='btn btn-danger btn-sm'>Delete</a>"
                                                . "</td>"
                                            . "</tr>";
                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

        <script>
            function toggleDropdown(dropdownId) {
                const dropdown = document.getElementById(dropdownId + '-dropdown');
                dropdown.classList.toggle('show');
            }
        </script>

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
    </body>
</html>
