<?php require_once 'config.php'; ?>
<?php session_start(); ?>

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

<!--Delete Institute...-->
<?php
if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];

    $query = "DELETE FROM tblinstitute WHERE id = $deleteid";
    $q = mysqli_query($connect, $query);
    if (!$q) {
        echo "Error: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Institute - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1>Institute Management</h1>
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

                <!-- Add Institute Button -->
                <div style="margin-bottom: 2rem;">
                    <button class="btn" onclick="window.location.href = 'add-institute.php?academicyear=<?php echo $selectedYear; ?>'">Add Institute</button>
                </div>

                <!-- Institutes List -->
                <div class="card">
                    <h3>All Institutes</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Institute Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tblinstitute WHERE academicyearid = $selectedYear";
                                $q = mysqli_query($connect, $query);

                                if (!$q) {
                                    echo "Error: " . mysqli_error($connect);
                                }

                                $i = 1;
                                while ($r = mysqli_fetch_row($q)) {
                                    echo "<tr>"
                                    . "<td>$i</td>"
                                    . "<td>$r[1]</td>"
                                    . "<td>$r[2]</td>"
                                    . "<td>"
                                    . "<a href='add-institute.php?editid={$r[0]}' class='btn'>Edit</a> "
                                    . "<a href='manage-institute.php?deleteid={$r[0]}' onclick=\"return confirm('Are you sure you want to delete this record?');\" class='btn btn-danger btn-sm'>Delete</a>"
                                    . "</td>"
                                    . "</tr>";
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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
                const dropdown = document.getElementById(dropdownId + '-dropdown');
                dropdown.classList.toggle('show');
            }
        </script>
    </body>
</html>
