<?php require_once 'config.php'; ?>

<?php
if (isset($_POST['getStudent'])) {
    $academicYear = $_POST['academicYear'];
    $enro = $_POST['enro'];
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
    $semester = $_POST['semester'];
    $division = $_POST['division'];

    $query1 = "INSERT INTO tbluser(departmentid, fname, lname, address, cityid, gender, dob, contact, emailid, password) VALUES('$department', '$fname', '$lname', '$address', '$city', '$gender', '$dob', '$contact', '$mail', '$password')";
    mysqli_query($connect, $query1);

    $userid = mysqli_insert_id($connect);

    $query2 = "INSERT INTO tblstudent VALUES('$enro', '$userid', '$semester', '$division')";
    mysqli_query($connect, $query2);

//    $query1 = "INSERT INTO tbluser(departmentid, fname, lname, address, cityid, gender, dob, contact, emailid, password) 
//           VALUES('$department', '$fname', '$lname', '$address', '$city', '$gender', '$dob', '$contact', '$mail', '$password')";
//    
//    if (mysqli_query($connect, $query1)) {
//        echo "User inserted successfully.<br>";
//
//        $userid = mysqli_insert_id($connect);
//
//        $query2 = "INSERT INTO tblstudent VALUES('$enro', '$userid', '$semester', '$division')";
//        if (mysqli_query($connect, $query2)) {
//            echo "Student inserted successfully.";
//        } else {
//            echo "Error inserting student: " . mysqli_error($connect);
//        }
//    } else {
//        echo "Error inserting user: " . mysqli_error($connect);
//    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Student - IEMS</title>
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
                            <li><a href="manage-student.php" class="active">Students</a></li>
                            <li><a href="manage-faculty.php">Faculty</a></li>
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
                    <h1 id="pageTitle">Add Student</h1>                    
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1>Student Management</h1>
                    <div>
                        <form method="post">
                            <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>                            
                            <select  id="academicYear" name="academicYear" class="form-control" style="width: auto; display: inline-block;">  
<?php
$query = "SELECT id, year FROM tblacademicYear ORDER BY year DESC";
$q = mysqli_query($connect, $query);
while ($a = mysqli_fetch_row($q)) {
    echo "<option value='$a[0]'>$a[1]</option>";
}
?>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Student Form -->
                <div class="card">
                    <h3 id="formTitle">Add New Student</h3>
                    <form id="studentForm" method="POST">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                            <input type="hidden" name="academicYear" id="hiddenYear">
                            <div class="form-group">
                                <label for="enrollment">Enrollment No</label>
                                <input type="text" id="enrollment" name="enro" class="form-control" required>
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
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                    <option value="o">Other</option>
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
                                <label for="semester">Semester</label>                                
                                <select id="semester" name="semester" class="form-control" required>
                                    <option value="">--- Select Semester ---</option>
                                    <?php
                                    $query = "SELECT id, name FROM tblsemester ORDER BY name";
                                    $q = mysqli_query($connect, $query);
                                    while ($a = mysqli_fetch_row($q)) {
                                        echo "<option value='" . $a[0] . "'>Semester " . $a[1] . "</option>";
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
                                        echo "<option value='$a[0]'>$a[1]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="text-center" style="margin-top: 2rem;">
                            <button type="submit" name="getStudent" class="btn" id="submitBtn">Add Student</button>
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
            window.onload = function () {
                const urlParams = new URLSearchParams(window.location.search);
                editId = urlParams.get('id');

                if (editId) {
                    isEditMode = true;
                    document.getElementById('pageTitle').textContent = 'Edit Student';
                    document.getElementById('formTitle').textContent = 'Edit Student';
                    document.getElementById('submitBtn').textContent = 'Update Student';

                    // Load student data for editing (in real app, this would fetch from database)
                    loadStudentData(editId);
                }
            };

            function loadStudentData(id) {
                // Mock data - in real application, this would fetch from database
                const students = {
                    '2023CS001': {
                        enrollment: '2023CS001',
                        firstName: 'John',
                        lastName: 'Doe',
                        gender: 'male',
                        email: 'john@student.edu',
                        contactNumber: '1234567890',
                        dateOfBirth: '2000-01-15',
                        address: '123 Main St',
                        city: 'Mumbai',
                        state: 'Maharashtra',
                        country: 'India',
                        pincode: '400001',
                        department: '1',
                        semester: '6',
                        division: 'A'
                    }
                };

                if (students[id]) {
                    const student = students[id];
                    Object.keys(student).forEach(key => {
                        const element = document.getElementById(key);
                        if (element) {
                            element.value = student[key];
                        }
                    });
                }
            }

            function toggleDropdown(dropdownId) {
                const dropdown = document.getElementById(dropdownId + '-dropdown');
                dropdown.classList.toggle('show');
            }

            //        document.getElementById('studentForm').addEventListener('submit', function(e) {
            //            e.preventDefault();
            //            
            //            if (isEditMode) {
            //                alert('Student updated successfully!');
            //            } else {
            //                alert('Student added successfully!');
            //            }
            //            
            //            window.location.href = 'manage-student.php';
            //        });

            function logout() {
                localStorage.removeItem('userLoggedIn');
                localStorage.removeItem('userRole');
                window.location.href = 'home.php';
            }
        </script>

        <script>
            document.getElementById("academicYear").addEventListener("change", function () {
                document.getElementById("hiddenYear").value = this.value;
            });


            window.onload = function () {
                document.getElementById("hiddenYear").value =
                        document.getElementById("academicYear").value;
            };
        </script>
    </body>
</html>
