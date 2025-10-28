<?php require_once 'config.php'; ?>

<?php 
if(isset($_GET['institute'])){
    $instituteid = $_GET['institute'];
    $selectedDept = $_GET['selected'] ?? ''; // Pre-selected department

    $q = "SELECT id, name FROM tbldepartment WHERE instituteid = '$instituteid' ORDER BY name";
    $query = mysqli_query($connect, $q);

    echo "<option value=''>-- Select Department --</option>";
    while($r = mysqli_fetch_assoc($query)){
        $sel = ($r['id'] == $selectedDept) ? "selected" : "";
        echo "<option value='{$r['id']}' $sel>{$r['name']}</option>";
    }
}
?>
