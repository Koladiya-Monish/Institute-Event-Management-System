<?php require_once 'config.php';?>
<?php session_start();?>

<?php 
if(isset($_SESSION['user'])){
    if($_SESSION['user'] == 'Admin'){
        header('Location: admin-dashboard.php');
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institute Event Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="home.php" class="logo">IEMS</a>
            <ul class="nav-menu">
                <li><a href="home.php" class="nav-link">Home</a></li>
                <li><a href="#about" class="nav-link">About Us</a></li>
                <li><a href="event-category.php" class="nav-link">Events</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if($_SESSION['user'] == 'Stud'): ?>
                        <li><a href="student-dashboard.php" class="nav-link">Dashboard</a></li>
                    <?php elseif($_SESSION['user'] == 'Facu'): ?>
                        <li><a href="faculty-dashboard.php" class="nav-link">Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php" class="nav-link">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="nav-link">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Institute Event Management System</h1>
                <p>"Where Talent Meets Opportunity."</p>
                <a href="login.php" class="btn">Get Started</a>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="section">
            <h2>About Us</h2>
            
            <!-- Introduction -->
            <div class="about-intro">
                <div class="intro-paragraph">
                    <div class="paragraph-icon">🎯</div>
                    <div class="paragraph-content">
                        <p>At <strong>IEMS</strong>, we believe that every event is more than just a schedule – it's an experience that brings people together. Events are at the heart of every institute's culture, from academic seminars to cultural fests, and we're here to make them smarter and simpler. Our platform is designed to help students, faculty, and administrators connect, participate, and celebrate events effortlessly.</p>
                    </div>
                </div>
                
                <div class="intro-paragraph">
                    <div class="paragraph-icon">💻</div>
                    <div class="paragraph-content">
                        <p>With <strong>IEMS</strong>, the entire event journey is managed digitally – from announcements, registrations, and scheduling to evaluations, results, and certificate generation. Students can easily explore and register for events, faculty coordinators can organize and monitor participation, while administrators gain full control and transparency over institute-wide activities. Everything is centralized, user-friendly, and accessible anytime.</p>
                    </div>
                </div>
                
                <div class="intro-paragraph">
                    <div class="paragraph-icon">🚀</div>
                    <div class="paragraph-content">
                        <p>By bringing innovation into event management, <strong>IEMS</strong> eliminates paperwork, reduces confusion, and ensures a smooth flow of information for everyone involved. Whether it's a grand festival or a small workshop, our mission is to turn event planning into a seamless, engaging, and memorable experience for the entire campus community.</p>
                    </div>
                </div>
            </div>
            
            <!-- Mission and Vision Side by Side -->
            <div class="mission-vision-grid">
                <div class="card">
                    <h3>Our Mission</h3>
                    <p>Our mission is to simplify and digitalize institute event management by providing a user-friendly platform that connects students, faculty, and administrators. We aim to eliminate manual effort, ensure transparency, and create an organized environment where every event can be planned, managed, and celebrated with ease.</p>
                </div>
                <div class="card">
                    <h3>Our Vision</h3>
                    <p>Our vision is to become the go-to digital solution for institute event management, fostering a culture of innovation, collaboration, and engagement. We aspire to empower educational institutions with smart tools that make events more accessible, efficient, and memorable for everyone involved.</p>
                </div>
            </div>
            
            <!-- Quote Section -->
            <div class="quote-section">
                <blockquote class="centered-quote">
                    "Every fest is a story, and 'IEMS' help you write it better."
                </blockquote>
            </div>
        </section>

        <!-- Upcoming Events Section -->
        <section class="section">
            <h2>Upcoming Events</h2>
            <div class="card-grid">
                <div class="card">
                    <h3>Annual Tech Fest 2025</h3>
                    <p><strong>Date:</strong> March 15-17, 2025</p>
                    <p>Join us for the biggest technical festival featuring coding competitions, robotics challenges, and innovation showcases.</p>
                    <span class="badge badge-info">Registration Open</span>
                </div>
                <div class="card">
                    <h3>Cultural Night</h3>
                    <p><strong>Date:</strong> February 28, 2025</p>
                    <p>An evening of music, dance, and drama performances celebrating the diverse cultural heritage of our institute.</p>
                    <span class="badge badge-warning">Coming Soon</span>
                </div>
                <div class="card">
                    <h3>Inter-Department Sports Meet</h3>
                    <p><strong>Date:</strong> April 5-7, 2025</p>
                    <p>Compete in various sports categories and represent your department in this exciting sporting event.</p>
                    <span class="badge badge-info">Registration Open</span>
                </div>
            </div>
        </section>

        <!-- Event Categories Section -->
        <section class="section">
            <h2>Event Categories</h2>
            <div class="card-grid">
                <div class="card">
                    <h3>Technical Events</h3>
                    <p>Programming competitions, hackathons, technical presentations, and innovation challenges that test your technical skills and knowledge.</p>
                    <a href="event-category.php" class="btn mt-1">Explore Events</a>
                </div>
                <div class="card">
                    <h3>Cultural Events</h3>
                    <p>Dance competitions, music festivals, drama performances, and cultural celebrations that showcase artistic talents and creativity.</p>
                    <a href="event-category.php" class="btn mt-1">Explore Events</a>
                </div>
                <div class="card">
                    <h3>Sports Events</h3>
                    <p>Athletic competitions, team sports, individual championships, and fitness challenges promoting physical wellness and team spirit.</p>
                    <a href="event-category.php" class="btn mt-1">Explore Events</a>
                </div>
            </div>
            </div>
            <div class="text-center mt-2">
                <a href="event-category.php" class="btn">Load More Categories</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
        <p>Designed for educational institutions to manage events efficiently.</p>
    </footer>

    <script>
        // Simple JavaScript for smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

    </script>
</body>
</html>

