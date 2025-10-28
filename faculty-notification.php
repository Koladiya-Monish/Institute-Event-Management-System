<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Faculty - IEMS</title>
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
                <li><a href="evaluation-criteria.php">Evaluation Criteria</a></li>
                <li><a href="evaluation.php">Evaluate Participants</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <main class="dashboard-content">
            <h1>Notifications</h1>
            
            <div class="card">
                <h3>Recent Notifications</h3>
                <div>
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px; margin-bottom: 1rem; border-left: 4px solid #667eea;">
                        <div style="display: flex; justify-content: between; align-items: start;">
                            <div style="flex: 1;">
                                <h4 style="color: #667eea; margin-bottom: 0.5rem;">New Event Assignment</h4>
                                <p style="color: #666; margin-bottom: 0.5rem;">You have been assigned as coordinator for "AI Innovation Contest" scheduled for March 17, 2025.</p>
                                <small style="color: #999;">2 hours ago</small>
                            </div>
                            <span class="badge badge-info">New</span>
                        </div>
                    </div>
                    
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px; margin-bottom: 1rem; border-left: 4px solid #28a745;">
                        <div style="display: flex; justify-content: between; align-items: start;">
                            <div style="flex: 1;">
                                <h4 style="color: #28a745; margin-bottom: 0.5rem;">Registration Update</h4>
                                <p style="color: #666; margin-bottom: 0.5rem;">5 new students have registered for Web Development Challenge. Total participants: 16</p>
                                <small style="color: #999;">1 day ago</small>
                            </div>
                            <span class="badge badge-success">Read</span>
                        </div>
                    </div>
                    
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px; margin-bottom: 1rem; border-left: 4px solid #ffc107;">
                        <div style="display: flex; justify-content: between; align-items: start;">
                            <div style="flex: 1;">
                                <h4 style="color: #ffc107; margin-bottom: 0.5rem;">Evaluation Reminder</h4>
                                <p style="color: #666; margin-bottom: 0.5rem;">Please complete the evaluation for Classical Dance Competition by March 5, 2025.</p>
                                <small style="color: #999;">2 days ago</small>
                            </div>
                            <span class="badge badge-warning">Pending</span>
                        </div>
                    </div>
                    
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px; margin-bottom: 1rem; border-left: 4px solid #17a2b8;">
                        <div style="display: flex; justify-content: between; align-items: start;">
                            <div style="flex: 1;">
                                <h4 style="color: #17a2b8; margin-bottom: 0.5rem;">System Update</h4>
                                <p style="color: #666; margin-bottom: 0.5rem;">New evaluation criteria feature has been added to the system. You can now create custom evaluation parameters.</p>
                                <small style="color: #999;">3 days ago</small>
                            </div>
                            <span class="badge badge-info">Info</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
