<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php
$uno = $_SESSION['username'];
$query = "SELECT s.enro, u.fname, u.lname, u.gender, u.dob, u.emailid, u.contact, u.address, c.city, c.state, c.country, u.pincode, d.name AS department, sem.name AS semester, divi.name AS division FROM tblstudent s JOIN tbluser u ON s.userid = u.id JOIN tblcity c ON u.cityid = c.id JOIN tbldepartment d ON u.departmentid = d.id JOIN tblsemester sem ON s.semesterid = sem.id JOIN tbldivision divi ON s.divisionid = divi.id WHERE s.enro = $uno;";
$q = mysqli_query($connect, $query);
if ($q && mysqli_num_rows($q) > 0) {
    $r = mysqli_fetch_assoc($q);
} else {
    echo mysqli_error($connect);
}
?>

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
                <li><a href="home.php">Home</a></li>
                <li><a href="student-dashboard.php">Dashboard</a></li>
                <li><a href="student-profile.php" class="active">Profile</a></li>
                <li><a href="event-category.php">Explore Events</a></li>
                <li><a href="student-myevents.php">My Events</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
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
                                <input type="text" id="enrollmentNumber" name="enrollmentNumber" class="form-control" value="<?php echo $r['enro'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $r['fname'] ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $r['lname'] ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="male" <?php echo ($r['gender'] ?? "") == "m" ? "selected" : ""; ?>>Male</option>
                                    <option value="female" <?php echo ($r['gender'] ?? "") == "f" ? "selected" : ""; ?>>Female</option>
                                    <option value="other" <?php echo ($r['gender'] ?? "") == "o" ? "selected" : ""; ?>>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="dob" class="form-control" value="<?php echo $r['dob'] ?? ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $r['emailid'] ?? ''; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="contactNumber">Contact Number</label>
                                <input type="tel" id="contactNumber" name="contactNumber" class="form-control" value="<?php echo $r['contact'] ?? ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea id="address" name="address" class="form-control" rows="2"><?php echo $r['address'] ?? ''; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <select id="city" name="city" class="form-control" required>
                                    <option value="">--- Select City ---</option>
                                    <?php
                                    $query = "SELECT id, city FROM tblcity GROUP BY city ORDER BY city";
                                    $q = mysqli_query($connect, $query);
                                    while ($a = mysqli_fetch_row($q)) {
                                        $selected = ($a[1] == $r['city']) ? "selected" : "";
                                        echo "<option value='$a[0]' $selected>$a[1]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <select id="state" name="state" class="form-control" required>
                                    <option value="">--- Select State ---</option>
                                    <?php
                                    $query = "SELECT id, state FROM tblcity GROUP BY state ORDER BY state";
                                    $q = mysqli_query($connect, $query);
                                    while ($a = mysqli_fetch_row($q)) {
                                        $selected = ($a[1] == $r['state']) ? "selected" : "";
                                        echo "<option value='$a[0]' $selected>$a[1]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select id="country" name="country" class="form-control" required>
                                    <option value="">--- Select Country ---</option>
                                    <?php
                                    $query = "SELECT id, country FROM tblcity GROUP BY country ORDER BY country";
                                    $q = mysqli_query($connect, $query);
                                    while ($a = mysqli_fetch_row($q)) {
                                        $selected = ($a[1] == $r['country']) ? "selected" : "";
                                        echo "<option value='$a[0]' $selected>$a[1]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pincode">Pincode</label>
                                <input type="text" id="pincode" name="pincode" class="form-control" value="<?php echo $r['pincode'] ?? ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select id="department" name="department" class="form-control" required>
                                    <option value="">--- Select Department ---</option>
                                    <?php
                                    $query = "SELECT id, name FROM tbldepartment ORDER BY name";
                                    $q = mysqli_query($connect, $query);
                                    while ($a = mysqli_fetch_row($q)) {
                                        $selected = ($a[1] == $r['department']) ? "selected" : "";
                                        echo "<option value='$a[0]' $selected>$a[1]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select id="semester" name="semester" class="form-control" required>
                                    <option value="">--- Select Semester ---</option>
                                    <?php
                                    $query = "SELECT id, name FROM tblsemester ORDER BY name";
                                    $q = mysqli_query($connect, $query);
                                    while ($a = mysqli_fetch_row($q)) {
                                        $selected = ($a[1] == $r['semester']) ? "selected" : "";
                                        echo "<option value='" . $a[0] . "' $selected>Semester " . $a[1] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="division">Division</label>
                                <select id="division" name="division" class="form-control" required>
                                    <option value="">--- Select Division ---</option>
                                    <?php
                                    $query = "SELECT id, name FROM tbldivision ORDER BY name";
                                    $q = mysqli_query($connect, $query);
                                    while ($a = mysqli_fetch_row($q)) {
                                        $selected = ($a[1] == $r['division']) ? "selected" : "";
                                        echo "<option value='$a[0]'$selected>$a[1]</option>";
                                    }
                                    ?>
                                </select>
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
            document.getElementById('profileForm').addEventListener('submit', function (e) {
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
