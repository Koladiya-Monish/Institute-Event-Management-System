<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Department - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h3>Admin Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="admin-dashboard.php">Dashboard</a></li>
                <li><a href="institute.php">Manage Institute</a></li>
                <li><a href="department.php" class="active">Manage Department</a></li>
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown('users')" class="dropdown-toggle">Manage Users ▼</a>
                    <ul class="dropdown-menu" id="users-dropdown">
                        <li><a href="manage-student.php">Students</a></li>
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

        <main class="dashboard-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1>Department Management</h1>
                <div>
                    <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>
                    <select id="academicYear" class="form-control" style="width: auto; display: inline-block;">
                        <option value="2024-25" selected>2024-25</option>
                        <option value="2023-24">2023-24</option>
                        <option value="2022-23">2022-23</option>
                    </select>
                </div>
            </div>
            
            <!-- Add Department Button -->
            <div style="margin-bottom: 2rem;">
                <button class="btn" onclick="window.location.href='manage-department.php'">Add Department</button>
            </div>

            <div class="card">
                <h3>All Departments</h3>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Department Name</th>
                                <th>Institute</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Computer Science</td>
                                <td>ABC Institute of Technology</td>
                                <td>
                                    <button class="btn" onclick="editDept(1)">Edit</button>
                                    <button class="btn" onclick="deleteDept(1)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Information Technology</td>
                                <td>ABC Institute of Technology</td>
                                <td>
                                    <button class="btn" onclick="editDept(2)">Edit</button>
                                    <button class="btn" onclick="deleteDept(2)">Delete</button>
                                </td>
                            </tr>
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
        
        document.getElementById('deptForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Department added successfully!');
            this.reset();
        });
        
        function editDept(id) { window.location.href = 'manage-department.php?id=' + id; }
        function deleteDept(id) { if(confirm('Delete?')) alert('Deleted!'); }
        function logout() { window.location.href = 'home.php'; }
    </script>
</body>
</html>
