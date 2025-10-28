<?php require_once 'config.php'; ?>

<?php
$editid = $_GET['editid'] ?? "";
$academicyear = $_GET['academicyear'];

if (isset($_POST['getFaculty'])) {
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

    if($editid){
        
    } else {
        $query1 = "INSERT INTO tbluser(departmentid, fname, lname, address, cityid, gender, dob, contact, emailid, password) VALUES('$department', '$fname', '$lname', '$address', '$city', '$gender', '$dob', '$contact', '$mail', '$password');";
        mysqli_query($connect, $query1);

        $userid = mysqli_insert_id($connect);

        $query2 = "INSERT INTO tblfaculty (userid, dateofjoining, designation) VALUES('$userid', '$doj', '$designation')";
        mysqli_query($connect, $query2);
    }
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
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1 id="pageTitle">Add Faculty</h1>
                    <div>
                        <button class="btn btn-secondary" onclick="window.location.href = 'manage-faculty.php'">Back to List</button>
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
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <select id="state" name="state" id="state" class="form-control" onchange="getData1(this.value)" required>
                                    <option value="">--- Select State ---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select id="country" name="country" class="form-control" onchange="getData(this.value)" required>
                                    <option value="">--- Select Country ---</option>
                                    <?php
                                    $query = "SELECT id, country FROM tblcity GROUP BY country ORDER BY country";
                                    $q = mysqli_query($connect, $query);
                                    while ($a = mysqli_fetch_row($q)) {
                                        $selected = ($a[1] == $editcountry) ? "selected" : "";
                                        echo "<option value='$a[1]' $selected>$a[1]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pincode">Pincode</label>
                                <input type="text" id="pincode" name="pincode" class="form-control" required>
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
            function toggleDropdown(dropdownId) {
                const dropdown = document.getElementById(dropdownId + '-dropdown');
                dropdown.classList.toggle('show');
            }
        </script>
        
        <script>
            function getData2(institute){
                if(institute == ""){
                    document.getElementById('department').innerHTML = "<option value=''>Select Department</option>";
                    return;
                }
                let obj = new XMLHttpRequest();
                obj.open("get", "department.php?institute="+institute, true);
                obj.send();
                obj.onreadystatechange = function(){
                    if(obj.readyState === 4 && obj.status === 200){
                        document.getElementById('department').innerHTML = obj.responseText;
                    }
                };
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
