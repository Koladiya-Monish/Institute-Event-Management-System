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
        <nav class="sidebar">
            <h3>Admin Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="admin-dashboard.php">Dashboard</a></li>
                <li><a href="institute.php" class="active">Manage Institute</a></li>
                <li><a href="department.php">Manage Department</a></li>
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

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1>Institute Management</h1>
                <div>
                    <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>
                    <select id="academicYear" class="form-control" style="width: auto; display: inline-block;">
                        <option value="2024-25" selected>2024-25</option>
                        <option value="2023-24">2023-24</option>
                        <option value="2022-23">2022-23</option>
                    </select>
                </div>
            </div>

            <!-- Add Institute Button -->
            <div style="margin-bottom: 2rem;">
                <button class="btn" onclick="window.location.href='manage-institute.php'">Add Institute</button>
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>ABC Institute of Technology</td>
                                <td>
                                    <button class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; margin-right: 0.5rem;" onclick="editInstitute(1)">Edit</button>
                                    <button class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="deleteInstitute(1)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>XYZ Engineering College</td>
                                <td>
                                    <button class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; margin-right: 0.5rem;" onclick="editInstitute(2)">Edit</button>
                                    <button class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;" onclick="deleteInstitute(2)">Delete</button>
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
        
        document.getElementById('instituteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Institute added successfully!');
            this.reset();
        });
        
        function editInstitute(id) {
            window.location.href = 'manage-institute.php?id=' + id;
        }
        
        function deleteInstitute(id) {
            if (confirm('Are you sure you want to delete this institute?')) {
                alert('Institute deleted successfully!');
            }
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
