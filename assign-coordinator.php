<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Coordinator - Admin Portal</title>
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

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="display: flex; align-items: center; margin-bottom: 2rem;">
                <button onclick="goBack()" class="btn btn-secondary" style="margin-right: 1rem;">← Back</button>
                <h1>Assign Event Coordinator</h1>
            </div>

            <div class="card">
                <h3>Event Details</h3>
                <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div>
                            <strong>Category:</strong> <span id="eventCategory">Technical Events</span><br>
                            <strong>Sub-Category:</strong> <span id="eventSubCategory">Code Marathon</span>
                        </div>
                        <div>
                            <strong>Type:</strong> <span id="eventType">Solo</span><br>
                            <strong>Current Coordinator:</strong> <span id="currentCoordinator">Dr. Smith</span>
                        </div>
                    </div>
                </div>

                <h3>Select New Coordinator</h3>
                <form id="coordinatorForm">
                    <div class="form-group">
                        <label for="facultySelect">Select Faculty</label>
                        <select id="facultySelect" class="form-control" required>
                            <option value="">-- Select Faculty --</option>
                            <option value="1">Dr. Smith - Computer Science</option>
                            <option value="2">Prof. Johnson - Information Technology</option>
                            <option value="3">Ms. Patel - Electronics</option>
                            <option value="4">Dr. Williams - Mechanical Engineering</option>
                            <option value="5">Prof. Brown - Civil Engineering</option>
                            <option value="6">Dr. Davis - Mathematics</option>
                            <option value="7">Ms. Wilson - Physics</option>
                            <option value="8">Prof. Miller - Chemistry</option>
                            <option value="9">Dr. Moore - English Literature</option>
                            <option value="10">Ms. Taylor - Business Administration</option>
                        </select>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <button type="submit" class="btn">Assign Coordinator</button>
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
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            dropdown.classList.toggle('show');
        }

        function goBack() {
            window.location.href = 'admin-event-subcategory.php';
        }

        // Get subcategory ID from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const subcategoryId = urlParams.get('subcategoryId');

        // Update event details based on subcategory ID
        if (subcategoryId) {
            updateEventDetails(subcategoryId);
        }

        function updateEventDetails(id) {
            const eventDetails = {
                '1': { category: 'Technical Events', subCategory: 'Code Marathon', type: 'Solo', coordinator: 'Dr. Smith' },
                '2': { category: 'Technical Events', subCategory: 'Web Development Challenge', type: 'Group', coordinator: 'Prof. Johnson' },
                '3': { category: 'Cultural Events', subCategory: 'Classical Dance Competition', type: 'Solo', coordinator: 'Ms. Patel' }
            };

            const details = eventDetails[id] || eventDetails['1'];
            document.getElementById('eventCategory').textContent = details.category;
            document.getElementById('eventSubCategory').textContent = details.subCategory;
            document.getElementById('eventType').textContent = details.type;
            document.getElementById('currentCoordinator').textContent = details.coordinator;
        }

        document.getElementById('coordinatorForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const facultySelect = document.getElementById('facultySelect');
            const selectedFaculty = facultySelect.options[facultySelect.selectedIndex].text;
            
            if (confirm(`Assign ${selectedFaculty} as coordinator for this event?`)) {
                alert('Coordinator assigned successfully!');
                window.location.href = 'admin-event-subcategory.php';
            }
        });

        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
