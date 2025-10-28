<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php
$editid = $_GET['editid'] ?? "";

if (isset($_POST['getInstitute'])) {
    $instituteName = $_POST['instituteName'];
    $status = $_POST['status'];
    $academicyear = $_GET['academicyear'];
    
    if ($editid) {
        $query = "UPDATE tblinstitute SET name = '$instituteName' WHERE id = '$editid'";
        mysqli_query($connect, $query);
        header('Location: manage-institute.php');
    } else {
        $query1 = "INSERT INTO tblinstitute(name, status, academicyearid) VALUES('$instituteName', '$status', '$academicyear')";
        if (mysqli_query($connect, $query1)) {
            header("Location: manage-institute.php");
        } else {
            echo "❌ Error: " . mysqli_error($connect);
        }
    }
//    header("Location: manage-institute.php");
}
?>

<?php
if (isset($editid)) {
    $query = "SELECT * FROM tblinstitute WHERE id = '$editid'";
    $q = mysqli_query($connect, $query) or die("Query failed: " . mysqli_error($connect));

    while ($r = mysqli_fetch_row($q)) {
        $editname = $r[1];
        $editstatus = $r[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Institute - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1 id="pageTitle">Add Institute</h1>
                    <div>
                        <button class="btn btn-secondary" onclick="window.location.href = 'manage-institute.php'">Back to List</button>
                    </div>
                </div>

                <!-- Institute Form -->
                <div class="card">
                    <h3 id="formTitle">Add New Institute</h3>
                    <form id="instituteForm" method="POST">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="instituteName">Institute Name</label>
                                <input type="text" id="instituteName" name="instituteName" class="form-control" value="<?php echo $editname ?? ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <!--<input type="text" id="status" name="statua" class="form-control" value="<?php echo $editstatus ?? ''; ?>" required>-->
                                <select id="status" name="status" class="form-control" required>
                                    <option value="">--- Select Status ---</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="getInstitute" class="btn" id="submitBtn">Add Institute</button>
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
