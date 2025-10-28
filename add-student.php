<?php require_once 'config.php'; ?>

<?php
$editid = $_GET['editid'] ?? "";
$academicyear = $_GET['academicyear'] ;
if (isset($_POST['getStudent'])) {
    $academicYear = $_POST['academicYear'];
    $enro = $_POST['enro'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $emailid = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $pincode = $_POST['pincode'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $division = $_POST['division'];

    if ($editid) {
        // --- Step 1: Check if the city exists ---
        $checkCity = "SELECT id FROM tblcity WHERE city='$city' AND state='$state' AND country='$country' LIMIT 1";
        $result = mysqli_query($connect, $checkCity);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $cityid = $row['id'];
        } else {
            $insertCity = "INSERT INTO tblcity(city, state, country) VALUES('$city', '$state', '$country')";
            if (!mysqli_query($connect, $insertCity)) {
                die("Error inserting city in update: " . mysqli_error($connect));
            }
            $cityid = mysqli_insert_id($connect);
        }

        // --- Step 2: Update student and user ---
        $query = "UPDATE tbluser u 
                  JOIN tblstudent s ON u.id = s.userid 
                  JOIN tblsemesterdivision sd ON s.semdivid = sd.id 
                  SET 
                      u.departmentid = '$department',
                      u.fname = '$fname',
                      u.lname = '$lname',
                      u.address = '$address',
                      u.pincode = '$pincode',
                      u.cityid = '$cityid',
                      u.gender = '$gender',
                      u.dob = '$dob',
                      u.contact = '$contact',
                      u.emailid = '$emailid',
                      u.password = '$password',
                      sd.semesterid = '$semester',
                      sd.divisionid = '$division',
                      sd.academicyearid = '$academicyear'
                  WHERE s.enro = '$editid'";

        if (!mysqli_query($connect, $query)) {
            die("Error in UPDATE query: " . mysqli_error($connect));
        }
    } else {
        $checkCity = "SELECT id FROM tblcity WHERE city='$city' AND state='$state' AND country='$country' LIMIT 1";
        $result = mysqli_query($connect, $checkCity);

        if (mysqli_num_rows($result) > 0) {
            // City already exists → reuse its ID
            $row = mysqli_fetch_assoc($result);
            $cityid = $row['id'];
        } else {
            // City not found → insert new one
            $insertCity = "INSERT INTO tblcity(city, state, country) VALUES('$city', '$state', '$country')";
            if (!mysqli_query($connect, $insertCity)) {
                die("Error inserting city: " . mysqli_error($connect));
            }
            $cityid = mysqli_insert_id($connect);
        }

        $query1 = "INSERT INTO tbluser(departmentid, fname, lname, address, pincode, cityid, gender, dob, contact, emailid, password) VALUES('$department', '$fname', '$lname', '$address', '$pincode', '$cityid', '$gender', '$dob', '$contact', '$emailid', '$password')";
        if (!mysqli_query($connect, $query1)) {
            die("Error in tbluser INSERT: " . mysqli_error($connect));
        }
        $userid = mysqli_insert_id($connect);

        $query2 = "INSERT INTO tblsemesterdivision(semesterid, divisionid, academicyearid) VALUES('$semester', '$division', '$academicyear')";
        if (!mysqli_query($connect, $query2)) {
            die("Error in tblsemesterdivision INSERT: " . mysqli_error($connect));
        }
        $semdivid = mysqli_insert_id($connect);

        $query3 = "INSERT INTO tblstudent VALUES('$enro', '$userid', '$semdivid')";
        if (!mysqli_query($connect, $query3)) {
            die("Error in tblstudent INSERT: " . mysqli_error($connect));
        }
    }
    header("Location: manage-student.php");
}
?>

<?php
if (isset($editid)) {
    $query = "SELECT 
    u.password, u.fname, u.lname, u.gender, u.dob, u.emailid, u.contact, u.address, u.cityid, 
    c.city, c.state, c.country, u.pincode, 
    d.id AS department_id, d.name AS department_name, 
    i.id AS institute_id, i.name AS institute_name, 
    sem.name AS semester_name, divi.name AS division_name 
FROM tbluser u 
JOIN tblstudent s ON u.id = s.userid 
JOIN tblcity c ON u.cityid = c.id 
JOIN tbldepartment d ON u.departmentid = d.id 
JOIN tblinstitute i ON d.instituteid = i.id 
JOIN tblsemesterdivision sd ON s.semdivid = sd.id 
JOIN tblsemester sem ON sd.semesterid = sem.id 
JOIN tbldivision divi ON sd.divisionid = divi.id 
WHERE s.enro = '$editid'";

    $q = mysqli_query($connect, $query) or die("Query failed: " . mysqli_error($connect));

    while ($r = mysqli_fetch_assoc($q)) {
        $editpassword = $r['password'];
        $editfname = $r['fname'];
        $editlname = $r['lname'];
        $editgender = $r['gender'];
        $editdob = $r['dob'];
        $editemailid = $r['emailid'];
        $editcontact = $r['contact'];
        $editaddress = $r['address'];
        $editcityid = $r['cityid'];
        $editcity = $r['city'];
        $editstate = $r['state'];
        $editcountry = $r['country'];
        $editpincode = $r['pincode'];
        $editsemester = $r['semester_name'];
        $editdivision = $r['division_name'];

        $editinstitute = $r['institute_name'];
        $editinstituteid = $r['institute_id'];
        $editdepartment = $r['department_name'];
        $editdepartmentid = $r['department_id'];
    }
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Student - IEMS</title>
        <link rel="stylesheet" href="styles.css">

        <!-- Font Awesome (for eye icons) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            .password-wrapper {
                position: relative;
                width: 100%;
            }

            .password-wrapper input {
                width: 100%;
                padding-right: 40px; /* space for the eye icon */
            }

            .password-wrapper i {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                color: #666;
            }
        </style>
    </head>
    <body>
        <div class="dashboard-container">
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1 id="pageTitle">Add Student</h1>
                    <div>
                        <button class="btn btn-secondary" onclick="window.location.href = 'manage-student.php'">Back to List</button>
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
                                <input type="text" id="enrollment" name="enro" class="form-control" value="<?php echo $editid ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="password-wrapper">
                                    <input type="password" id="password" name="password" class="form-control" value="<?php echo $editpassword ?? ''; ?>" required>
                                    <i id="eyeIcon" class="fa fa-eye" onclick="togglePassword()"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="fname" class="form-control" value="<?php echo $editfname ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="lname" class="form-control" value="<?php echo $editlname ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="m" <?php echo ($editgender ?? "") == "m" ? "selected" : ""; ?>>Male</option>
                                    <option value="f" <?php echo ($editgender ?? "") == "f" ? "selected" : ""; ?>>Female</option>
                                    <option value="o" <?php echo ($editgender ?? "") == "o" ? "selected" : ""; ?>>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dateOfBirth">Date of Birth</label>
                                <input type="date" id="dateOfBirth" name="dob" class="form-control" value="<?php echo $editdob ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $editemailid ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contactNumber">Contact Number</label>
                                <input type="tel" id="contactNumber" name="contact" class="form-control" value="<?php echo $editcontact ?? ''; ?>" required>
                            </div>                            
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea id="address" name="address" class="form-control" rows="2" required><?php echo $editaddress ?? ''; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <select id="city" name="city" class="form-control" required>
                                    <option value="">--- Select City ---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <select id="state" name="state" class="form-control" onchange="getData1(this.value)" required>
                                    <option value="">--- Select State ---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select id="country" name="country" class="form-control" onchange="getData(this.value)" required>
                                    <option value="">--- Select Country ---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pincode">Pincode</label>
                                <input type="text" id="pincode" name="pincode" class="form-control" value="<?php echo $editpincode ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="institute">Institute</label>                                
                                <select id="institute" name="institute" class="form-control" onchange="getData2(this.value)" required>
                                    <option value="">--- Select Institute ---</option>
                                    <?php
                                    $query = "SELECT id, name FROM tblinstitute WHERE academicyearid='$academicyear' ORDER BY name";
                                    $q = mysqli_query($connect, $query);
                                    while ($a = mysqli_fetch_assoc($q)) {
                                        $selected = ($a['id'] == $editinstituteid) ? "selected" : ""; // compare IDs, not names
                                        echo "<option value='{$a['id']}' $selected>{$a['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>                                
                                <select id="department" name="department" class="form-control" required>
                                    <option value="">--- Select Department ---</option>
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
                                        $selected = ($a[1] == $editsemester) ? "selected" : "";
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
                                        $selected = ($a[1] == $editdivision) ? "selected" : "";
                                        echo "<option value='$a[0]'$selected>$a[1]</option>";
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
            function toggleDropdown(dropdownId) {
                const dropdown = document.getElementById(dropdownId + '-dropdown');
                dropdown.classList.toggle('show');
            }
        </script>

        //This code is for password eye icon.
        <script>
            function togglePassword() {
                const passwordField = document.getElementById("password");
                const eyeIcon = document.getElementById("eyeIcon");

                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                } else {
                    passwordField.type = "password";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                }
            }
        </script>

        <script>
            function getData2(institute, selectedDept = "") {
                if (!institute) {
                    document.getElementById('department').innerHTML = "<option value=''>Select Department</option>";
                    return;
                }
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "department.php?institute=" + encodeURIComponent(institute) + "&selected=" + encodeURIComponent(selectedDept), true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        document.getElementById('department').innerHTML = xhr.responseText;

                        // Make sure the selection happens after DOM update
                        if (selectedDept) {
                            document.getElementById('department').value = selectedDept;
                        }
                    }
                };
                xhr.send();
            }
        </script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editInstitute = "<?php echo $editinstituteid ?? ''; ?>";
            const editDepartment = "<?php echo $editdepartmentid ?? ''; ?>";

            if (editInstitute) {
                // Auto-load departments for selected institute
                getData2(editInstitute, editDepartment);
            }
        });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", async function () {
                const countryEl = document.getElementById('country');
                const stateEl = document.getElementById('state');
                const cityEl = document.getElementById('city');

                const editCountry = "<?php echo $editcountry ?? ''; ?>";
                const editState = "<?php echo $editstate ?? ''; ?>";
                const editCity = "<?php echo $editcity ?? ''; ?>"; // use city name, not ID

                // Helper function: POST JSON
                async function postJson(url, body) {
                    const resp = await fetch(url, {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify(body)
                    });
                    if (!resp.ok)
                        throw new Error('Network error');
                    return resp.json();
                }

                // 1️⃣ Load countries
                async function loadCountries() {
                    countryEl.innerHTML = '<option>Loading countries...</option>';
                    const resp = await fetch('https://countriesnow.space/api/v0.1/countries/positions');
                    const json = await resp.json();
                    countryEl.innerHTML = '<option value="">--- Select Country ---</option>';
                    json.data.forEach(c => {
                        const name = c.name || c.country;
                        const opt = document.createElement('option');
                        opt.value = name;
                        opt.textContent = name;
                        countryEl.appendChild(opt);
                    });

                    // if editing -> preselect
                    if (editCountry) {
                        countryEl.value = editCountry;
                        await loadStates(editCountry);
                    }
                }

                // 2️⃣ Load states
                async function loadStates(country) {
                    stateEl.innerHTML = '<option>Loading states...</option>';
                    const json = await postJson('https://countriesnow.space/api/v0.1/countries/states', {country});
                    stateEl.innerHTML = '<option value="">--- Select State ---</option>';
                    json.data.states.forEach(s => {
                        const opt = document.createElement('option');
                        opt.value = s.name;
                        opt.textContent = s.name;
                        stateEl.appendChild(opt);
                    });

                    // if editing -> preselect state and load cities
                    if (editState && country === editCountry) {
                        stateEl.value = editState;
                        await loadCities(editCountry, editState);
                    }
                }

                // 3️⃣ Load cities
                async function loadCities(country, state) {
                    cityEl.innerHTML = '<option>Loading cities...</option>';
                    const json = await postJson('https://countriesnow.space/api/v0.1/countries/state/cities', {country, state});
                    cityEl.innerHTML = '<option value="">--- Select City ---</option>';
                    json.data.forEach(city => {
                        const opt = document.createElement('option');
                        opt.value = city;
                        opt.textContent = city;
                        cityEl.appendChild(opt);
                    });

                    if (editCity && state === editState) {
                        cityEl.value = editCity;
                    }
                }

                // 4️⃣ Event listeners for manual changes
                countryEl.addEventListener('change', e => loadStates(e.target.value));
                stateEl.addEventListener('change', e => loadCities(countryEl.value, e.target.value));

                // Start
                await loadCountries();
            });
        </script>
        
        <?php
        // Delete all cities not linked to any user
        $query = "DELETE FROM tblcity WHERE id NOT IN (SELECT DISTINCT cityid FROM tbluser)";
        if (mysqli_query($connect, $query)) {
        } else {
            echo "Error deleting unused cities: " . mysqli_error($connect);
        }
        ?>

    </body>
</html>