<?php require_once 'config.php'; ?>

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
        <nav class="sidebar">
            <h3>Admin Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="admin-dashboard.php">Dashboard</a></li>
                <li><a href="institute.php">Manage Institute</a></li>
                <li><a href="department.php">Manage Department</a></li>
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown('users')" class="dropdown-toggle">Manage Users ▼</a>
                    <ul class="dropdown-menu" id="users-dropdown">
                        <li><a href="manage-student.php" class="active">Students</a></li>
                        <li><a href="manage-faculty.php">Faculty</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown('events')" class="dropdown-toggle">Manage Events ▼</a>
                    <ul class="dropdown-menu" id="events-dropdown">
                        <li><a href="admin-event-category.php">Category</a></li>
                        <li><a href="admin-event-subcategory.php">Sub-Category</a></li>
                    </ul>
                </li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1>Student Management</h1>
                <div>
                    <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>
                    <select id="academicYear" class="form-control" style="width: auto; display: inline-block;">
                        <option value="2024-25" selected>2024-25</option>
                        <option value="2023-24">2023-24</option>
                        <option value="2022-23">2022-23</option>
                    </select>
                </div>
            </div>
            
            <!-- Add Student Buttons -->
            <div style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                <button class="btn" onclick="window.location.href='add-student.php'">Add Student</button>
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
                        <?php
                        
                        ?>
                        <tbody>
                            <tr>
                            <?php
                            $query = "SELECT s.enro, u.fname, u.emailid, d.name, sem.name FROM tblstudent s JOIN tbluser u ON s.userid=u.id JOIN tbldepartment d ON u.departmentid=d.id JOIN tblsemester sem ON s.semesterid=sem.id";
                            $q = mysqli_query($connect, $query);                            
                            
                            while ($r = mysqli_fetch_row($q))
                            {
                                echo "<tr>"
                                    . "<td>$r[0]</td>"
                                    . "<td>$r[1]</td>"
                                    . "<td>$r[2]</td>"
                                    . "<td>$r[3]</td>"
                                    . "<td>$r[4]</td>"
                                    . "<td>"
                                        . "<button class='btn'>Edit</button>"
                                        . "<button class='btn'>Delete</button>"
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
        
        function editStudent(id) { 
            window.location.href = 'add-student.php?id=' + id;
        }
        
        function deleteStudent(id) {
            if (confirm('Are you sure you want to delete this student?')) {
                alert('Student deleted successfully!');
            }
        }
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            dropdown.classList.toggle('show');
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
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
