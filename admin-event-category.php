<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Event Categories - IEMS</title>
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
                        <li><a href="admin-event-category.php" class="active">Category</a></li>
                        <li><a href="admin-event-subcategory.php">Sub-Category</a></li>
                    </ul>
                </li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <main class="dashboard-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1>Event Category Management</h1>
                <div>
                    <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>
                    <select id="academicYear" class="form-control" style="width: auto; display: inline-block;">
                        <option value="2024-25" selected>2024-25</option>
                        <option value="2023-24">2023-24</option>
                        <option value="2022-23">2022-23</option>
                    </select>
                </div>
            </div>

            <!-- Add Event Category Button -->
            <div style="margin-bottom: 2rem;">
                <button class="btn" onclick="window.location.href='manage-event-category.php'">Add Event Category</button>
            </div>

            <div class="card">
                <h3>All Event Categories</h3>
                <div style="margin-bottom: 1rem;">
                    <input type="text" id="searchCategory" class="form-control" placeholder="Search categories..." style="width: 300px; display: inline-block;">
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sequence No.</th>
                                <th>Category Name</th>
                                <th>Sub-Categories</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Technical Events</td>
                                <td>5</td>
                                <td>
                                    <button class="btn" onclick="editCategory(1)">Edit</button>
                                    <button class="btn" style="background-color: #dc3545; color: white;" onclick="deleteCategory(1)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Cultural Events</td>
                                <td>6</td>
                                <td>
                                    <button class="btn" onclick="editCategory(2)">Edit</button>
                                    <button class="btn" style="background-color: #dc3545; color: white;" onclick="deleteCategory(2)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Sports Events</td>
                                <td>8</td>
                                <td>
                                    <button class="btn" onclick="editCategory(3)">Edit</button>
                                    <button class="btn" style="background-color: #dc3545; color: white;" onclick="deleteCategory(3)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Literary Events</td>
                                <td>4</td>
                                <td>
                                    <button class="btn" onclick="editCategory(4)">Edit</button>
                                    <button class="btn" style="background-color: #dc3545; color: white;" onclick="deleteCategory(4)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Category added successfully!');
            this.reset();
        });
        
        function editCategory(id) {
            window.location.href = 'manage-event-category.php?id=' + id;
        }
        
        function deleteCategory(id) {
            if (confirm('Are you sure you want to delete this category? This will also delete all sub-categories.')) {
                alert('Category deleted successfully!');
            }
        }
        
        function viewSubCategories(id) {
            window.location.href = 'admin-event-subcategory.php?categoryId=' + id;
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
