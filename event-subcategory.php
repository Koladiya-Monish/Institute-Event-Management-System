<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Sub-Categories - IEMS</title>
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
                <li><a href="student-dashboard.php" class="nav-link">Dashboard</a></li>
                <li><a href="home.php" class="nav-link" onclick="logout()">Logout</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <section class="section">
            <div style="margin-bottom: 2rem;">
                <a href="event-category.php" style="color: #667eea; text-decoration: none;">&larr; Back to Categories</a>
            </div>
            
            <h2 id="categoryTitle">Sub-Events</h2>
            <p class="text-center mb-2" style="color: #666;">Select an event to view details and register</p>
            
            <div class="card-grid" id="subEventsContainer">
                <!-- Sub-events will be loaded here dynamically -->
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
    </footer>

    <script>
        // Get category from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const category = urlParams.get('category') || 'technical';
        
        // Sub-events data
        const subEvents = {
            technical: [
                {
                    id: 1,
                    name: "Code Marathon",
                    type: "Solo",
                    description: "24-hour programming competition testing algorithmic skills",
                    date: "March 15, 2025",
                    venue: "Computer Lab A",
                    coordinator: "Dr. Smith",
                    status: "Open"
                },
                {
                    id: 2,
                    name: "Web Development Challenge",
                    type: "Team",
                    description: "Build a complete web application in 8 hours",
                    date: "March 16, 2025",
                    venue: "Computer Lab B",
                    coordinator: "Prof. Johnson",
                    status: "Open"
                },
                {
                    id: 3,
                    name: "AI Innovation Contest",
                    type: "Team",
                    description: "Develop AI solutions for real-world problems",
                    date: "March 17, 2025",
                    venue: "Innovation Hub",
                    coordinator: "Dr. Williams",
                    status: "Coming Soon"
                }
            ],
            cultural: [
                {
                    id: 4,
                    name: "Classical Dance Competition",
                    type: "Solo",
                    description: "Showcase traditional dance forms",
                    date: "February 28, 2025",
                    venue: "Main Auditorium",
                    coordinator: "Ms. Patel",
                    status: "Open"
                },
                {
                    id: 5,
                    name: "Band Battle",
                    type: "Team",
                    description: "Musical competition for bands",
                    date: "March 1, 2025",
                    venue: "Open Theater",
                    coordinator: "Mr. Kumar",
                    status: "Open"
                },
                {
                    id: 6,
                    name: "Fashion Show",
                    type: "Team",
                    description: "Themed fashion presentation",
                    date: "March 2, 2025",
                    venue: "Main Auditorium",
                    coordinator: "Ms. Singh",
                    status: "Registration Closed"
                }
            ],
            sports: [
                {
                    id: 7,
                    name: "Cricket Tournament",
                    type: "Team",
                    description: "Inter-department cricket championship",
                    date: "April 5-7, 2025",
                    venue: "Sports Ground",
                    coordinator: "Coach Sharma",
                    status: "Open"
                },
                {
                    id: 8,
                    name: "100m Sprint",
                    type: "Solo",
                    description: "Individual track event",
                    date: "April 6, 2025",
                    venue: "Athletics Track",
                    coordinator: "Coach Reddy",
                    status: "Open"
                },
                {
                    id: 9,
                    name: "Basketball Championship",
                    type: "Team",
                    description: "Inter-college basketball tournament",
                    date: "April 8-10, 2025",
                    venue: "Basketball Court",
                    coordinator: "Coach Davis",
                    status: "Coming Soon"
                }
            ],
            literary: [
                {
                    id: 10,
                    name: "Debate Championship",
                    type: "Team",
                    description: "Parliamentary style debate competition",
                    date: "March 20, 2025",
                    venue: "Conference Hall",
                    coordinator: "Prof. Brown",
                    status: "Open"
                },
                {
                    id: 11,
                    name: "Essay Writing Contest",
                    type: "Solo",
                    description: "Creative writing on current topics",
                    date: "March 21, 2025",
                    venue: "Library Hall",
                    coordinator: "Dr. Wilson",
                    status: "Open"
                }
            ],
            business: [
                {
                    id: 12,
                    name: "Startup Pitch Competition",
                    type: "Team",
                    description: "Present your business idea to investors",
                    date: "April 15, 2025",
                    venue: "Business Center",
                    coordinator: "Prof. Miller",
                    status: "Open"
                },
                {
                    id: 13,
                    name: "Case Study Analysis",
                    type: "Team",
                    description: "Analyze real business scenarios",
                    date: "April 16, 2025",
                    venue: "Seminar Hall",
                    coordinator: "Dr. Taylor",
                    status: "Open"
                }
            ],
            science: [
                {
                    id: 14,
                    name: "Science Fair",
                    type: "Solo",
                    description: "Showcase scientific projects and innovations",
                    date: "May 1, 2025",
                    venue: "Science Block",
                    coordinator: "Dr. Anderson",
                    status: "Open"
                },
                {
                    id: 15,
                    name: "Research Paper Presentation",
                    type: "Solo",
                    description: "Present original research work",
                    date: "May 2, 2025",
                    venue: "Research Center",
                    coordinator: "Prof. White",
                    status: "Open"
                }
            ]
        };
        
        // Load sub-events based on category
        function loadSubEvents() {
            const categoryTitle = document.getElementById('categoryTitle');
            const container = document.getElementById('subEventsContainer');
            
            categoryTitle.textContent = category.charAt(0).toUpperCase() + category.slice(1) + ' Events';
            
            const events = subEvents[category] || [];
            
            container.innerHTML = events.map(event => `
                <div class="card">
                    <h3>${event.name}</h3>
                    <p><strong>Type:</strong> ${event.type}</p>
                    <p><strong>Date:</strong> ${event.date}</p>
                    <p><strong>Venue:</strong> ${event.venue}</p>
                    <p><strong>Coordinator:</strong> ${event.coordinator}</p>
                    <p>${event.description}</p>
                    <div style="margin-top: 1rem;">
                        <span class="badge ${getStatusClass(event.status)}">${event.status}</span>
                    </div>
                    <button class="btn mt-1" onclick="viewEventDetails(${event.id})" 
                            ${event.status === 'Registration Closed' ? 'disabled' : ''}>
                        View Details
                    </button>
                </div>
            `).join('');
        }
        
        function getStatusClass(status) {
            switch(status) {
                case 'Open': return 'badge-success';
                case 'Coming Soon': return 'badge-warning';
                case 'Registration Closed': return 'badge-danger';
                default: return 'badge-info';
            }
        }
        
        function viewEventDetails(eventId) {
            window.location.href = `event.php?id=${eventId}`;
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            window.location.href = 'home.php';
        }
        
        // Load events when page loads
        loadSubEvents();
    </script>
</body>
</html>
