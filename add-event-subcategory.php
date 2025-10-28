<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php
$editid = $_GET['editid'] ?? "";
$academicyear = $_GET['academicyear'] ?? "";

if (isset($_POST['getEventsubcategory'])) {
    $categoryid = $_POST['categoryid'];
    $subcategoryName = $_POST['subcategoryName'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    if ($editid) {
        $query1 = "UPDATE tbleventsubcatagory SET eventcatagoryid = $categoryid, name = '$subcategoryName', type = '$type', status = '$status' WHERE id = '$editid'";
        $q1 = mysqli_query($connect, $query1);
        header('Location: manage-event-subcategory.php');
    } else {
        $query = "INSERT INTO tbleventsubcatagory(eventcatagoryid, name, type, status) VALUES($categoryid, '$subcategoryName', '$type', '$status')";
        $q = mysqli_query($connect, $query);
        if(!$q){
            echo mysqli_error($connect);
        }
        header('Location: manage-event-subcategory.php');
    }
}

if (!empty($editid)) {
    $query = "SELECT * FROM tbleventsubcatagory WHERE id='$editid'";
    $q = mysqli_query($connect, $query);

    while ($r = mysqli_fetch_assoc($q)) {
        $editcatagoryid = $r['eventcatagoryid'];
        $editsubcategoryName = $r['name'];
        $edittype = $r['type'];
        $editstatus = $r['status'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Event Sub-Category - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1 id="pageTitle">Add Event Sub-Category</h1>
                    <div>
                        <button class="btn btn-secondary" onclick="window.location.href = 'admin-event-subcategory.php'">Back to List</button>
                    </div>
                </div>

                <!-- Event Sub-Category Form -->
                <div class="card">
                    <h3 id="formTitle">Add New Event Sub-Category</h3>
                    <form id="subCategoryForm" method="post">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                            <div class="form-group">
                                <label for="category">Select Category Name</label>
                                <select id="category" name="categoryid" class="form-control" required>
                                    <option>--- Select Event Category ---</option>
                                    <?php
                                    $academicyearid = $_GET['academicyear'] ?? '';

                                    $query = "SELECT id, name FROM tbleventcatagory WHERE academicyearid = '$academicyearid' ORDER BY name ASC";
                                    $result = mysqli_query($connect, $query);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = (!empty($editcatagoryid) && $editcatagoryid == $row['id']) ? 'selected' : '';
                                            echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No categories available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subCategoryName">Enter Event Sub Category Name</label>
                                <input type="text" id="subcategoryName" name="subcategoryName" value="<?php echo isset($editsubcategoryName) ? htmlspecialchars($editsubcategoryName) : ''; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="eventType">Event Type</label>
                                <select id="eventType" name="type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="solo" <?php echo ($edittype ?? "") == "solo" ? "selected" : ""; ?>>Solo</option>
                                    <option value="group" <?php echo ($edittype ?? "") == "group" ? "selected" : ""; ?>>Group</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="upcoming" <?php echo ($editstatus ?? "") == "upcoming" ? "selected" : ""; ?>>Upcoming</option>
                                    <option value="ongoing" <?php echo ($editstatus ?? "") == "ongoing" ? "selected" : ""; ?>>Ongoing</option>
                                    <option value="completed" <?php echo ($editstatus ?? "") == "completed" ? "selected" : ""; ?>>Completed</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-center" style="margin-top: 2rem;">
                            <button type="submit" name="getEventsubcategory" class="btn" id="submitBtn">
                                <?php echo $editid ? 'Update Event Sub Category' : 'Add Event Sub Category'; ?>
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
