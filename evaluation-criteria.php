<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Criteria - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h3>Faculty Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="faculty-dashboard.php">Dashboard</a></li>
                <li><a href="faculty-profile.php">Profile</a></li>
                <li><a href="faculty-myevents.php">My Events</a></li>
                <li><a href="evaluation-criteria.php" class="active">Evaluation Criteria</a></li>
                <li><a href="evaluation.php">Evaluate Participants</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <main class="dashboard-content">
            <h1>Evaluation Criteria</h1>
            <p style="color: #666;">Create and manage evaluation criteria for your events</p>
            
            <!-- Add Criteria Button -->
            <div style="margin-bottom: 2rem; padding: 1rem 0;">
                <button class="btn" onclick="window.location.href='manage-evaluation-criteria.php'" style="padding: 0.75rem 2rem; font-size: 1rem;">Add Criteria</button>
            </div>

            <div class="card">
                <h3>Existing Criteria</h3>
                <div style="margin-bottom: 1rem;">
                    <select id="filterEvent" class="form-control" style="width: 300px; display: inline-block;">
                        <option value="">All Events</option>
                        <option value="1">Code Marathon</option>
                        <option value="2">Web Development Challenge</option>
                        <option value="4">Classical Dance Competition</option>
                    </select>
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Criteria Name</th>
                                <th>Max Marks</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Code Marathon</td>
                                <td>Algorithm Efficiency</td>
                                <td>30</td>
                                <td>Quality and efficiency of algorithms used</td>
                                <td>
                                    <button class="btn" onclick="editCriteria(1)" style="margin-right: 0.5rem;">Edit</button>
                                    <button class="btn" onclick="deleteCriteria(1)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Code Marathon</td>
                                <td>Code Quality</td>
                                <td>25</td>
                                <td>Code readability and best practices</td>
                                <td>
                                    <button class="btn" onclick="editCriteria(2)" style="margin-right: 0.5rem;">Edit</button>
                                    <button class="btn" onclick="deleteCriteria(2)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Code Marathon</td>
                                <td>Problem Solving</td>
                                <td>25</td>
                                <td>Approach to solving complex problems</td>
                                <td>
                                    <button class="btn" onclick="editCriteria(3)" style="margin-right: 0.5rem;">Edit</button>
                                    <button class="btn" onclick="deleteCriteria(3)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Code Marathon</td>
                                <td>Time Management</td>
                                <td>20</td>
                                <td>Completion within time constraints</td>
                                <td>
                                    <button class="btn" onclick="editCriteria(4)" style="margin-right: 0.5rem;">Edit</button>
                                    <button class="btn" onclick="deleteCriteria(4)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Classical Dance Competition</td>
                                <td>Technique</td>
                                <td>40</td>
                                <td>Technical accuracy and skill level</td>
                                <td>
                                    <button class="btn" onclick="editCriteria(5)" style="margin-right: 0.5rem;">Edit</button>
                                    <button class="btn" onclick="deleteCriteria(5)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Classical Dance Competition</td>
                                <td>Expression</td>
                                <td>35</td>
                                <td>Emotional expression and storytelling</td>
                                <td>
                                    <button class="btn" onclick="editCriteria(6)" style="margin-right: 0.5rem;">Edit</button>
                                    <button class="btn" onclick="deleteCriteria(6)">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Classical Dance Competition</td>
                                <td>Costume & Presentation</td>
                                <td>25</td>
                                <td>Overall presentation and costume appropriateness</td>
                                <td>
                                    <button class="btn" onclick="editCriteria(7)" style="margin-right: 0.5rem;">Edit</button>
                                    <button class="btn" onclick="deleteCriteria(7)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('criteriaForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Evaluation criteria added successfully!');
            this.reset();
        });
        
        function editCriteria(id) {
            window.location.href = 'manage-evaluation-criteria.php?id=' + id;
        }
        
        function deleteCriteria(id) {
            if (confirm('Are you sure you want to delete this criteria?')) {
                alert('Criteria deleted successfully!');
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
