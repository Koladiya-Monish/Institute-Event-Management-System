<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Event Sub-Category - IEMS</title>
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
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1 id="pageTitle">Add Event Sub-Category</h1>
                <div>
                    <button class="btn btn-secondary" onclick="window.location.href='admin-event-subcategory.php'">Back to List</button>
                </div>
            </div>

            <!-- Event Sub-Category Form -->
            <div class="card">
                <h3 id="formTitle">Add New Event Sub-Category</h3>
                <form id="subCategoryForm">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div class="form-group">
                            <label for="category">Select Category Name</label>
                            <select id="category" name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="1">Technical Events</option>
                                <option value="2">Cultural Events</option>
                                <option value="3">Sports Events</option>
                                <option value="4">Literary Events</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subCategoryName">Enter Event Sub Category Name</label>
                            <input type="text" id="subCategoryName" name="subCategoryName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="eventType">Event Type</label>
                            <select id="eventType" name="eventType" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="solo">Solo</option>
                                <option value="group">Group</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="upcoming">Upcoming</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="text-center" style="margin-top: 2rem;">
                        <button type="submit" class="btn" id="submitBtn">Add Sub-Category</button>
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
                document.getElementById('pageTitle').textContent = 'Edit Event Sub-Category';
                document.getElementById('formTitle').textContent = 'Edit Event Sub-Category';
                document.getElementById('submitBtn').textContent = 'Update Sub-Category';
                
                // Load sub-category data for editing (in real app, this would fetch from database)
                loadSubCategoryData(editId);
            }
        };

        function loadSubCategoryData(id) {
            // Mock data - in real application, this would fetch from database
            const subCategories = {
                '1': { category: '1', name: 'Code Marathon', eventType: 'solo', status: 'upcoming' },
                '2': { category: '1', name: 'Web Development Challenge', eventType: 'group', status: 'ongoing' },
                '3': { category: '2', name: 'Classical Dance Competition', eventType: 'solo', status: 'completed' }
            };
            
            if (subCategories[id]) {
                const subCategory = subCategories[id];
                document.getElementById('category').value = subCategory.category;
                document.getElementById('subCategoryName').value = subCategory.name;
                document.getElementById('eventType').value = subCategory.eventType;
                document.getElementById('status').value = subCategory.status;
            }
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            dropdown.classList.toggle('show');
        }
        
        document.getElementById('subCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (isEditMode) {
                alert('Event Sub-Category updated successfully!');
            } else {
                alert('Event Sub-Category added successfully!');
            }
            
            window.location.href = 'admin-event-subcategory.php';
        });
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
