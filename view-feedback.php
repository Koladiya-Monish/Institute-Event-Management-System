<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="home.php" class="logo">IEMS</a>
            <ul class="nav-menu">
                <li><a href="home.php" class="nav-link">Home</a></li>
                <li><a href="faculty-dashboard.php" class="nav-link">Dashboard</a></li>
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
                <h2 class="text-center mb-2" id="eventTitle">Event Feedback</h2>
                
                <!-- Feedback Summary -->
                <div style="margin-bottom: 3rem;">
                    <h3>Feedback Summary</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">4.2</div>
                            <div class="stat-label">Average Rating</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">12</div>
                            <div class="stat-label">Total Responses</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">92%</div>
                            <div class="stat-label">Response Rate</div>
                        </div>
                    </div>
                </div>
                
                <!-- Detailed Feedback -->
                <div>
                    <h3>Individual Feedback</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Overall Rating</th>
                                    <th>Comments & Suggestions</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Smith</td>
                                    <td>
                                        <div style="color: #ffd700;">★★★★★</div>
                                        <small>5/5</small>
                                    </td>
                                    <td>Excellent event organization! The venue was perfect and coordination was smooth.</td>
                                    <td>March 1, 2025</td>
                                </tr>
                                <tr>
                                    <td>Sarah Johnson</td>
                                    <td>
                                        <div style="color: #ffd700;">★★★★☆</div>
                                        <small>4/5</small>
                                    </td>
                                    <td>Good event overall. Sound system could be improved for better audio quality.</td>
                                    <td>March 1, 2025</td>
                                </tr>
                                <tr>
                                    <td>Mike Davis</td>
                                    <td>
                                        <div style="color: #ffd700;">★★★☆☆</div>
                                        <small>3/5</small>
                                    </td>
                                    <td>Event was okay but timing could have been better managed. Some delays affected flow.</td>
                                    <td>March 1, 2025</td>
                                </tr>
                                <tr>
                                    <td>Emily Wilson</td>
                                    <td>
                                        <div style="color: #ffd700;">★★★★★</div>
                                        <small>5/5</small>
                                    </td>
                                    <td>Amazing event! Everything was perfectly organized and well-coordinated. Highly recommend!</td>
                                    <td>March 1, 2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </section>
    </main>

    <!-- Detailed Feedback Modal -->
    <div id="feedbackModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 2rem; border-radius: 10px; max-width: 600px; width: 90%;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 id="modalTitle">Detailed Feedback</h3>
                <button onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>
            <div id="modalContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
    </footer>

    <script>
        // Get event ID from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get('eventId') || '4';
        
        const eventTitles = {
            '1': 'Code Marathon Feedback',
            '2': 'Web Development Challenge Feedback',
            '4': 'Classical Dance Competition Feedback',
            '7': 'Cricket Tournament Feedback'
        };
        
        document.getElementById('eventTitle').textContent = eventTitles[eventId] || 'Event Feedback';
        
        function viewDetailedFeedback(studentId) {
            const feedbackData = {
                1: {
                    name: 'John Smith',
                    rating: 5,
                    organization: 'Excellent',
                    venue: 'Excellent',
                    coordination: 'Excellent',
                    recommend: true,
                    comments: 'Excellent event organization! The venue was perfect and the coordination was smooth. Really enjoyed participating and would definitely recommend to others. The judges were fair and the overall experience was amazing.'
                },
                2: {
                    name: 'Sarah Johnson',
                    rating: 4,
                    organization: 'Good',
                    venue: 'Good',
                    coordination: 'Excellent',
                    recommend: true,
                    comments: 'Good event overall. The sound system could be improved for better audio quality during performances. Otherwise, well organized and the coordinators were very helpful throughout the event.'
                }
            };
            
            const feedback = feedbackData[studentId] || feedbackData[1];
            
            document.getElementById('modalTitle').textContent = `Feedback from ${feedback.name}`;
            document.getElementById('modalContent').innerHTML = `
                <div style="margin-bottom: 1rem;">
                    <strong>Overall Rating:</strong> ${feedback.rating}/5 ★
                </div>
                <div style="margin-bottom: 1rem;">
                    <strong>Organization:</strong> ${feedback.organization}
                </div>
                <div style="margin-bottom: 1rem;">
                    <strong>Venue & Facilities:</strong> ${feedback.venue}
                </div>
                <div style="margin-bottom: 1rem;">
                    <strong>Coordinator Support:</strong> ${feedback.coordination}
                </div>
                <div style="margin-bottom: 1rem;">
                    <strong>Would Recommend:</strong> ${feedback.recommend ? 'Yes' : 'No'}
                </div>
                <div style="margin-bottom: 1rem;">
                    <strong>Comments:</strong>
                    <p style="background: #f8f9fa; padding: 1rem; border-radius: 5px; margin-top: 0.5rem;">${feedback.comments}</p>
                </div>
            `;
            
            document.getElementById('feedbackModal').style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('feedbackModal').style.display = 'none';
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
