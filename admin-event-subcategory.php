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
                        <li><a href="manage-faculty.php">Faculty</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown('events')" class="dropdown-toggle">Manage Events ▼</a>
                    <ul class="dropdown-menu show" id="events-dropdown">
                        <li><a href="admin-event-category.php">Category</a></li>
                        <li><a href="admin-event-subcategory.php" class="active">Sub-Category</a></li>
                    </ul>
                </li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <main class="dashboard-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1>Event Sub-Category Management</h1>
                <div>
                    <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>
                    <select id="academicYear" class="form-control" style="width: auto; display: inline-block;">
                        <option value="2024-25" selected>2024-25</option>
                        <option value="2023-24">2023-24</option>
                        <option value="2022-23">2022-23</option>
                    </select>
                </div>
            </div>

            <!-- Add Event Sub-Category Button -->
            <div style="margin-bottom: 2rem;">
                <button class="btn" onclick="window.location.href='manage-event-subcategory.php'">Add Event Sub-Category</button>
            </div>

            <div class="card">
                <h3>All Event Sub-Categories</h3>
                <div style="margin-bottom: 1rem; display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                    <input type="text" id="searchSubCategory" class="form-control" placeholder="Search sub-categories..." style="width: 250px;">
                    <select id="filterCategory" class="form-control" style="width: 200px;">
                        <option value="">All Categories</option>
                        <option value="1">Technical Events</option>
                        <option value="2">Cultural Events</option>
                        <option value="3">Sports Events</option>
                        <option value="4">Literary Events</option>
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
                                <th>Category</th>
                                <th>Sub-Category Name</th>
                                <th>Type</th>
                                <th>Coordinator</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Technical Events</td>
                                <td>Code Marathon</td>
                                <td>Solo</td>
                                <td>Dr. Smith</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                        <button class="btn" onclick="editSubCategory(1)">Edit</button>
                                        <button class="btn" style="background-color: #28a745; color: white;" onclick="assignCoordinator(1)">Assign</button>
                                        <button class="btn" style="background-color: #dc3545; color: white;" onclick="deleteSubCategory(1)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Technical Events</td>
                                <td>Web Development Challenge</td>
                                <td>Group</td>
                                <td>Prof. Johnson</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                        <button class="btn" onclick="editSubCategory(2)">Edit</button>
                                        <button class="btn" style="background-color: #28a745; color: white;" onclick="assignCoordinator(2)">Assign</button>
                                        <button class="btn" style="background-color: #dc3545; color: white;" onclick="deleteSubCategory(2)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Cultural Events</td>
                                <td>Classical Dance Competition</td>
                                <td>Solo</td>
                                <td>Ms. Patel</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                        <button class="btn" onclick="editSubCategory(3)">Edit</button>
                                        <button class="btn" style="background-color: #28a745; color: white;" onclick="assignCoordinator(3)">Assign</button>
                                        <button class="btn" style="background-color: #dc3545; color: white;" onclick="deleteSubCategory(3)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('subCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Sub-category added successfully!');
            this.reset();
        });
        
        function editSubCategory(id) {
            window.location.href = 'manage-event-subcategory.php?id=' + id;
        }
        
        function assignCoordinator(id) {
            window.location.href = 'assign-coordinator.php?subcategoryId=' + id;
        }
        
        function deleteSubCategory(id) {
            if (confirm('Are you sure you want to delete this sub-category?')) {
                alert('Sub-category deleted successfully!');
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
