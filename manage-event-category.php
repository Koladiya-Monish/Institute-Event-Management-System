<?php require_once 'config.php'; ?>
<?php session_start(); ?>

<?php
//1.1️⃣ Get current calendar year
$currentYear = date('Y');

//2.2️⃣ Check if current year exists in tblacademicyear
$currentYearQuery = mysqli_query($connect, "SELECT id FROM tblacademicyear WHERE year = '$currentYear' LIMIT 1");

//3.3️⃣ If current year exists, use it — else use the latest year
if (mysqli_num_rows($currentYearQuery) > 0) {
    $yearData = mysqli_fetch_assoc($currentYearQuery);
    $selectedYear = $yearData['id'];
} else {
    $latestYearQuery = mysqli_query($connect, "SELECT id FROM tblacademicyear ORDER BY year DESC LIMIT 1");
    $latest = mysqli_fetch_assoc($latestYearQuery);
    $selectedYear = $latest['id'];
}

//4.4️⃣ Allow manual override from dropdown
if (isset($_GET['academicyearid'])) {
    $selectedYear = $_GET['academicyearid'];
}
?>

<?php
//For Delete Event-Categoty...
if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];

    $query = "DELETE FROM tbleventcatagory WHERE id = '$deleteid'";
    $q = mysqli_query($connect, $query);
    if(!$q){
        echo mysqli_errno($connect);
    }
    
//    if ($r = mysqli_fetch_assoc($q2)) {
//        $userid = $r['userid'];
//        mysqli_query($connect, "DELETE FROM tbluser WHERE id = '$userid'");
//    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Event Categories - IEMS</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="dashboard-container">
            <?php include_once 'admin_navbar.php'; ?>

            <main class="dashboard-content">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h1>Event Category Management</h1>
                    <div>
                        <form method="get" id="yearForm" style="display:inline;">
                            <label for="academicYear" style="margin-right: 1rem; font-weight: 600;">Academic Year:</label>
                            <select id="academicYear" name="academicyearid" class="form-control" style="width: auto; display: inline-block;" onchange="document.getElementById('yearForm').submit();">
                                <?php
                                $query = "SELECT * FROM tblacademicyear";
                                $q = mysqli_query($connect, $query);

                                while ($a = mysqli_fetch_assoc($q)) {
                                    $isSelected = ($a['id'] == $selectedYear) ? 'selected' : '';
                                    echo "<option value='{$a['id']}' $isSelected>{$a['year']}</option>";
                                }
                                ?>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Add Event Category Button -->
                <div style="margin-bottom: 2rem;">
                    <button class="btn" onclick="window.location.href = 'add-event-category.php?academicyear=<?php echo $selectedYear; ?>'">Add Event Category</button>
                </div>

                <div class="card">
                    <h3>All Event Categories</h3>
                    <div style="margin-bottom: 1rem;">
                        <input type="text" id="searchCategory" class="form-control" placeholder="Search categories..." style="width: 300px; display: inline-block;">
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sequence No.</th>
                                    <th>Category Name</th>
                                    <th>Sub-Categories</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT c.id AS category_id, c.name AS category_name, COUNT(s.id) AS subcategory_count FROM tbleventcatagory c LEFT JOIN tbleventsubcatagory s ON c.id = s.eventcatagoryid WHERE c.academicyearid = $selectedYear GROUP BY c.id, c.name ORDER BY c.name;";
                                $q = mysqli_query($connect, $query);

                                if (!$q) {
                                    die("Query failed: " . mysqli_error($connect));
                                } else {
                                    $i = 1;
                                    while ($r = mysqli_fetch_assoc($q)) {
                                        echo "<tr>"
                                        . "<td>$i</td>"
                                        . "<td>{$r['category_name']}</td>"
                                        . "<td>{$r['subcategory_count']}</td>"
                                        . "<td>"
                                        . "<form method='get'>"
                                        . "<a href='add-event-category.php?editid={$r['category_id']}' class='btn'>Edit</a>"
                                        . "<a href='manage-event-category.php?deleteid={$r['category_id']}' class='btn btn-danger btn-sm'>Delete</a>"
                                        . "</form>"
                                        . "</td>"
                                        . "</tr>";

                                        $i++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

        <script>
            function toggleDropdown(dropdownId) {
                const dropdown = document.getElementById(dropdownId + '-dropdown');
                dropdown.classList.toggle('show');
            }
        </script>

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
    </body>
</html>
