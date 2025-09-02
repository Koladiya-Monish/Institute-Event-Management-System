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
        <nav class="sidebar">
            <h3>Admin Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="admin-dashboard.php">Dashboard</a></li>
                <li><a href="institute.php">Manage Institute</a></li>
                <li><a href="department.php">Manage Department</a></li>
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown('users')" class="dropdown-toggle">Manage Users ▼</a>
                    <ul class="dropdown-menu" id="users-dropdown">
                        <li><a href="manage-student.php">Students</a></li>
                        <li><a href="manage-faculty.php" class="active">Faculty</a></li>
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
                <h1>Faculty Management</h1>
                <div>
                    <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>
                    <select id="academicYear" class="form-control" style="width: auto; display: inline-block;">
                        <option value="2024-25" selected>2024-25</option>
                        <option value="2023-24">2023-24</option>
                        <option value="2022-23">2022-23</option>
                    </select>
                </div>
            </div>
            
            <!-- Add Faculty Buttons -->
            <div style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                <button class="btn" onclick="window.location.href='add-faculty.php'">Add Faculty</button>
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
                            <tr>
                                <td>FAC001</td>
                                <td>Dr. John Smith</td>
                                <td>john.smith@faculty.edu</td>
                                <td>Computer Science</td>
                                <td>Professor</td>
                                <td>
                                    <button class="btn" onclick="editFaculty('FAC001')">Edit</button>
                                    <button class="btn" onclick="deleteFaculty('FAC001')">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>FAC002</td>
                                <td>Dr. Sarah Johnson</td>
                                <td>sarah.johnson@faculty.edu</td>
                                <td>Information Technology</td>
                                <td>Associate Professor</td>
                                <td>
                                    <button class="btn" onclick="editFaculty('FAC002')">Edit</button>
                                    <button class="btn" onclick="deleteFaculty('FAC002')">Delete</button>
                                </td>
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
        
        function editFaculty(id) { 
            window.location.href = 'add-faculty.php?id=' + id;
        }
        
        function deleteFaculty(id) {
            if (confirm('Are you sure you want to delete this faculty?')) {
                alert('Faculty deleted successfully!');
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
