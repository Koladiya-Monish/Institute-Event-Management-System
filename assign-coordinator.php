<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php
$subcategoryid = $_GET['subcatid'];
$academicyear = $_GET['academicyearid'];

$query = "SELECT esc.id AS subcategory_id, ay.id AS academicyear_id, ay.year AS academic_year, ec.name AS category_name, esc.name AS subcategory_name, esc.type, esc.status, CONCAT(u.fname, ' ', u.lname) AS current_coordinator FROM tbleventsubcatagory esc JOIN tbleventcatagory ec ON esc.eventcatagoryid = ec.id JOIN tblacademicyear ay ON ec.academicyearid = ay.id LEFT JOIN tbleventcordinator co ON co.eventsubcatagoryid = esc.id LEFT JOIN tblfaculty f ON co.facultyid = f.id LEFT JOIN tbluser u ON f.userid = u.id WHERE esc.id = '$subcategoryid' LIMIT 1;";
$q = mysqli_query($connect, $query);

while($r = mysqli_fetch_assoc($q)){
    $category_name = $r['category_name'];
    $subcategory_id = $r['subcategory_id'];
    $subcategory_name = $r['subcategory_name'];
    $type = $r['type'];
    $status = $r['status'];
    $current_coordinator = !empty($r['current_coordinator']) ? $r['current_coordinator'] : 'Not Assigned';
}
?>

<?php
if (isset($_POST['assign'])) {
    $facultySelect = $_POST['facultySelect'];
//    $subcategory_id = $_POST['subcategory_id']; // make sure this is included in your form hidden field

    $checkQuery = "SELECT id FROM tbleventcordinator WHERE eventsubcatagoryid = '$subcategory_id' LIMIT 1";
    $checkResult = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $updateQuery = "UPDATE tbleventcordinator SET facultyid = '$facultySelect' WHERE eventsubcatagoryid = '$subcategory_id'";
        $result = mysqli_query($connect, $updateQuery);

        if (!$result) {
            die("❌ Error updating coordinator: " . mysqli_error($connect));
        } else {
            header("Location: manage-event-subcategory.php?msg=CoordinatorReassigned");
            exit;
        }
    } else {
        $insertQuery = "INSERT INTO tbleventcordinator (eventsubcatagoryid, facultyid) VALUES ('$subcategory_id', '$facultySelect')";
        $result = mysqli_query($connect, $insertQuery);

        if (!$result) {
            die("❌ Error inserting coordinator: " . mysqli_error($connect));
        } else {
            header("Location: manage-event-subcategory.php?msg=CoordinatorAssigned");
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Coordinator - Admin Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include_once 'admin_navbar.php'; ?>

        <!-- Main Content -->
        <main class="dashboard-content">
            <div style="display: flex; align-items: center; margin-bottom: 2rem;">
                <button onclick="window.history.back();" href='manage-event-subcategory.php' class="btn btn-secondary" style="margin-right: 1rem;">← Back</button>
                <!--<button onclick="window.location.href='manage-event-subcategory.php';" class="btn btn-secondary" style="margin-right: 1rem;">← Back</button>-->
                <h1>Assign Event Coordinator</h1>
            </div>
            
            <div class="card">
                <h3>Event Details</h3>
                <div style="padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div>
                            <strong>Category:</strong> <span id="eventCategory"><?php echo $category_name ?></span><br>
                            <strong>Sub-Category:</strong> <span id="eventSubCategory"><?php echo $subcategory_name ?></span>
                        </div>
                        <div>
                            <strong>Type:</strong> <span id="eventType"><?php echo $type ?></span><br>
                            <strong>Status:</strong> <span id="eventStatus"><?php echo $status ?></span>
                        </div>
                        <div>
                            <strong>Current Coordinator:</strong> <span id="currentCoordinator"><?php echo $current_coordinator ?></span>
                        </div>
                    </div>
                </div>

                <h3>Select New Coordinator</h3>
                <form id="coordinatorForm" method="post">
                    <div class="form-group">
                        <label for="facultySelect">Select Faculty</label>
                        <select id="facultySelect" name="facultySelect" class="form-control" required>
                            <option value="">--- Select Faculty ---</option>
                            <?php
                            $query = "SELECT f.id AS faculty_id, CONCAT(u.fname, ' ', u.lname) AS name, d.name AS department FROM tblfaculty f JOIN tbluser u ON f.userid = u.id JOIN tbldepartment d ON u.departmentid = d.id JOIN tblinstitute i ON d.instituteid = i.id JOIN tblacademicyear ay ON i.academicyearid = ay.id WHERE ay.id = '$academicyear' ORDER BY d.name, u.fname;";
                            $q = mysqli_query($connect, $query);
                            
                            if (!$q) {
                                die("Query Error: " . mysqli_error($connect));
                            }

                            if (mysqli_num_rows($q) == 0) {
                                die("No faculty found for academic year: " . htmlspecialchars($academicyear));
                            }
                            
                            while ($a = mysqli_fetch_assoc($q)) {
                                echo "<option value='" . $a['faculty_id'] . "'>" . $a['name'] . " - " . $a['department'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <button type="submit" name="assign" class="btn">Assign Coordinator</button>
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
