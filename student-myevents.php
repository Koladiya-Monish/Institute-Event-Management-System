<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Events - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h3>Student Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="home.php">Home</a></li>
                <li><a href="student-dashboard.php">Dashboard</a></li>
                <li><a href="student-profile.php">Profile</a></li>
                <li><a href="event-category.php">Explore Events</a></li>
                <li><a href="student-myevents.php" class="active">My Events</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="margin-bottom: 2rem;">
                <h1>My Events</h1>
                <p style="color: #666;">Track your registered events and approval status</p>
            </div>

            <!-- Filter Tabs -->
            <div style="margin-bottom: 2rem;">
                <div style="display: flex; gap: 1rem; border-bottom: 2px solid #e1e5e9;">
                    <button class="tab-btn active" onclick="filterEvents('all')">All Events</button>
                    <button class="tab-btn" onclick="filterEvents('registered')">Registered</button>
                    <button class="tab-btn" onclick="filterEvents('pending')">Pending Approval</button>
                    <button class="tab-btn" onclick="filterEvents('completed')">Completed</button>
                </div>
            </div>

            <!-- Events List -->
            <div class="card">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="eventsTableBody">
                            <tr data-status="registered">
                                <td>Code Marathon</td>
                                <td>Technical</td>
                                <td>March 15, 2025</td>
                                <td><span class="badge badge-success">Registered</span></td>
                                <td>
                                    <a href="event.php?id=1" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; margin-right: 0.5rem;">View Details</a>
                                    <a href="give-feedback.php?eventId=1" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Give Feedback</a>
                                </td>
                            </tr>
                            <tr data-status="pending">
                                <td>Web Development Challenge</td>
                                <td>Technical</td>
                                <td>March 16, 2025</td>
                                <td><span class="badge badge-warning">Pending Approval</span></td>
                                <td>
                                    <a href="event.php?id=2" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; margin-right: 0.5rem;">View Details</a>
                                    <a href="give-feedback.php?eventId=2" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Give Feedback</a>
                                </td>
                            </tr>
                            <tr data-status="completed">
                                <td>Classical Dance Competition</td>
                                <td>Cultural</td>
                                <td>February 28, 2025</td>
                                <td><span class="badge badge-info">Completed</span></td>
                                <td>
                                    <a href="view-result.php?eventId=4" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; margin-right: 0.5rem;">View Result</a>
                                    <a href="give-feedback.php?eventId=4" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Give Feedback</a>
                                </td>
                            </tr>
                            <tr data-status="registered">
                                <td>Debate Championship</td>
                                <td>Literary</td>
                                <td>March 20, 2025</td>
                                <td><span class="badge badge-success">Registered</span></td>
                                <td>
                                    <a href="event.php?id=10" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; margin-right: 0.5rem;">View Details</a>
                                    <a href="give-feedback.php?eventId=10" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Give Feedback</a>
                                </td>
                            </tr>
                            <tr data-status="completed">
                                <td>Cricket Tournament</td>
                                <td>Sports</td>
                                <td>January 15, 2025</td>
                                <td><span class="badge badge-info">Completed</span></td>
                                <td>
                                    <a href="view-result.php?eventId=7" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem; margin-right: 0.5rem;">View Result</a>
                                    <a href="give-feedback.php?eventId=7" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Give Feedback</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <style>
        .tab-btn {
            padding: 0.75rem 1.5rem;
            background: none;
            border: none;
            color: #666;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .tab-btn.active,
        .tab-btn:hover {
            color: #667eea;
            border-bottom-color: #667eea;
        }
    </style>

    <script>
        function filterEvents(status) {
            const rows = document.querySelectorAll('#eventsTableBody tr');
            const tabs = document.querySelectorAll('.tab-btn');
            
            // Update active tab
            tabs.forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filter rows
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'all' || rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
