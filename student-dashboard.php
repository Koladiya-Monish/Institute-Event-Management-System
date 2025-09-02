<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h3>Student Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="student-dashboard.php" class="active">Dashboard</a></li>
                <li><a href="student-profile.php">Profile</a></li>
                <li><a href="event-category.php">Explore Events</a></li>
                <li><a href="student-myevents.php">My Events</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="margin-bottom: 2rem;">
                <h1>Welcome, Student!</h1>
                <p style="color: #666;">Manage your events and track your participation</p>
            </div>

            <!-- Quick Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">5</div>
                    <div class="stat-label">Registered Events</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Completed Events</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">2</div>
                    <div class="stat-label">Upcoming Events</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">1</div>
                    <div class="stat-label">Awards Won</div>
                </div>
            </div>

            <!-- My Current Events -->
            <div class="card">
                <h3>My Current Events</h3>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Code Marathon</td>
                                <td>March 15, 2025</td>
                                <td><span class="badge badge-success">Registered</span></td>
                                <td><a href="event.php?id=1" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View Details</a></td>
                            </tr>
                            <tr>
                                <td>Web Development Challenge</td>
                                <td>March 16, 2025</td>
                                <td><span class="badge badge-warning">Pending Approval</span></td>
                                <td><a href="event.php?id=2" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View Details</a></td>
                            </tr>
                            <tr>
                                <td>Classical Dance Competition</td>
                                <td>February 28, 2025</td>
                                <td><span class="badge badge-info">Completed</span></td>
                                <td><a href="view-result.php?eventId=4" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View Result</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-2">
                    <a href="student-myevents.php" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View All My Events</a>
                </div>
            </div>

        </main>
    </div>

<!--    <script>
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }

        // Set user as logged in for demo
        localStorage.setItem('userLoggedIn', 'true');
        localStorage.setItem('userRole', 'student');
    </script>-->
</body>
</html>
