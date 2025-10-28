<?php require_once 'config.php';?>
<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details - IEMS</title>
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
                    <?php if($_SESSION['user'] == 'Student'): ?>
                        <li><a href="student-dashboard.php" class="nav-link">Dashboard</a></li>
                    <?php elseif($_SESSION['user'] == 'Faculty'): ?>
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
        <section class="section">
            <div style="margin-bottom: 2rem;">
                <a href="event-subcategory.php" style="color: #667eea; text-decoration: none;">&larr; Back to Events</a>
            </div>
            
            <div id="eventDetails">
                <!-- Event details will be loaded here -->
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
        const eventId = parseInt(urlParams.get('id')) || 1;
        
        // Sample event data
        const eventData = {
            1: {
                name: "Code Marathon",
                type: "Solo",
                category: "Technical",
                description: "24-hour programming competition testing algorithmic skills and problem-solving abilities.",
                date: "March 15, 2025",
                time: "9:00 AM - 9:00 AM (Next Day)",
                venue: "Computer Lab A",
                coordinator: "Dr. Smith",
                coordinatorEmail: "dr.smith@institute.edu",
                coordinatorPhone: "+91 9876543210",
                status: "Open",
                registrationDeadline: "March 10, 2025",
                maxParticipants: 50,
                currentRegistrations: 23,
                rules: [
                    "Individual participation only",
                    "Use of internet allowed for documentation",
                    "No external help or collaboration",
                    "Bring your own laptop",
                    "Food and refreshments will be provided"
                ],
                schedule: [
                    { time: "9:00 AM", activity: "Registration & Setup" },
                    { time: "10:00 AM", activity: "Problem Statement Release" },
                    { time: "10:30 AM", activity: "Coding Begins" },
                    { time: "1:00 PM", activity: "Lunch Break" },
                    { time: "6:00 PM", activity: "Dinner Break" },
                    { time: "9:00 AM (Next Day)", activity: "Submission Deadline" },
                    { time: "11:00 AM", activity: "Results & Prize Distribution" }
                ],
                prizes: ["1st Prize: ₹10,000", "2nd Prize: ₹7,000", "3rd Prize: ₹5,000"]
            },
            2: {
                name: "Web Development Challenge",
                type: "Team",
                category: "Technical",
                description: "Build a complete web application in 8 hours with modern technologies.",
                date: "March 16, 2025",
                time: "9:00 AM - 5:00 PM",
                venue: "Computer Lab B",
                coordinator: "Prof. Johnson",
                coordinatorEmail: "prof.johnson@institute.edu",
                coordinatorPhone: "+91 9876543211",
                status: "Open",
                registrationDeadline: "March 11, 2025",
                maxParticipants: 40,
                currentRegistrations: 16,
                rules: [
                    "Team of 2-4 members",
                    "Use any web technologies",
                    "Original work only",
                    "Deploy on provided hosting",
                    "Present your solution"
                ],
                schedule: [
                    { time: "9:00 AM", activity: "Team Registration" },
                    { time: "9:30 AM", activity: "Problem Statement" },
                    { time: "10:00 AM", activity: "Development Begins" },
                    { time: "1:00 PM", activity: "Lunch Break" },
                    { time: "4:00 PM", activity: "Final Submission" },
                    { time: "4:30 PM", activity: "Presentations" },
                    { time: "5:30 PM", activity: "Results" }
                ],
                prizes: ["1st Prize: ₹15,000", "2nd Prize: ₹10,000", "3rd Prize: ₹7,000"]
            }
        };
        
        function loadEventDetails() {
            const event = eventData[eventId];
            if (!event) {
                document.getElementById('eventDetails').innerHTML = '<p>Event not found.</p>';
                return;
            }
            
            const userRole = localStorage.getItem('userRole') || 'student';
            
            document.getElementById('eventDetails').innerHTML = `
                <div class="card" style="max-width: none;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem;">
                        <div>
                            <h1 style="margin-bottom: 0.5rem; color: #667eea;">${event.name}</h1>
                            <p style="color: #666; font-size: 1.1rem;">${event.category} Event - ${event.type}</p>
                            <span class="badge ${getStatusClass(event.status)}">${event.status}</span>
                        </div>
                        <div style="text-align: right;">
                            <button class="btn" onclick="registerForEvent()" ${event.status !== 'Open' ? 'disabled' : ''}>
                                Register for Event
                            </button>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                        <div>
                            <h3>Event Schedule</h3>
                            <p><strong>Date:</strong> ${event.date}</p>
                            <p><strong>Time:</strong> ${event.time}</p>
                            <p><strong>Venue:</strong> ${event.venue}</p>
                            <p><strong>Registration Deadline:</strong> ${event.registrationDeadline}</p>
                        </div>
                        <div>
                            <h3>Coordinator Information</h3>
                            <p><strong>Name:</strong> ${event.coordinator}</p>
                            <p><strong>Email:</strong> ${event.coordinatorEmail}</p>
                            <p><strong>Phone:</strong> ${event.coordinatorPhone}</p>
                        </div>
                    </div>
                    
                    
                    <div style="display: flex; gap: 1rem; justify-content: center;">
                        <button class="btn" onclick="viewRules()">Rules & Regulations</button>
                        <button class="btn" onclick="viewResults()">View Results</button>
                    </div>
                </div>
            `;
        }
        
        function getStatusClass(status) {
            switch(status) {
                case 'Open': return 'badge-success';
                case 'Coming Soon': return 'badge-warning';
                case 'Registration Closed': return 'badge-danger';
                default: return 'badge-info';
            }
        }
        
        function registerForEvent() {
            alert('Registration successful! You will receive a confirmation email shortly.');
        }
        
        function viewResults() {
            window.location.href = 'view-result.php?eventId=' + eventId;
        }
        
        function viewRules() {
            // Display rules and regulations in a modal or alert
            const rulesText = `
RULES & REGULATIONS

1. GENERAL RULES:
   • All participants must register before the deadline
   • Valid student ID is mandatory for participation
   • Late entries will not be accepted under any circumstances

2. PARTICIPATION RULES:
   • Individual participation only (unless specified as team event)
   • Each student can participate in maximum 3 events per category
   • Participants must be present 15 minutes before event start time

3. CODE OF CONDUCT:
   • Maintain discipline and decorum throughout the event
   • Use of mobile phones during events is strictly prohibited
   • Any form of malpractice will lead to immediate disqualification

4. JUDGING CRITERIA:
   • Decisions of judges will be final and binding
   • No appeals will be entertained after result declaration
   • Evaluation will be based on predefined criteria

5. PRIZES & CERTIFICATES:
   • Winners will receive certificates and prizes
   • All participants will receive participation certificates
   • Prize distribution will be done on the same day

6. IMPORTANT NOTES:
   • Event timings are subject to change
   • Participants are responsible for their belongings
   • Management reserves the right to cancel/postpone events

For any queries, contact the event coordinator.
            `;
            
            alert(rulesText);
        }
        
        function viewFeedback() {
            const userRole = localStorage.getItem('userRole') || 'student';
            if (userRole === 'student') {
                window.location.href = 'give-feedback.php?eventId=' + eventId;
            } else {
                window.location.href = 'view-feedback.php?eventId=' + eventId;
            }
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
        
        // Load event details when page loads
        loadEventDetails();
    </script>
</body>
</html>
