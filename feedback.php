<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h3 id="portalTitle">Admin Portal</h3>
            <ul class="sidebar-menu" id="sidebarMenu">
                <!-- Menu will be loaded based on user role -->
            </ul>
        </nav>

        <main class="dashboard-content">
            <h1>Event Feedback</h1>
            <p style="color: #666;">View feedback for events by category and sub-category</p>
            
            <div class="card">
                <h3>Get Event Feedback</h3>
                <form id="feedbackForm">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div class="form-group">
                            <label for="eventCategory">Event Category Name</label>
                            <select id="eventCategory" name="eventCategory" class="form-control" required onchange="loadSubCategories()">
                                <option value="">Select Category</option>
                                <option value="technical">Technical Events</option>
                                <option value="cultural">Cultural Events</option>
                                <option value="sports">Sports Events</option>
                                <option value="literary">Literary Events</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="eventSubCategory">Event Sub Category Name</label>
                            <select id="eventSubCategory" name="eventSubCategory" class="form-control" required>
                                <option value="">Select Sub Category</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-top: 2rem;">
                        <button type="submit" class="btn" style="padding: 0.75rem 2rem; font-size: 1rem;">Get Feedback</button>
                    </div>
                </form>
            </div>

            <!-- Feedback Results Section (Initially Hidden) -->
            <div id="feedbackResults" class="card" style="display: none; margin-top: 2rem;">
                <h3 id="feedbackTitle">Event Feedback Results</h3>
                
                <!-- Feedback Summary -->
                <div style="margin-bottom: 2rem;">
                    <h4>Feedback Summary</h4>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number" id="avgRating">4.2</div>
                            <div class="stat-label">Average Rating</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number" id="totalResponses">15</div>
                            <div class="stat-label">Total Responses</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number" id="responseRate">88%</div>
                            <div class="stat-label">Response Rate</div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Feedback Table -->
                <div>
                    <h4>Individual Feedback</h4>
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
                            <tbody id="feedbackTableBody">
                                <!-- Feedback data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Load appropriate sidebar based on user role
        window.onload = function() {
            const userRole = localStorage.getItem('userRole') || 'admin';
            loadSidebar(userRole);
        };

        function loadSidebar(role) {
            const portalTitle = document.getElementById('portalTitle');
            const sidebarMenu = document.getElementById('sidebarMenu');
            
            if (role === 'faculty') {
                portalTitle.textContent = 'Faculty Portal';
                sidebarMenu.innerHTML = `
                    <li><a href="faculty-dashboard.php">Dashboard</a></li>
                    <li><a href="faculty-profile.php">Profile</a></li>
                    <li><a href="faculty-myevents.php">My Events</a></li>
                    <li><a href="evaluation-criteria.php">Evaluation Criteria</a></li>
                    <li><a href="evaluation.php">Evaluate Participants</a></li>
                    <li><a href="feedback.php" class="active">Feedback</a></li>
                    <li><a href="reports.php">Reports</a></li>
                    <li><a href="change-password.php">Change Password</a></li>
                    <li><a href="home.php" onclick="logout()">Logout</a></li>
                `;
            } else {
                portalTitle.textContent = 'Admin Portal';
                sidebarMenu.innerHTML = `
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
                        <ul class="dropdown-menu" id="events-dropdown">
                            <li><a href="admin-event-category.php">Category</a></li>
                            <li><a href="admin-event-subcategory.php">Sub-Category</a></li>
                        </ul>
                    </li>
                    <li><a href="feedback.php" class="active">Feedback</a></li>
                    <li><a href="reports.php">Reports</a></li>
                    <li><a href="home.php" onclick="logout()">Logout</a></li>
                `;
            }
        }

        function loadSubCategories() {
            const category = document.getElementById('eventCategory').value;
            const subCategorySelect = document.getElementById('eventSubCategory');
            
            // Clear existing options
            subCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';
            
            const subCategories = {
                'technical': [
                    { value: 'code-marathon', text: 'Code Marathon' },
                    { value: 'web-dev-challenge', text: 'Web Development Challenge' },
                    { value: 'hackathon', text: 'Hackathon' },
                    { value: 'robotics', text: 'Robotics Competition' }
                ],
                'cultural': [
                    { value: 'classical-dance', text: 'Classical Dance Competition' },
                    { value: 'singing', text: 'Singing Competition' },
                    { value: 'drama', text: 'Drama Competition' },
                    { value: 'fashion-show', text: 'Fashion Show' }
                ],
                'sports': [
                    { value: 'cricket', text: 'Cricket Tournament' },
                    { value: 'football', text: 'Football Tournament' },
                    { value: 'basketball', text: 'Basketball Tournament' },
                    { value: 'badminton', text: 'Badminton Tournament' }
                ],
                'literary': [
                    { value: 'debate', text: 'Debate Championship' },
                    { value: 'essay-writing', text: 'Essay Writing' },
                    { value: 'poetry', text: 'Poetry Competition' },
                    { value: 'quiz', text: 'Quiz Competition' }
                ]
            };
            
            if (category && subCategories[category]) {
                subCategories[category].forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub.value;
                    option.textContent = sub.text;
                    subCategorySelect.appendChild(option);
                });
            }
        }

        document.getElementById('feedbackForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const category = document.getElementById('eventCategory').value;
            const subCategory = document.getElementById('eventSubCategory').value;
            
            if (!category || !subCategory) {
                alert('Please select both category and sub-category');
                return;
            }
            
            // Show feedback results
            loadFeedbackResults(category, subCategory);
        });

        function loadFeedbackResults(category, subCategory) {
            const feedbackResults = document.getElementById('feedbackResults');
            const feedbackTitle = document.getElementById('feedbackTitle');
            const feedbackTableBody = document.getElementById('feedbackTableBody');
            
            // Mock feedback data
            const mockFeedback = [
                {
                    student: 'John Smith',
                    rating: 5,
                    comments: 'Excellent event organization! The venue was perfect and coordination was smooth.',
                    date: 'March 1, 2025'
                },
                {
                    student: 'Sarah Johnson',
                    rating: 4,
                    comments: 'Good event overall. Sound system could be improved for better audio quality.',
                    date: 'March 1, 2025'
                },
                {
                    student: 'Mike Davis',
                    rating: 3,
                    comments: 'Event was okay but timing could have been better managed. Some delays affected flow.',
                    date: 'March 1, 2025'
                },
                {
                    student: 'Emily Wilson',
                    rating: 5,
                    comments: 'Amazing event! Everything was perfectly organized and well-coordinated. Highly recommend!',
                    date: 'March 1, 2025'
                }
            ];
            
            // Update title
            const subCategoryText = document.getElementById('eventSubCategory').selectedOptions[0].text;
            feedbackTitle.textContent = `${subCategoryText} - Feedback Results`;
            
            // Generate star ratings
            function generateStars(rating) {
                let stars = '';
                for (let i = 1; i <= 5; i++) {
                    stars += i <= rating ? '★' : '☆';
                }
                return stars;
            }
            
            // Populate table
            feedbackTableBody.innerHTML = mockFeedback.map(feedback => `
                <tr>
                    <td>${feedback.student}</td>
                    <td>
                        <div style="color: #ffd700;">${generateStars(feedback.rating)}</div>
                        <small>${feedback.rating}/5</small>
                    </td>
                    <td>${feedback.comments}</td>
                    <td>${feedback.date}</td>
                </tr>
            `).join('');
            
            // Show results section
            feedbackResults.style.display = 'block';
            feedbackResults.scrollIntoView({ behavior: 'smooth' });
        }

        function toggleDropdown(id) {
            const dropdown = document.getElementById(id + '-dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
