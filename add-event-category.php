<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php
$editid = $_GET['editid'] ?? "";
$academicyear = $_GET['academicyear'] ?? "";

if (isset($_POST['getEventcategory'])) {
    $categoryName = $_POST['categoryName'];

    if ($editid) {
        $query1 = "UPDATE tbleventcatagory SET name='$categoryName' WHERE id='$editid'";
        $q1 = mysqli_query($connect, $query1);
        header('Location: manage-event-category.php');
    } else {
        $query = "INSERT INTO tbleventcatagory(name, academicyearid) VALUES('$categoryName', $academicyear)";
        $q = mysqli_query($connect, $query);
        if(!$q){
            echo mysqli_error($connect);
        }
        header('Location: manage-event-category.php');
    }
}

if (!empty($editid)) {
    $query = "SELECT * FROM tbleventcatagory WHERE id='$editid'";
    $q = mysqli_query($connect, $query);

    while ($r = mysqli_fetch_assoc($q)) {
        $editcategoryName = $r['name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Event Category - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <?php include_once 'admin_navbar.php'; ?>

            <!-- Main Content -->
            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1 id="pageTitle">Add Event Category</h1>
                    <div>
                        <button class="btn btn-secondary" onclick="window.location.href = 'admin-event-category.php'">Back to List</button>
                    </div>
                </div>

                <!-- Event Category Form -->
                <div class="card">
                    <h3 id="formTitle"><?php echo $editid ? 'Edit Event Category' : 'Add New Event Category'; ?></h3>
                    <form id="categoryForm" method="POST">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" id="categoryName" name="categoryName" class="form-control" value="<?php echo $editcategoryName ?? ''; ?>" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="getEventcategory" class="btn" id="submitBtn">
                                <?php echo $editid ? 'Update Event Category' : 'Add Event Category'; ?>
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
