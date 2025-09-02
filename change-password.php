<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - IEMS</title>
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
                <a href="student-profile.php" style="color: #667eea; text-decoration: none;">&larr; Back to Profile</a>
            </div>
            
            <div class="form-container">
                <h2 class="text-center mb-2">Change Password</h2>
                <p class="text-center mb-2" style="color: #666;">Enter your current password and new password</p>
                
                <form id="changePasswordForm">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn" style="width: 100%;">Change Password</button>
                    </div>
                    
                    <div class="text-center">
                        <a href="student-profile.php" style="color: #667eea; text-decoration: none;">Cancel</a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Institute Event Management System. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (newPassword !== confirmPassword) {
                alert('New passwords do not match. Please try again.');
                return;
            }
            
            if (newPassword.length < 6) {
                alert('New password must be at least 6 characters long.');
                return;
            }
            
            alert('Password changed successfully!');
            window.location.href = 'student-profile.php';
        });
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
