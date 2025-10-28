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

<?php
if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];

    // 1️⃣ First get the userid BEFORE deleting faculty
    $q2 = mysqli_query($connect, "SELECT userid FROM tblfaculty WHERE id = '$deleteid'");
    if ($q2 && mysqli_num_rows($q2) > 0) {
        $r = mysqli_fetch_assoc($q2);
        $userid = $r['userid'];

        // 2️⃣ Delete faculty first
        $query1 = "DELETE FROM tblfaculty WHERE id = '$deleteid'";
        mysqli_query($connect, $query1);

        // 3️⃣ Then delete the user linked to that faculty
        mysqli_query($connect, "DELETE FROM tbluser WHERE id = '$userid'");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Faculty - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1>Faculty Management</h1>
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

                <!-- Add Faculty Buttons -->
                <div style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                    <button class="btn" onclick="window.location.href = 'add-faculty.php?academicyear=<?php echo $selectedYear; ?>'">Add Faculty</button>
                    <button class="btn" onclick="showBulkUpload()">Add Faculty via File</button>
                </div>

                <!-- Bulk Upload Section (Initially Hidden) -->
                <div id="bulkUpload" class="card" style="display: none;">
                    <h3>Upload Faculties via File</h3>
                    <div class="form-group">
                        <label for="fileUpload">Upload Faculty File (CSV/Excel)</label>
                        <input type="file" id="fileUpload" class="form-control" accept=".csv,.xlsx,.xls">
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <button class="btn" onclick="uploadFile()">Upload Faculty</button>
                        <button class="btn btn-secondary" onclick="hideBulkUpload()">Cancel</button>
                    </div>
                </div>

                <div class="card">
                    <h3>All Faculty</h3>
                    <div style="margin-bottom: 1rem;">
                        <input type="text" id="searchFaculty" class="form-control" placeholder="Search faculty..." style="width: 300px; display: inline-block;">
                        <select id="filterDept" class="form-control" style="width: 200px; display: inline-block; margin-left: 1rem;">
                            <option value="">All Departments</option>
                            <option value="1">Computer Science</option>
                            <option value="2">Information Technology</option>
                        </select>
                        <select id="filterDesignation" class="form-control" style="width: 200px; display: inline-block; margin-left: 1rem;">
                            <option value="">All Designations</option>
                            <option value="professor">Professor</option>
                            <option value="associate">Associate Professor</option>
                            <option value="assistant">Assistant Professor</option>
                            <option value="lecturer">Lecturer</option>
                        </select>
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Faculty ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT f.id AS faculty_id, CONCAT(u.fname, ' ', u.lname) AS full_name, u.emailid AS email, d.name AS department, f.designation FROM tblfaculty f JOIN tbluser u ON f.userid = u.id JOIN tbldepartment d ON u.departmentid = d.id JOIN tblinstitute i ON d.instituteid = i.id JOIN tblacademicyear a ON i.academicyearid = a.id WHERE a.id = '$selectedYear'";
                                $q = mysqli_query($connect, $query);

                                while ($r = mysqli_fetch_row($q)) {
                                    echo "<tr>"
                                    . "<td>$r[0]</td>"
                                    . "<td>$r[1]</td>"
                                    . "<td>$r[2]</td>"
                                    . "<td>$r[3]</td>"
                                    . "<td>$r[4]</td>"
                                    . "<td>"
                                    . "<form method='get'>"
                                    . "<a href='add-faculty.php?editid={$r[0]}' class='btn'>Edit</a>"
                                    . "<a href='manage-faculty.php?deleteid={$r[0]}' onclick=\"return confirm('Are you sure you want to delete this record?');\" class='btn btn-danger btn-sm'>Delete</a>"
                                    . "</form>"
                                    . "</td>"
                                    . "</tr>";
                                }
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

        <script>
            function showBulkUpload() {
                document.getElementById('bulkUpload').style.display = 'block';
            }

            function hideBulkUpload() {
                document.getElementById('bulkUpload').style.display = 'none';
            }

            function uploadFile() {
                alert('Faculty uploaded successfully!');
                hideBulkUpload();
            }
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
