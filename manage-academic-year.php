<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<!--Delete Academic Year...-->
<?php
if (isset($_GET['deleteid'])) {
    $deleteid = (int) $_GET['deleteid']; // safety cast

    // 1️⃣ Check if any institute exists in this academic year
    $checkQuery = "SELECT COUNT(*) AS cnt FROM tblinstitute WHERE academicyearid = $deleteid";
    $checkResult = mysqli_query($connect, $checkQuery);
    $check = mysqli_fetch_assoc($checkResult);

    if ($check['cnt'] > 0) {
        // 2️⃣ Institute(s) exist — show JS alert and stop
        echo "<script>alert('Cannot delete this academic year because institutes exist in it.'); window.location.href='manage-academic-year.php';</script>";
    } else {
        // 3️⃣ Safe to delete
        $deleteQuery = "DELETE FROM tblacademicyear WHERE id = $deleteid";
        $q = mysqli_query($connect, $deleteQuery);

        if (!$q) {
            echo "<script>alert('Error deleting record: " . mysqli_error($connect) . "');</script>";
        } else {
            header('Location: manage-academic-year.php');
        }
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
            <?php include_once 'admin_navbar.php'; ?>

            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1>Academic Year Management</h1>
                </div>

                <!-- Add Department Button -->
                <div style="margin-bottom: 2rem;">
                    <button class="btn" onclick="window.location.href = 'add-academic-year.php'">Add Academic Year</button>
                </div>

                <div class="card">
                    <h3>All Academic Year</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Academic Year</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tblacademicyear";
                                $q = mysqli_query($connect, $query);
                                if ($q && mysqli_num_rows($q) > 0) {
                                    $i = 1;
                                    while ($r = mysqli_fetch_row($q)) {
                                        echo "<tr>"
                                        . "<td>$i</td>"
                                        . "<td>$r[1]</td>"
                                        . "<td>"
                                        . "<form method='get'>"
                                        . "<a href='add-academic-year.php?editid={$r[0]}' class='btn' style='margin-right: 9px;'>Edit</a>"
                                        . "<a href='manage-academic-year.php?deleteid={$r[0]}' onclick=\"return confirm('Are you sure you want to delete this record?');\" class='btn btn-danger btn-sm'>Delete</a>"
                                        . "</form>"
                                        . "</td>"
                                        . "</tr>";

                                        $i++;
                                    }
                                } else {
                                    echo mysqli_error($connect);
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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

            document.getElementById('deptForm').addEventListener('submit', function (e) {
                e.preventDefault();
                alert('Department added successfully!');
                this.reset();
            });
        </script>
    </body>
</html>
