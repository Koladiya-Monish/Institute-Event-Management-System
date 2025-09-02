<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Categories - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="home.php" class="logo">IEMS</a>
            <ul class="nav-menu">
                <li><a href="home.php" class="nav-link">Home</a></li>
                <li><a href="home.php#about" class="nav-link">About Us</a></li>
                <li><a href="event-category.php" class="nav-link">Events</a></li>
                <li><a href="login.php" class="nav-link">Login</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <section class="section">
            <h2>Event Categories</h2>
            <p class="text-center mb-2" style="color: #666;">Explore various event categories and participate in competitions</p>
            
            <div class="card-grid">
                <div class="card">
                    <h3>Technical Events</h3>
                    <p>Showcase your technical skills through programming competitions, hackathons, and innovation challenges.</p>
                    <ul style="margin: 1rem 0; color: #666;">
                        <li>Programming Contests</li>
                        <li>Web Development</li>
                        <li>Mobile App Development</li>
                        <li>Robotics</li>
                        <li>AI/ML Competitions</li>
                    </ul>
                    <button class="btn" onclick="viewSubCategories('technical')">View Sub-Events</button>
                </div>
                
                <div class="card">
                    <h3>Cultural Events</h3>
                    <p>Express your creativity through dance, music, drama, and other cultural performances.</p>
                    <ul style="margin: 1rem 0; color: #666;">
                        <li>Dance Competitions</li>
                        <li>Music Festivals</li>
                        <li>Drama & Theatre</li>
                        <li>Art & Craft</li>
                        <li>Fashion Shows</li>
                    </ul>
                    <button class="btn" onclick="viewSubCategories('cultural')">View Sub-Events</button>
                </div>
                
                <div class="card">
                    <h3>Sports Events</h3>
                    <p>Participate in various sports competitions and promote physical fitness and team spirit.</p>
                    <ul style="margin: 1rem 0; color: #666;">
                        <li>Cricket Tournament</li>
                        <li>Football Championship</li>
                        <li>Basketball League</li>
                        <li>Athletics Meet</li>
                        <li>Indoor Games</li>
                    </ul>
                    <button class="btn" onclick="viewSubCategories('sports')">View Sub-Events</button>
                </div>
                
                <div class="card">
                    <h3>Literary Events</h3>
                    <p>Enhance your communication and writing skills through debates, essays, and literary competitions.</p>
                    <ul style="margin: 1rem 0; color: #666;">
                        <li>Debate Competitions</li>
                        <li>Essay Writing</li>
                        <li>Poetry Recitation</li>
                        <li>Story Telling</li>
                        <li>Quiz Competitions</li>
                    </ul>
                    <button class="btn" onclick="viewSubCategories('literary')">View Sub-Events</button>
                </div>
                
                <div class="card">
                    <h3>Business Events</h3>
                    <p>Develop entrepreneurial skills through business plan competitions and case studies.</p>
                    <ul style="margin: 1rem 0; color: #666;">
                        <li>Business Plan Competition</li>
                        <li>Case Study Analysis</li>
                        <li>Marketing Strategy</li>
                        <li>Startup Pitch</li>
                        <li>Finance Quiz</li>
                    </ul>
                    <button class="btn" onclick="viewSubCategories('business')">View Sub-Events</button>
                </div>
                
                <div class="card">
                    <h3>Science Events</h3>
                    <p>Explore scientific concepts through experiments, projects, and research presentations.</p>
                    <ul style="margin: 1rem 0; color: #666;">
                        <li>Science Fair</li>
                        <li>Research Paper Presentation</li>
                        <li>Laboratory Skills</li>
                        <li>Innovation Projects</li>
                        <li>Science Quiz</li>
                    </ul>
                    <button class="btn" onclick="viewSubCategories('science')">View Sub-Events</button>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
    </footer>

    <script>
        function viewSubCategories(category) {
            // Check if user is logged in (simple demo logic)
            const isLoggedIn = localStorage.getItem('userLoggedIn') === 'true';
            
            if (isLoggedIn) {
                // Redirect to sub-category page with category parameter
                window.location.href = `event-subcategory.php?category=${category}`;
            } else {
                alert('Please login to view event details and register for events.');
                window.location.href = 'login.php';
            }
        }
    </script>
</body>
</html>
