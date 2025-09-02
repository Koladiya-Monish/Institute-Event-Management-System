<?php require_once 'config.php'; ?>

<?php
if (isset($_POST['getFaculty'])){
    $facultyid = $_POST['facultyid'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $mail = $_POST['email'];
    $contact = $_POST['contact'];    
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $pincode = $_POST['pincode'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $doj = $_POST['doj'];
    
    $query1 = "INSERT INTO tbluser(departmentid, fname, lname, address, cityid, gender, dob, contact, emailid, password) VALUES('$department', '$fname', '$lname', '$address', '$city', '$gender', '$dob', '$contact', '$mail', '$password')";
    mysqli_query($connect, $query1);

    $userid = mysqli_insert_id($connect);

    $query2 = "INSERT INTO tblfaculty VALUES('$facultyid', '$userid', '$doj', '$designation')";
    mysqli_query($connect, $query2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Faculty - IEMS</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <h3>Admin Portal</h3>
            <ul class="sidebar-menu">
                <li><a href="admin-dashboard.php">Dashboard</a></li>
                <li><a href="institute.php">Manage Institute</a></li>
                <li><a href="department.php">Manage Department</a></li>
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown('users')" class="dropdown-toggle">Manage Users ▼</a>
                    <ul class="dropdown-menu" id="users-dropdown">
                        <li><a href="manage-student.php">Students</a></li>
                        <li><a href="manage-faculty.php" class="active">Faculty</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown('events')" class="dropdown-toggle">Manage Events ▼</a>
                    <ul class="dropdown-menu" id="events-dropdown">
                        <li><a href="admin-event-category.php">Category</a></li>
                        <li><a href="admin-event-subcategory.php">Sub-Category</a></li>
                    </ul>
                </li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="home.php" onclick="logout()">Logout</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1 id="pageTitle">Add Faculty</h1>
                <div>
                    <button class="btn btn-secondary" onclick="window.location.href='manage-faculty.php'">Back to List</button>
                </div>
            </div>

            <!-- Faculty Form -->
            <div class="card">
                <h3 id="formTitle">Add New Faculty</h3>
                <form id="facultyForm" method="POST">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div class="form-group">
                            <label for="facultyId">Faculty Id</label>
                            <input type="text" name="facultyid" id="facultyId" name="facultyId" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="fname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateOfBirth">Date of Birth</label>
                            <input type="date" id="dateOfBirth" name="dob" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number</label>
                            <input type="tel" id="contactNumber" name="contact" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <select id="city" name="city" class="form-control" required>
                                <option value="">--- Select City ---</option>
                                <?php
                                $query = "SELECT id, city FROM tblcity GROUP BY city ORDER BY city";
                                $q = mysqli_query($connect, $query);
                                while ($a = mysqli_fetch_row($q)) {
                                    echo "<option value='$a[0]'>$a[1]</option>";
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
                                    echo "<option value='$a[0]'>$a[1]</option>";
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
                                    echo "<option value='$a[0]'>$a[1]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="text" id="pincode" name="pincode" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>                                
                            <select id="department" name="department" class="form-control" required>
                                <option value="">--- Select Department ---</option>
                                <?php
                                $query = "SELECT id, name FROM tbldepartment ORDER BY name";
                                $q = mysqli_query($connect, $query);
                                while ($a = mysqli_fetch_row($q)) {
                                    echo "<option value='$a[0]'>$a[1]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <select id="designation" name="designation" class="form-control" required>
                                <option value="">Select Designation</option>
                                <option value="professor">Professor</option>
                                <option value="associate">Associate Professor</option>
                                <option value="assistant">Assistant Professor</option>
                                <option value="lecturer">Lecturer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dateOfJoining">Date of Joining</label>
                            <input type="date" id="dateOfJoining" name="doj" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="text-center" style="margin-top: 2rem;">
                        <button type="submit" name="getFaculty" class="btn" id="submitBtn">Add Faculty</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <style>
        .dropdown {
            position: relative;
        }
        
        .dropdown-toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dropdown-menu {
            display: none;
            list-style: none;
            margin: 0.5rem 0 0 1rem;
            padding: 0;
        }
        
        .dropdown-menu.show {
            display: block;
        }
        
        .dropdown-menu li {
            margin-bottom: 0.25rem;
        }
        
        .dropdown-menu a {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    </style>

    <script>
        let isEditMode = false;
        let editId = null;

        // Check if we're in edit mode
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            editId = urlParams.get('id');
            
            if (editId) {
                isEditMode = true;
                document.getElementById('pageTitle').textContent = 'Edit Faculty';
                document.getElementById('formTitle').textContent = 'Edit Faculty';
                document.getElementById('submitBtn').textContent = 'Update Faculty';
                
                // Load faculty data for editing (in real app, this would fetch from database)
                loadFacultyData(editId);
            }
        };

        function loadFacultyData(id) {
            // Mock data - in real application, this would fetch from database
            const faculty = {
                'FAC001': {
                    facultyId: 'FAC001',
                    firstName: 'John',
                    lastName: 'Smith',
                    gender: 'male',
                    dateOfBirth: '1980-05-15',
                    email: 'john.smith@faculty.edu',
                    contactNumber: '9876543210',
                    address: '456 Faculty Lane',
                    city: 'Mumbai',
                    state: 'Maharashtra',
                    country: 'India',
                    pincode: '400002',
                    department: '1',
                    designation: 'professor',
                    dateOfJoining: '2015-08-01'
                }
            };
            
            if (faculty[id]) {
                const facultyData = faculty[id];
                Object.keys(facultyData).forEach(key => {
                    const element = document.getElementById(key);
                    if (element) {
                        element.value = facultyData[key];
                    }
                });
            }
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId + '-dropdown');
            dropdown.classList.toggle('show');
        }
        
//        document.getElementById('facultyForm').addEventListener('submit', function(e) {
//            e.preventDefault();
//            
//            if (isEditMode) {
//                alert('Faculty updated successfully!');
//            } else {
//                alert('Faculty added successfully!');
//            }
//            
//            window.location.href = 'manage-faculty.php';
//        });
        
        function logout() {
            localStorage.removeItem('userLoggedIn');
            localStorage.removeItem('userRole');
            window.location.href = 'home.php';
        }
    </script>
</body>
</html>
