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
        <!-- Sidebar -->
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

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1 id="pageTitle">Add Department</h1>
                <div>
                    <button class="btn btn-secondary" onclick="window.location.href='department.php'">Back to List</button>
                </div>
            </div>

            <!-- Department Form -->
            <div class="card">
                <h3 id="formTitle">Add New Department</h3>
                <form id="departmentForm">
                    <div class="form-group">
                        <label for="deptName">Department Name</label>
                        <input type="text" id="deptName" name="deptName" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="institute">Select Institute</label>
                        <select id="institute" name="institute" class="form-control" required>
                            <option value="">Select Institute</option>
                            <option value="1">ABC Institute of Technology</option>
                            <option value="2">XYZ Engineering College</option>
                        </select>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn" id="submitBtn">Add Department</button>
                    </div>
                </form>
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
        let isEditMode = false;
        let editId = null;

        // Check if we're in edit mode
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            editId = urlParams.get('id');
            
            if (editId) {
                isEditMode = true;
                document.getElementById('pageTitle').textContent = 'Edit Department';
                document.getElementById('formTitle').textContent = 'Edit Department';
                document.getElementById('submitBtn').textContent = 'Update Department';
                
                // Load department data for editing (in real app, this would fetch from database)
                loadDepartmentData(editId);
            }
        };

        function loadDepartmentData(id) {
            // Mock data - in real application, this would fetch from database
            const departments = {
                '1': { name: 'Computer Science', institute: '1' },
                '2': { name: 'Information Technology', institute: '1' }
            };
            
            if (departments[id]) {
                document.getElementById('deptName').value = departments[id].name;
                document.getElementById('institute').value = departments[id].institute;
            }
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            dropdown.classList.toggle('show');
        }
        
        document.getElementById('departmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (isEditMode) {
                alert('Department updated successfully!');
            } else {
                alert('Department added successfully!');
            }
            
            window.location.href = 'department.php';
        });
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
