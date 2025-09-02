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
                <h1 id="pageTitle">Add Institute</h1>
                <div>
                    <button class="btn btn-secondary" onclick="window.location.href='institute.php'">Back to List</button>
                </div>
            </div>

            <!-- Institute Form -->
            <div class="card">
                <h3 id="formTitle">Add New Institute</h3>
                <form id="instituteForm">
                    <div class="form-group">
                        <label for="instituteName">Institute Name</label>
                        <input type="text" id="instituteName" name="instituteName" class="form-control" required>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn" id="submitBtn">Add Institute</button>
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
                document.getElementById('pageTitle').textContent = 'Edit Institute';
                document.getElementById('formTitle').textContent = 'Edit Institute';
                document.getElementById('submitBtn').textContent = 'Update Institute';
                
                // Load institute data for editing (in real app, this would fetch from database)
                loadInstituteData(editId);
            }
        };

        function loadInstituteData(id) {
            // Mock data - in real application, this would fetch from database
            const institutes = {
                '1': 'ABC Institute of Technology',
                '2': 'XYZ Engineering College'
            };
            
            if (institutes[id]) {
                document.getElementById('instituteName').value = institutes[id];
            }
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            dropdown.classList.toggle('show');
        }
        
        document.getElementById('instituteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (isEditMode) {
                alert('Institute updated successfully!');
            } else {
                alert('Institute added successfully!');
            }
            
            window.location.href = 'institute.php';
        });
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
