<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Profile - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <h3>Faculty Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="faculty-dashboard.php">Dashboard</a></li>
                <li><a href="faculty-profile.php" class="active">Profile</a></li>
                <li><a href="faculty-myevents.php">My Events</a></li>
                <li><a href="evaluation-criteria.php">Evaluation Criteria</a></li>
                <li><a href="evaluation.php">Evaluate Participants</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <main class="dashboard-content">
            <h1>My Profile</h1>
            
            <div class="card">
                <form id="profileForm">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div class="form-group">
                            <label for="facultyId">Faculty ID</label>
                            <input type="text" id="facultyId" class="form-control" value="FAC001" readonly>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" class="form-control" value="Dr. Smith" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" class="form-control" value="Johnson" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" class="form-control" required>
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date of Birth</label>
                            <input type="date" id="dateOfBirth" class="form-control" value="1985-03-15" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" value="smith@faculty.edu" readonly>
                        </div>
                        <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="tel" id="contact" class="form-control" value="+91 9876543210">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" class="form-control" rows="2">123 Faculty Colony, University Road</textarea>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" class="form-control" value="Mumbai">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" class="form-control" value="Maharashtra">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" class="form-control" value="India">
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="text" id="pincode" class="form-control" value="400001">
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select id="department" class="form-control" disabled>
                                <option value="1" selected>Computer Science</option>
                                <option value="2">Information Technology</option>
                                <option value="3">Electronics</option>
                                <option value="4">Mechanical</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" id="designation" class="form-control" value="Professor" readonly>
                        </div>
                        <div class="form-group">
                            <label for="joiningDate">Date of Joining</label>
                            <input type="date" id="joiningDate" class="form-control" value="2020-01-15" readonly>
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
