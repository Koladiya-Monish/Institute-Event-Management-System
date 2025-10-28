<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Student - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h3>Student Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="student-dashboard.php">Dashboard</a></li>
                <li><a href="student-profile.php">Profile</a></li>
                <li><a href="event-category.php">Explore Events</a></li>
                <li><a href="student-myevents.php">My Events</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <main class="dashboard-content">
            <h1>Notifications</h1>
            
            <div class="card">
                <h3>Recent Notifications</h3>
                <div>
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px; margin-bottom: 1rem; border-left: 4px solid #28a745;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <h4 style="color: #28a745; margin-bottom: 0.5rem;">Registration Confirmed</h4>
                                <p style="color: #666; margin-bottom: 0.5rem;">Your registration for Code Marathon has been confirmed. Event date: March 15, 2025.</p>
                                <small style="color: #999;">2 hours ago</small>
                            </div>
                            <span class="badge badge-success">Confirmed</span>
                        </div>
                    </div>
                    
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px; margin-bottom: 1rem; border-left: 4px solid #ffc107;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <h4 style="color: #ffc107; margin-bottom: 0.5rem;">Registration Under Review</h4>
                                <p style="color: #666; margin-bottom: 0.5rem;">Your registration for Web Development Challenge is under review. You will be notified once approved.</p>
                                <small style="color: #999;">1 day ago</small>
                            </div>
                            <span class="badge badge-warning">Pending</span>
                        </div>
                    </div>
                    
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px; margin-bottom: 1rem; border-left: 4px solid #17a2b8;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <h4 style="color: #17a2b8; margin-bottom: 0.5rem;">Results Published</h4>
                                <p style="color: #666; margin-bottom: 0.5rem;">Results for Classical Dance Competition are now available. Check your performance!</p>
                                <small style="color: #999;">1 day ago</small>
                            </div>
                            <span class="badge badge-info">Results</span>
                        </div>
                    </div>
                    
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px; margin-bottom: 1rem; border-left: 4px solid #667eea;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <h4 style="color: #667eea; margin-bottom: 0.5rem;">New Event Available</h4>
                                <p style="color: #666; margin-bottom: 0.5rem;">AI Innovation Contest registration is now open. Don't miss this opportunity!</p>
                                <small style="color: #999;">3 days ago</small>
                            </div>
                            <span class="badge badge-info">New Event</span>
                        </div>
                    </div>
                    
                    <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px; margin-bottom: 1rem; border-left: 4px solid #dc3545;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <h4 style="color: #dc3545; margin-bottom: 0.5rem;">Registration Deadline</h4>
                                <p style="color: #666; margin-bottom: 0.5rem;">Last 2 days to register for Debate Championship. Register now!</p>
                                <small style="color: #999;">5 days ago</small>
                            </div>
                            <span class="badge badge-danger">Urgent</span>
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
