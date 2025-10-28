<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php
$editid = $_GET['editid'] ?? "";

if (isset($_POST['addAcadmicyear'])) {
    $acadmicyear = $_POST['acadmicyear'];
    
    if ($editid) {
        $query = "UPDATE tblacademicyear SET year = '$acadmicyear' WHERE id = '$editid'";
        mysqli_query($connect, $query);
        header('Location: manage-academic-year.php');
    } else {
        $query1 = "INSERT INTO tblacademicyear(year) VALUES('$acadmicyear')";
        mysqli_query($connect, $query1);
        header("Location: manage-academic-year.php");
    }
}
?>

<?php
if (isset($editid)) {
    $query = "SELECT * FROM tblacademicyear WHERE id = '$editid'";
    $q = mysqli_query($connect, $query) or die("Query failed: " . mysqli_error($connect));

    while ($r = mysqli_fetch_row($q)) {
        $editacadmicyear = $r[1];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Academic Year - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1 id="pageTitle">Add Academic Year</h1>
                    <div>
                        <button class="btn btn-secondary" onclick="window.location.href = 'manage-academic-year.php'">Back to List</button>
                    </div>
                </div>

                <!-- Department Form -->
                <div class="card">
                    <h3 id="formTitle">Add New Academic Year</h3>
                    <form id="acadmicyearForm" method="post">
                        <div class="form-group">
                            <label for="acadmicyear">Academic Year</label>
                            <input type="text" id="acadmicyear" name="acadmicyear" class="form-control" value="<?php echo $editacadmicyear ?? ''; ?>" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="addAcadmicyear" class="btn" id="submitBtn"><?php echo !empty($editid) ? 'Update' : 'Add'; ?></button>
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
                    document.getElementById('pageTitle').textContent = 'Edit Department';
                    document.getElementById('formTitle').textContent = 'Edit Department';
                    document.getElementById('submitBtn').textContent = 'Update Department';

                    // Load department data for editing (in real app, this would fetch from database)
                    loadDepartmentData(editId);
                }
            };

            function loadDepartmentData(id) {
                // Mock data - in real application, this would fetch from database
                const departments = {
                    '1': {name: 'Computer Science', institute: '1'},
                    '2': {name: 'Information Technology', institute: '1'}
                };

                if (departments[id]) {
                    document.getElementById('deptName').value = departments[id].name;
                    document.getElementById('institute').value = departments[id].institute;
                }
            }

            function toggleDropdown(dropdownId) {
                const dropdown = document.getElementById(dropdownId + '-dropdown');
                dropdown.classList.toggle('show');
            }

            document.getElementById('departmentForm').addEventListener('submit', function (e) {
                e.preventDefault();

                if (isEditMode) {
                    alert('Department updated successfully!');
                } else {
                    alert('Department added successfully!');
                }

                window.location.href = 'department.php';
            });

            function logout() {
                localStorage.removeItem('userLoggedIn');
                localStorage.removeItem('userRole');
                window.location.href = 'home.php';
            }
        </script>
    </body>
</html>
