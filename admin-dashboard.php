<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h3>Admin Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="admin-dashboard.php" class="active">Dashboard</a></li>
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
                    <ul class="dropdown-menu" id="events-dropdown">
                        <li><a href="admin-event-category.php">Category</a></li>
                        <li><a href="admin-event-subcategory.php">Sub-Category</a></li>
                    </ul>
                </li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="dashboard-content">
            <!-- Academic Year Selection -->
            <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1>Admin Dashboard</h1>
                    <p style="color: #666;">Manage institute events and system administration</p>
                </div>
                <div>
                    <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>
                    <select id="academicYear" class="form-control" style="width: auto; display: inline-block;">
                        <option value="2024-25" selected>2024-25</option>
                        <option value="2023-24">2023-24</option>
                        <option value="2022-23">2022-23</option>
                    </select>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">1,247</div>
                    <div class="stat-label">Total Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">89</div>
                    <div class="stat-label">Total Faculty</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Total Event Categories</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">15</div>
                    <div class="stat-label">Total Event Sub Categories</div>
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
            // Close all other dropdowns first
            const allDropdowns = document.querySelectorAll('.dropdown-menu');
            allDropdowns.forEach(dropdown => {
                if (dropdown.id !== dropdownId + '-dropdown') {
                    dropdown.classList.remove('show');
                }
            });
            
            // Toggle the clicked dropdown
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            dropdown.classList.toggle('show');
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                const allDropdowns = document.querySelectorAll('.dropdown-menu');
                allDropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            }
        });
        
        // Prevent dropdown toggle from closing when clicking inside dropdown
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });
        });
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }

        // Set user as logged in for demo
        localStorage.setItem('userLoggedIn', 'true');
        localStorage.setItem('userRole', 'admin');
    </script>
</body>
</html>
