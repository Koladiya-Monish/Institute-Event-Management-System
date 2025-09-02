<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h3>Student Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="student-dashboard.php">Dashboard</a></li>
                <li><a href="student-profile.php" class="active">Profile</a></li>
                <li><a href="event-category.php">Explore Events</a></li>
                <li><a href="student-myevents.php">My Events</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="margin-bottom: 2rem;">
                <h1>My Profile</h1>
                <p style="color: #666;">View and update your personal information</p>
            </div>

            <div class="card">
                <form id="profileForm">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                        <div class="form-group">
                            <label for="enrollmentNumber">Enrollment Number</label>
                            <input type="text" id="enrollmentNumber" name="enrollmentNumber" class="form-control" value="2023CS001" readonly>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="form-control" value="John" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" class="form-control" value="Doe" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" class="form-control" value="2002-05-15">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" value="student@institute.edu" readonly>
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number</label>
                            <input type="tel" id="contactNumber" name="contactNumber" class="form-control" value="+91 9876543210">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" class="form-control" rows="2">123 Main Street</textarea>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" value="Mumbai">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" class="form-control" value="Maharashtra">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" class="form-control" value="India">
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="text" id="pincode" name="pincode" class="form-control" value="400001">
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select id="department" name="department" class="form-control" disabled>
                                <option value="1" selected>Computer Science</option>
                                <option value="2">Information Technology</option>
                                <option value="3">Electronics</option>
                                <option value="4">Mechanical</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" id="semester" name="semester" class="form-control" value="6th Semester" readonly>
                        </div>
                        <div class="form-group">
                            <label for="division">Division</label>
                            <input type="text" id="division" name="division" class="form-control" value="A" readonly>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; justify-content: center;">
                        <button type="submit" class="btn">Update Profile</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Profile updated successfully!');
        });
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
