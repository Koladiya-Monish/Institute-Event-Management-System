<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Events - Faculty - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h3>Faculty Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="faculty-dashboard.php">Dashboard</a></li>
                <li><a href="faculty-profile.php">Profile</a></li>
                <li><a href="faculty-myevents.php" class="active">My Events</a></li>
                <li><a href="evaluation-criteria.php">Evaluation Criteria</a></li>
                <li><a href="evaluation.php">Evaluate Participants</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <main class="dashboard-content">
            <h1>My Events</h1>
            <p style="color: #666;">Events where you are assigned as coordinator</p>
            
            <div class="card">
                <h3>Assigned Events</h3>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Venue</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Code Marathon</td>
                                <td>Technical</td>
                                <td>March 15, 2025</td>
                                <td>Computer Lab A</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="btn" onclick="setSchedule(1)" style="margin-right: 0.5rem;">Set Schedule</button>
                                    <button class="btn" onclick="uploadRules(1)">Upload Rules</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Web Development Challenge</td>
                                <td>Technical</td>
                                <td>March 16, 2025</td>
                                <td>Computer Lab B</td>
                                <td><span class="badge badge-warning">Upcoming</span></td>
                                <td>
                                    <button class="btn" onclick="setSchedule(2)" style="margin-right: 0.5rem;">Set Schedule</button>
                                    <button class="btn" onclick="uploadRules(2)">Upload Rules</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Classical Dance Competition</td>
                                <td>Cultural</td>
                                <td>February 28, 2025</td>
                                <td>Main Auditorium</td>
                                <td><span class="badge badge-info">Completed</span></td>
                                <td>
                                    <button class="btn" onclick="setSchedule(4)" style="margin-right: 0.5rem;">Set Schedule</button>
                                    <button class="btn" onclick="uploadRules(4)">Upload Rules</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script>
        function manageEvent(id) {
            window.location.href = `evaluation-criteria.php?eventId=${id}`;
        }
        
        function setSchedule(id) {
            alert(`Set schedule for event ${id}`);
        }
        
        function uploadRules(id) {
            alert(`Upload rules for event ${id}`);
        }
        
        function viewResults(id) {
            window.location.href = `view-result.php?eventId=${id}`;
        }
        
        function viewFeedback(id) {
            window.location.href = `view-feedback.php?eventId=${id}`;
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
