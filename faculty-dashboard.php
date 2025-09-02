<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h3>Faculty Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="faculty-dashboard.php" class="active">Dashboard</a></li>
                <li><a href="faculty-profile.php">Profile</a></li>
                <li><a href="faculty-myevents.php">My Events</a></li>
                <li><a href="evaluation-criteria.php">Evaluation Criteria</a></li>
                <li><a href="evaluation.php">Evaluate Participants</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="margin-bottom: 2rem;">
                <h1>Welcome, Faculty!</h1>
                <p style="color: #666;">Manage your events and evaluate participants</p>
            </div>

            <!-- Quick Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Assigned Events</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">2</div>
                    <div class="stat-label">Upcoming Events</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Completed Events</div>
                </div>
            </div>

            <!-- Current Events -->
            <div class="card">
                <h3>My Current Events</h3>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Participants</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Code Marathon</td>
                                <td>March 15, 2025</td>
                                <td>23</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <a href="evaluation.php?eventId=1" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Evaluate</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Web Development Challenge</td>
                                <td>March 16, 2025</td>
                                <td>16</td>
                                <td><span class="badge badge-warning">Upcoming</span></td>
                                <td>
                                    <a href="evaluation-criteria.php?eventId=2" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Set Criteria</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Classical Dance Competition</td>
                                <td>February 28, 2025</td>
                                <td>12</td>
                                <td><span class="badge badge-info">Completed</span></td>
                                <td>
                                    <a href="view-feedback.php?eventId=4" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View Feedback</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-2">
                    <a href="faculty-myevents.php" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View All My Events</a>
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

        // Set user as logged in for demo
        localStorage.setItem('userLoggedIn', 'true');
        localStorage.setItem('userRole', 'faculty');
    </script>
</body>
</html>
