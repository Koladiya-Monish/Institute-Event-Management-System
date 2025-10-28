<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php
$editid = $_GET['editid'] ?? "";

if (isset($_POST['getDepartment'])) {
    $departmentName = $_POST['departmentName'];
    $status = $_POST['status'];
    $instituteid = $_POST['instituteid'];
    
    if ($editid) {
        $query = "UPDATE tbldepartment SET name = '$departmentName' WHERE id = '$editid'";
        mysqli_query($connect, $query);
        header('Location: manage-department.php');
    } else {
        $query1 = "INSERT INTO tbldepartment(name, status, instituteid) VALUES('$departmentName', '$status', '$instituteid')";
        if (mysqli_query($connect, $query1)) {
            header("Location: manage-department.php");
        } else {
            echo "❌ Error: " . mysqli_error($connect);
        }
    }
}
?>

<?php
if (isset($editid)) {
    $query = "SELECT * FROM tbldepartment WHERE id = '$editid'";
    $q = mysqli_query($connect, $query) or die("Query failed: " . mysqli_error($connect));

    while ($r = mysqli_fetch_assoc($q)) {
        $editname = $r['name'];
        $editstatus = $r['status'];
        $editinstituteid = $r['instituteid'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Department - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1 id="pageTitle">Add Department</h1>
                    <div>
                        <button class="btn btn-secondary" onclick="window.location.href = 'manage-department.php'">Back to List</button>
                    </div>
                </div>

                <!-- Department Form -->
                <div class="card">
                    <h3 id="formTitle"><?php echo $editid ? 'Edit Department' : 'Add New Department'; ?></h3>
                    <form id="departmentForm" method="post">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="departmentName">Department Name</label>
                                <input type="text" id="departmentName" name="departmentName" class="form-control" value="<?php echo $editname ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <!--<input type="text" id="status" name="statua" class="form-control" value="<?php echo $editstatus ?? ''; ?>" required>-->
                                <select id="status" name="status" class="form-control" required>
                                    <option value="">--- Select Status ---</option>
                                    <option value="Active" <?php echo ($editstatus ?? "") == "Active" ? "selected" : ""; ?>>Active</option>
                                    <option value="Inactive" <?php echo ($editstatus ?? "") == "Active" ? "selected" : ""; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="institute">Select Institute</label>
                            <select id="institute" name="instituteid" class="form-control" required>
                                <option value="">Select Institute</option>
                                <?php
                                $academicyear = $_GET['academicyear'] ?? '';

                                if (empty($academicyear)) {
                                    $yearQuery = "SELECT id FROM tblacademicyear ORDER BY id DESC LIMIT 1";
                                    $yearResult = mysqli_query($connect, $yearQuery);
                                    if ($yearResult && $yearRow = mysqli_fetch_assoc($yearResult)) {
                                        $academicyear = $yearRow['id'];
                                    }
                                }

                                $query = "SELECT id, name FROM tblinstitute WHERE status = 'Active' AND academicyearid = '$academicyear'";
                                $result = mysqli_query($connect, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = (isset($editinstituteid) && $editinstituteid == $row['id']) ? 'selected' : '';
                                        echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                                    }
                                } else {
                                    echo "<option value=''>No institutes found</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="getDepartment" class="btn" id="submitBtn">
                                <?php echo $editid ? 'Update Department' : 'Add Department'; ?>
                            </button>
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
    </body>
</html>
