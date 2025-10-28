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

    $q2 = mysqli_query($connect, "SELECT userid FROM tblstudent WHERE enro = '$deleteid'");
    $query1 = "DELETE FROM tblstudent WHERE enro = '$deleteid'";
    mysqli_query($connect, $query1);

    if ($r = mysqli_fetch_assoc($q2)) {
        $userid = $r['userid'];
        mysqli_query($connect, "DELETE FROM tbluser WHERE id = '$userid'");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Students - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1>Student Management</h1>
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

                <!-- Add Student Buttons -->
                <div style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                    <button class="btn" onclick="window.location.href = 'add-student.php?academicyear=<?php echo $selectedYear; ?>'">Add Student</button>
                    <button class="btn" onclick="showBulkUpload()">Add Students via File</button>
                </div>

                <!-- Bulk Upload Section (Initially Hidden) -->
                <div id="bulkUpload" class="card" style="display: none;">
                    <h3>Upload Students via File</h3>
                    <div class="form-group">
                        <label for="fileUpload">Upload Student File (CSV/Excel)</label>
                        <input type="file" id="fileUpload" class="form-control" accept=".csv,.xlsx,.xls">
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <button class="btn" onclick="uploadFile()">Upload Students</button>
                        <button class="btn btn-secondary" onclick="hideBulkUpload()">Cancel</button>
                    </div>
                </div>
                <br>
                <div class="card">
                    <h3>All Students</h3>
                    <div style="margin-bottom: 1rem;">
                        <input type="text" id="searchStudent" class="form-control" placeholder="Search students..." style="width: 300px; display: inline-block;">
                        <select id="filterDept" class="form-control" style="width: 200px; display: inline-block; margin-left: 1rem;">
                            <option value="">All Departments</option>
                            <option value="1">Computer Science</option>
                            <option value="2">Information Technology</option>
                        </select>
                        <select id="filterSemester" class="form-control" style="width: 200px; display: inline-block; margin-left: 1rem;">
                            <option value="">All Semesters</option>
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                            <option value="3">3rd Semester</option>
                            <option value="4">4th Semester</option>
                            <option value="5">5th Semester</option>
                            <option value="6">6th Semester</option>
                            <option value="7">7th Semester</option>
                            <option value="8">8th Semester</option>
                        </select>
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Enrollment</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Semester</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $query = "SELECT s.enro, u.fname, u.emailid, d.name AS department_name, sem.name AS semester_name, divi.name AS division_name FROM tblstudent s JOIN tbluser u ON s.userid = u.id JOIN tbldepartment d ON u.departmentid = d.id JOIN tblsemesterdivision sd ON s.semdivid = sd.id JOIN tblsemester sem ON sd.semesterid = sem.id JOIN tbldivision divi ON sd.divisionid = divi.id WHERE sd.academicyearid = $selectedYear;";
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
                                        . "<a href='add-student.php?editid={$r[0]}&academicyear={$selectedYear}' class='btn'>Edit</a>"
                                        . "<a href='manage-student.php?deleteid={$r[0]}&academicyear={$selectedYear}' class='btn btn-danger btn-sm'>Delete</a>"
                                        //. "<button class='btn' name='delete'>Delete</button>"
                                        . "</form>"
                                        . "</td>"
                                        . "</tr>";
                                        //. "<td><a href='delete.php?id=$r[0]'>delete</a></td></tr></table>";
                                    }
                                    ?>
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
                alert('Students uploaded successfully!');
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