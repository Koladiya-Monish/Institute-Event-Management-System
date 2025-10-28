<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Feedback - IEMS</title>
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
            
            <div class="form-container">
                <h2 class="text-center mb-2">Event Feedback</h2>
                <p class="text-center mb-2" style="color: #666;">Share your experience and help us improve</p>
                
                <form id="feedbackForm">
                    <div class="form-group">
                        <label for="eventName">Event Name</label>
                        <input type="text" id="eventName" name="eventName" class="form-control" value="Classical Dance Competition" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="rating">Overall Rating</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center; margin-top: 0.5rem;">
                            <div class="rating-stars">
                                <span class="star" data-rating="1">★</span>
                                <span class="star" data-rating="2">★</span>
                                <span class="star" data-rating="3">★</span>
                                <span class="star" data-rating="4">★</span>
                                <span class="star" data-rating="5">★</span>
                            </div>
                            <span id="ratingText" style="margin-left: 1rem; color: #666;">Select a rating</span>
                        </div>
                        <input type="hidden" id="rating" name="rating" required>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="comments">Comments & Suggestions</label>
                        <textarea id="comments" name="comments" class="form-control" rows="5" placeholder="Share your detailed feedback, suggestions for improvement, or any issues you faced..."></textarea>
                    </div>
                    
                    
                    <div class="form-group">
                        <button type="submit" class="btn" style="width: 100%;">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
    </footer>

    <style>
        .rating-stars {
            display: flex;
            gap: 0.25rem;
        }
        
        .star {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        
        .star:hover,
        .star.active {
            color: #ffd700;
        }
    </style>

    <script>
        // Star rating functionality
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');
        const ratingText = document.getElementById('ratingText');
        
        const ratingLabels = {
            1: 'Poor',
            2: 'Fair', 
            3: 'Good',
            4: 'Very Good',
            5: 'Excellent'
        };
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                ratingInput.value = rating;
                ratingText.textContent = ratingLabels[rating];
                
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });
            
            star.addEventListener('mouseover', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.style.color = '#ffd700';
                    } else {
                        s.style.color = '#ddd';
                    }
                });
            });
        });
        
        document.querySelector('.rating-stars').addEventListener('mouseleave', function() {
            const currentRating = parseInt(ratingInput.value) || 0;
            stars.forEach((s, index) => {
                if (index < currentRating) {
                    s.style.color = '#ffd700';
                } else {
                    s.style.color = '#ddd';
                }
            });
        });
        
        // Form submission
        document.getElementById('feedbackForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const rating = document.getElementById('rating').value;
            if (!rating) {
                alert('Please provide an overall rating.');
                return;
            }
            
            alert('Thank you for your feedback! Your response has been submitted successfully.');
            window.history.back();
        });
        
        // Get event from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const eventId = urlParams.get('eventId');
        
        const eventNames = {
            '1': 'Code Marathon',
            '2': 'Web Development Challenge',
            '4': 'Classical Dance Competition',
            '7': 'Cricket Tournament'
        };
        
        if (eventId && eventNames[eventId]) {
            document.getElementById('eventName').value = eventNames[eventId];
        }
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
