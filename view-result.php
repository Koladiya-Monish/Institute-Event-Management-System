<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Results - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="home.php" class="logo">IEMS</a>
            <ul class="nav-menu">
                <li><a href="home.php" class="nav-link">Home</a></li>
                <li><a href="student-dashboard.php" class="nav-link">Dashboard</a></li>
                <li><a href="home.php" class="nav-link" onclick="logout()">Logout</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <section class="section">
            <div style="margin-bottom: 2rem;">
                <a href="javascript:history.back()" style="color: #667eea; text-decoration: none;">&larr; Back</a>
            </div>
            
            <div class="card">
                <h2 class="text-center mb-2" id="eventTitle">Event Results</h2>
                
                <!-- Winners Section -->
                <div style="margin-bottom: 3rem;">
                    <h3 style="text-align: center; margin-bottom: 2rem; color: #667eea;">🏆 Winners</h3>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                        <!-- First Place -->
                        <div style="background: linear-gradient(135deg, #ffd700, #ffed4e); padding: 2rem; border-radius: 10px; text-align: center; color: #333;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">🥇</div>
                            <h3>First Place</h3>
                            <h4 style="margin: 1rem 0;">John Smith</h4>
                            <p><strong>Enrollment:</strong> 2023CS001</p>
                            <p><strong>Department:</strong> Computer Science</p>
                            <p><strong>Score:</strong> 95/100</p>
                        </div>
                        
                        <!-- Second Place -->
                        <div style="background: linear-gradient(135deg, #c0c0c0, #e8e8e8); padding: 2rem; border-radius: 10px; text-align: center; color: #333;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">🥈</div>
                            <h3>Second Place</h3>
                            <h4 style="margin: 1rem 0;">Sarah Johnson</h4>
                            <p><strong>Enrollment:</strong> 2023CS002</p>
                            <p><strong>Department:</strong> Computer Science</p>
                            <p><strong>Score:</strong> 88/100</p>
                        </div>
                        
                        <!-- Third Place -->
                        <div style="background: linear-gradient(135deg, #cd7f32, #daa560); padding: 2rem; border-radius: 10px; text-align: center; color: white;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">🥉</div>
                            <h3>Third Place</h3>
                            <h4 style="margin: 1rem 0;">Mike Davis</h4>
                            <p><strong>Enrollment:</strong> 2023IT003</p>
                            <p><strong>Department:</strong> Information Technology</p>
                            <p><strong>Score:</strong> 82/100</p>
                        </div>
                    </div>
                </div>
                
                <!-- All Participants -->
                <div>
                    <h3 style="margin-bottom: 2rem;">All Participants</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Enrollment</th>
                                    <th>Department</th>
                                    <th>Score</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Smith</td>
                                    <td>2023CS001</td>
                                    <td>Computer Science</td>
                                    <td>95/100</td>
                                    <td><span class="badge badge-success">Winner</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Sarah Johnson</td>
                                    <td>2023CS002</td>
                                    <td>Computer Science</td>
                                    <td>88/100</td>
                                    <td><span class="badge badge-success">Runner-up</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Mike Davis</td>
                                    <td>2023IT003</td>
                                    <td>Information Technology</td>
                                    <td>82/100</td>
                                    <td><span class="badge badge-success">Second Runner-up</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Emily Wilson</td>
                                    <td>2023CS004</td>
                                    <td>Computer Science</td>
                                    <td>78/100</td>
                                    <td><span class="badge badge-info">Participant</span></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>David Brown</td>
                                    <td>2023IT005</td>
                                    <td>Information Technology</td>
                                    <td>75/100</td>
                                    <td><span class="badge badge-info">Participant</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Event Details -->
                <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid #e1e5e9;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div>
                            <h4>Event Information</h4>
                            <p><strong>Event:</strong> Classical Dance Competition</p>
                            <p><strong>Date:</strong> February 28, 2025</p>
                            <p><strong>Venue:</strong> Main Auditorium</p>
                            <p><strong>Total Participants:</strong> 12</p>
                        </div>
                        <div>
                            <h4>Evaluation Details</h4>
                            <p><strong>Coordinator:</strong> Ms. Patel</p>
                            <p><strong>Evaluation Criteria:</strong> Technique, Expression, Costume</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
    </footer>

    <script>
        // Get event ID from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get('eventId') || '4';
        
        // Update page title based on event
        const eventTitles = {
            '1': 'Code Marathon Results',
            '2': 'Web Development Challenge Results',
            '4': 'Classical Dance Competition Results',
            '7': 'Cricket Tournament Results'
        };
        
        document.getElementById('eventTitle').textContent = eventTitles[eventId] || 'Event Results';
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
